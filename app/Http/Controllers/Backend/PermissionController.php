<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PermissionController extends Controller
{
    public function index()
    {
        return view('pages.be.permission.index');
    }

    public function data(Request $request)
    {
    }

    public function tambah()
    {
        return view('pages.be.permission.tambah');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ], [
            'name.required' => 'tidak boleh kosomg'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }


        $permission = DB::table('permissions')->insert([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        if ($permission) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function edit($id)
    {
    }
}
