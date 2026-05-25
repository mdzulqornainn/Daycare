<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class PengasuhController extends Controller
{
    // 1. READ: Ambil data gabungan dari tabel Individu & Pengasuh
    public function index()
    {
        $data = DB::table('Pengasuh')
            ->join('Individu', 'Pengasuh.id_individu', '=', 'Individu.id_individu')
            ->select('Pengasuh.id_individu', 'Individu.nama', 'Individu.no_hp', 'Individu.email', 'Individu.alamat', 'Pengasuh.gaji')
            ->orderBy('Pengasuh.id_individu', 'desc')
            ->get();
            
        return response()->json($data);
    }

    // 2. CREATE: Simpan ke tabel Individu dulu, baru ke tabel Pengasuh
    public function store(Request $request)
    {
        DB::beginTransaction(); // Mulai mode aman
        try {
            // Insert ke tabel Individu dan ambil ID barunya
            $idBaru = DB::table('Individu')->insertGetId([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat,
                'jenis_individu' => 'Pengasuh'
            ]);

            // Gunakan ID tersebut untuk insert ke tabel Pengasuh
            DB::table('Pengasuh')->insert([
                'id_individu' => $idBaru,
                'gaji' => $request->gaji
            ]);

            DB::commit(); // Simpan permanen
            return response()->json(['status' => 'sukses', 'pesan' => 'Data Pengasuh berhasil ditambahkan']);
        } catch (Exception $e) {
            DB::rollBack(); // Batalkan jika ada error
            return response()->json(['status' => 'error', 'pesan' => $e->getMessage()], 500);
        }
    }

    // 3. UPDATE: Update kedua tabel
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            DB::table('Individu')->where('id_individu', $id)->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'alamat' => $request->alamat
            ]);

            DB::table('Pengasuh')->where('id_individu', $id)->update([
                'gaji' => $request->gaji
            ]);

            DB::commit();
            return response()->json(['status' => 'sukses', 'pesan' => 'Data Pengasuh berhasil diperbarui']);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'pesan' => $e->getMessage()], 500);
        }
    }

    // 4. DELETE: Cukup hapus Individu, Pengasuh otomatis terhapus (Karena aturan CASCADE di SQL kamu)
    public function destroy($id)
    {
        try {
            DB::table('Individu')->where('id_individu', $id)->delete();
            return response()->json(['status' => 'sukses', 'pesan' => 'Data Pengasuh berhasil dihapus']);
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'pesan' => 'Gagal menghapus data. Pastikan pengasuh ini tidak sedang terpakai di jadwal/aktivitas.'], 500);
        }
    }
}