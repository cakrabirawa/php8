<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DevController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.dev.index', compact('users'));
    }

    public function importSql(Request $request)
    {
        $request->validate([
            'sql_file' => 'required|file'
        ]);

        $sql = file_get_contents($request->file('sql_file')->getRealPath());

        DB::unprepared($sql);

        return back()->with('success','SQL imported successfully');
    }

    public function runSql(Request $request)
    {
        $query = $request->query;

        $result = DB::select(DB::raw($query));

        return back()->with('result',$result);
    }

    public function export($table)
    {

        if (!\Schema::hasTable($table)) {
            return back()->with('error','Table not found');
        }

        $rows = DB::table($table)->get();

        if ($rows->isEmpty()) {
            return back()->with('error','Table is empty');
        }

        $sql = "";

        foreach ($rows as $row) {

            $columns = array_keys((array)$row);
            $values = array_values((array)$row);

            $values = array_map(function ($value) {
                return is_null($value) ? 'NULL' : "'" . addslashes($value) . "'";
            }, $values);

            $sql .= "INSERT INTO `$table` (`"
                . implode("`,`", $columns)
                . "`) VALUES ("
                . implode(",", $values)
                . ");\n";
        }

        $filename = $table . "_backup_" . date('Y-m-d_H-i-s') . ".sql";

        return response($sql)
            ->header('Content-Type', 'application/sql')
            ->header('Content-Disposition', "attachment; filename=$filename");
    }

    // CREATE USER
    public function storeUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,editor,viewer',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make('12345678'), // default password
            'email_verified_at' => now()
        ]);

        return back()->with(
            'success',
            'User berhasil dibuat. Silakan login menggunakan email terdaftar sebagai username dan password default: 12345678'
        );
    }

        // RESET PASSWORD
        public function resetUser($id)
        {
            $user = User::findOrFail($id);

            $user->update([
                'password' => Hash::make('12345678')
            ]);

            return back()->with('success', 'Password reset to 12345678');
        }

        // DELETE USER
        public function deleteUser($id)
        {
            $user = User::findOrFail($id);

            if ($user->role === 'admin') {
                return back()->with('error', 'Cannot delete admin');
            }

            $user->delete();

            return back()->with('success', 'User deleted');
        }
}