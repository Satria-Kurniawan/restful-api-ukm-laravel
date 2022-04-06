<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UKM;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class UKMController extends Controller
{
    public function getUkmData()
    {
        $ukmData = UKM::all();

        return response()->json($ukmData);
    }

    public function getUkmDataById($id)
    {
        $ukmData = UKM::findOrFail($id);

        return response()->json($ukmData);
    }

    public function postUkmData(Request $request)
    {
        try {
            $file = $request->file('gambar');
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/images', $fileName);

            $ukmData = UKM::create([
                'ukm' => $request->ukm,
                'deskripsi' => $request->deskripsi,
                'lokasi' => $request->lokasi,
                'jadwal' => $request->jadwal,
                'gambar' => asset('storage/images/' . $fileName),
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

    public function updateUkmData(Request $request, $id)
    {
        try {
            $ukmData = UKM::findOrFail($id);
            $ukmData->ukm = $request->ukm;
            $ukmData->deskripsi = $request->deskripsi;
            $ukmData->lokasi = $request->lokasi;
            $ukmData->jadwal = $request->jadwal;
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $fileName = $file->getClientOriginalName();
                $file->storeAs('public/images', $fileName);

                $ukmData->gambar = asset('storage/images/' . $fileName);
            }
            $ukmData->save();

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

    public function deleteUkmData($id)
    {
        try {
            $ukmData = UKM::findOrFail($id);
            $ukmData->delete();

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

    public function searchUkm($ukm)
    {
        $hasil = UKM::where('ukm', 'LIKE', '%' . $ukm . '%')->get();

        if (count($hasil)) {
            return response()->json($hasil);
        } else {
            return response()->json("ukm tidak ditemukan");
        }
    }
}
