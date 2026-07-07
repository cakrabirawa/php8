<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SpaApiController extends Controller
{
    // Konversi menu linear database menjadi struktur pohon bertingkat
    private function buildMenuTree($menus, $parentId = null)
    {
        $branch = [];
        foreach ($menus as $menu) {
            if ($menu->parent_id == $parentId) {
                $children = $this->buildMenuTree($menus, $menu->id);
                $menu->children = $children ?: [];
                $branch[] = $menu;
            }
        }
        return $branch;
    }

    public function initializeApplication()
    {
        $user = auth()->user();

        $rawMenus = DB::table('menus')
            ->join('role_menu', 'menus.id', '=', 'role_menu.menu_id')
            ->where('role_menu.role', $user->role)
            ->orderBy('menus.order_no', 'asc')
            ->select('menus.id', 'menus.name', 'menus.route_name', 'menus.icon', 'menus.parent_id')
            ->get();

        return response()->json([
            'user' => ['name' => $user->name, 'role' => $user->role],
            'menus' => $this->buildMenuTree($rawMenus)
        ]);
    }

    // --- MANAJEMEN PERMISSION ---
    public function getPermissions(string $role)
    {
        $menuIds = DB::table('role_menu')->where('role', $role)->pluck('menu_id');
        $allMenus = DB::table('menus')->orderBy('order_no')->get(['id', 'name', 'parent_id']);

        return response()->json(['allowed' => $menuIds, 'all_menus' => $allMenus]);
    }

    public function savePermissions(Request $request)
    {
        $request->validate(['role' => 'required', 'menus' => 'present|array']);

        DB::transaction(function () use ($request) {
            DB::table('role_menu')->where('role', $request->role)->delete();
            $insertData = array_map(fn($id) => ['role' => $request->role, 'menu_id' => $id], $request->menus);
            if (!empty($insertData)) DB::table('role_menu')->insert($insertData);
        });
        return response()->json(['message' => 'Sukses']);
    }

    // --- CRUD USER ---
    public function getUsers()
    {
        return response()->json(DB::table('users')->select('id', 'name', 'email', 'role')->orderBy('id', 'desc')->get());
    }

    public function storeUser(Request $request)
    {
        DB::table('users')->insert(['name' => $request->name, 'email' => $request->email, 'password' => Hash::make($request->password), 'role' => $request->role, 'created_at' => now()]);
        return response()->json(['message' => 'Sukses']);
    }

    public function updateUser(Request $request, $id)
    {
        $data = ['name' => $request->name, 'email' => $request->email, 'role' => $request->role, 'updated_at' => now()];
        if ($request->filled('password')) $data['password'] = Hash::make($request->password);
        DB::table('users')->where('id', $id)->update($data);
        return response()->json(['message' => 'Sukses']);
    }

    public function destroyUser($id)
    {
        DB::table('users')->where('id', $id)->delete();
        return response()->json(['message' => 'Sukses']);
    }
}
