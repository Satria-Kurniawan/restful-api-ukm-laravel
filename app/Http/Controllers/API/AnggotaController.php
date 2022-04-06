<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function getDataAnggota()
    {
        $dataAnggota = Anggota::all();

        return response()->json($dataAnggota);
    }

    public function getDataAnggotaById($id)
    {
        $dataAnggota = Anggota::findOrFail($id);

        return response()->json($dataAnggota);
    }

    public function postDataAnggota(Request $request)
    {
        try {
            $dataAnggota = Anggota::create([
                'nama' => $request->nama,
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'semester' => $request->semester,
                'no_telepon' => $request->no_telepon
            ]);

            return response()->json([
                'success' => true,
                'message' => 'insert success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'insert failed',
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function updateDataAnggota(Request $request, $id)
    {
        try {
            $dataAnggota = Anggota::findOrFail($id);
            $dataAnggota->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'update success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'update failed',
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function deleteDataAnggota($id)
    {
        try {
            $dataAnggota = Anggota::findOrFail($id);
            $dataAnggota->delete();

            return response()->json([
                'success' => true,
                'message' => 'delete success'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'delete failed',
                'errors' => $th->getMessage()
            ]);
        }
    }

    public function searchAnggota($nama)
    {
        $hasil = Anggota::where('nama', 'LIKE', '%' . $nama . '%')->get();

        if (count($hasil)) {
            return response()->json($hasil);
        } else {
            return response()->json("anggota tidak ditemukan");
        }
    }
}
