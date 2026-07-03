<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Region;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $region = $request->input('region');

        $stores = Store::with('region')
            ->when($search, fn($q) => $q->where('name', 'like', "%$search%"))
            ->when($region, fn($q) => $q->where('region_id', $region))
            ->paginate(20) ->withQueryString();

        return view('admin.stores.index', [
            'stores' => $stores,
            'regions' => Region::all(),
            'search' => $search,
            'filterRegion' => $region,
        ]);
    }

    public function create()
    {
        return view('admin.stores.create', [
            'regions' => Region::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric|unique:stores,id',
            'region_id' => 'required',
            'name' => 'required|string|max:255',
        ], [
            'id.required' => 'Store ID wajib diisi',
            'id.numeric' => 'Store ID harus berupa angka',
            'id.unique' => 'Store ID sudah digunakan, silakan gunakan ID lain', // 🔥 INI
            'region_id.required' => 'Region wajib dipilih',
            'name.required' => 'Nama store wajib diisi',
        ]);

        $user = User::create([
            'name' => $request->name . ' Store',
            'email' => strtolower(str_replace(' ', '', $request->id)),
            'password' => Hash::make('store123'), 
            'role' => 'user',
        ]);

        Store::create([
            'id' => $request->id,
            'region_id' => $request->region_id,
            'name' => $request->name,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store & akun berhasil dibuat');
    }

    public function edit(Store $store)
    {
        $store->load('user');

        return view('admin.stores.edit', [

            'store' => $store,
            'regions' => Region::all()
        ]);
    }

    public function update(Request $request, Store $store)
    {
        $request->validate([
            'id' => 'required|numeric|unique:stores,id,',
            'region_id' => 'required|exists:regions,id',
            'name' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $store) {

            $oldId = $store->id;
            $newId = $request->id;

            if ($oldId != $newId) {

                // 🔥 1. DUPLICATE STORE DENGAN ID BARU
                DB::table('stores')->insert([
                    'id' => $newId,
                    'region_id' => $request->region_id,
                    'name' => $request->name,
                    'user_id' => $store->user_id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // 🔥 2. UPDATE EMPLOYEES KE ID BARU
                DB::table('employees')
                    ->where('store_id', $oldId)
                    ->update([
                        'store_id' => $newId,
                        'updated_at' => now(),
                    ]);

                // 🔥 3. HAPUS STORE LAMA
                DB::table('stores')->where('id', $oldId)->delete();

            } else {

                // kalau ID tidak berubah
                $store->update([
                    'region_id' => $request->region_id,
                    'name' => $request->name,
                ]);
            }
        });


        return redirect()->route('admin.stores.index')
            ->with('success', 'Store & related employees updated successfully.');
    }

    public function destroy(Store $store)
    {
        if ($store->employees()->exists()) {
            return back()->with(
                'error',
              'Cannot delete store. Employees are still assigned to this store.'
            );
        }

        if ($store->user) {
            $store->user->delete();
        }

        $store->delete();

        return redirect()->route('admin.stores.index')
            ->with('success', 'Store dan akun berhasil dihapus.');
    }

    
    public function resetPassword(Store $store)
    {
        if (!$store->user) {
            return back()->with('error', 'User account not found');
        }

        $defaultPassword = 'password123';

        $store->user->update([
            'password' => Hash::make('store123')
        ]);

        return back()->with(
            'success',
            'Password reset successfully. Default password: store123'
        );
    }
}
