<?php
namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan ini agar bisa menggunakan Query JOIN
use Exception;

class AnakController extends Controller
{
    // 1. READ: Mengambil semua data anak beserta NAMA ORANG TUA
    public function index() {
        $data = DB::table('Anak')
            ->join('Orang_Tua', 'Anak.id_individu_orangtua', '=', 'Orang_Tua.id_individu')
            ->join('Individu', 'Orang_Tua.id_individu', '=', 'Individu.id_individu')
            ->select('Anak.*', 'Individu.nama AS nama_orang_tua') // Mengambil nama dari tabel Individu
            ->orderBy('Anak.id_anak', 'desc')
            ->get();

        return response()->json($data);
    }

    // 2. CREATE: Menyimpan data baru
    public function store(Request $request) {
        Anak::create($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil ditambahkan']);
    }

    // 3. UPDATE: Mengubah data
    public function update(Request $request, $id) {
        $anak = Anak::findOrFail($id);
        $anak->update($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil diperbarui']);
    }

    // 4. DELETE: Menghapus data
    public function destroy($id) {
        try {
            $anak = Anak::findOrFail($id);
            $anak->delete();
            return response()->json(['status' => 'sukses', 'pesan' => 'Data berhasil dihapus']);
        } catch (Exception $e) {
            // Menangkap error jika data masih terpakai di Transaksi_Titip
            return response()->json(['status' => 'error', 'pesan' => 'Gagal! Data ini masih terpakai di tabel Transaksi.'], 500);
        }
    }
}