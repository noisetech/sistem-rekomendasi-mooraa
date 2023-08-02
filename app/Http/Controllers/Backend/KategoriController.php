<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        return view('pages.be.kategori.index');
    }

    public function data(Request $request)
    {
        if (request()->ajax()) {

            $query = DB::table('bahan_kategori_produk')->orderBy('nama', 'ASC');

            return datatables()->of($query)
                ->addColumn('aksi', function ($data) {
                    $button = '<div class="d-flex justify-content-start align-items-center">
                <a href="' . route('kategori.edit', $data->id) . '" class="btn btn-sm btn-primary">
                <i class="fas fa-sm fa-edit mx-1"></i> Edit
            </a>
                 <a class="btn btn-sm btn-danger mx-1 hapus" href="javascript:void(0)" data-id="' . $data->id . '">
                 <i class="fas fa-sm fa-trash-alt mx-1"></i> Hapus
                  </a>
                </div>';

                    return $button;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
    }

    public function tambah()
    {
        return view('pages.be.kategori.tambah');
    }

    public function simpan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $kategori = DB::table('bahan_kategori_produk')->insert([
            'nama' => $request->nama,
            'slug' => Str::slug($request->nama)
        ]);

        if ($kategori) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data ditambah'
            ]);
        }
    }

    public function edit($id)
    {
        $kategori = DB::table('bahan_kategori_produk')->where('id', $id)->first();

        return view('pages.be.kategori.edit', [
            'kategori' => $kategori
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required'
        ], [
            'nama.required' => 'tidak boleh kosong'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'error' => $validator->errors()->toArray()
            ]);
        }

        $kategori = DB::table('bahan_kategori_produk')
            ->where('id', $request->id)
            ->update([
                'nama' => $request->nama,
                'slug' => Str::slug($request->nama)
            ]);

        if ($kategori) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data diubah'
            ]);
        }
    }

    public function hapus(Request $request)
    {
        $kategori = DB::table('bahan_kategori_produk')->where('id', $request->id)->delete();

        if ($kategori) {
            return response()->json([
                'status' => 'success',
                'title' => 'Berhasil',
                'message' => 'Data dihapus'
            ]);
        }
    }
}
