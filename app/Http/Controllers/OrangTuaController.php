<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class OrangTuaController extends Controller
{
    public function index() {
        $data = DB::table('Orang_Tua')
            ->join('Individu', 'Orang_Tua.id_individu', '=', 'Individu.id_individu')
            ->select('Orang_Tua.id_individu', 'Individu.nama', 'Individu.no_hp', 'Individu.email', 'Individu.alamat', 'Orang_Tua.pekerjaan', 'Orang_Tua.kontak_darurat')
            ->orderBy('Orang_Tua.id_individu', 'desc')->get();
        return response()->json($data);
    }

    public function store(Request $request) {
        DB::beginTransaction();
        try {
            $idBaru = DB::table('Individu')->insertGetId([
                'nama' => $request->nama, 'no_hp' => $request->no_hp,
                'email' => $request->email, 'alamat' => $request->alamat,
                'jenis_individu' => 'Orang Tua'
            ]);
            DB::table('Orang_Tua')->insert([
                'id_individu' => $idBaru, 'pekerjaan' => $request->pekerjaan,
                'kontak_darurat' => $request->kontak_darurat
            ]);
            DB::commit();
            return response()->json(['status' => 'sukses', 'pesan' => 'Data Orang Tua berhasil ditambahkan']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'pesan' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id) {
        DB::beginTransaction();
        try {
            DB::table('Individu')->where('id_individu', $id)->update([
                'nama' => $request->nama, 'no_hp' => $request->no_hp,
                'email' => $request->email, 'alamat' => $request->alamat
            ]);
            DB::table('Orang_Tua')->where('id_individu', $id)->update([
                'pekerjaan' => $request->pekerjaan, 'kontak_darurat' => $request->kontak_darurat
            ]);
            DB::commit();
            return response()->json(['status' => 'sukses', 'pesan' => 'Data Orang Tua diperbarui']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'pesan' => $e->getMessage()], 500);
        }
    }

    public function destroy($id) {
        try {
            DB::table('Individu')->where('id_individu', $id)->delete();
            return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'pesan' => 'Gagal menghapus data.']);
        }
    }
}