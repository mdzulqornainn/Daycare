<?php
namespace App\Http\Controllers;

use App\Models\TransaksiTitip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class TransaksiTitipController extends Controller
{
    // 1. READ: Ambil data Transaksi sekaligus nama Anak
    public function index()
    {
        $data = DB::table('Transaksi_Titip')
            ->join('Anak', 'Transaksi_Titip.id_anak', '=', 'Anak.id_anak')
            ->select('Transaksi_Titip.*', 'Anak.nama_anak') // Ambil semua kolom transaksi + nama anak
            ->orderBy('Transaksi_Titip.id_transaksi', 'desc')
            ->get();
            
        return response()->json($data);
    }

    // 2. CREATE: Simpan Transaksi Baru
    public function store(Request $request)
    {
        TransaksiTitip::create($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Transaksi titip berhasil dicatat']);
    }

    // 3. UPDATE: Perbarui Data Transaksi
    public function update(Request $request, $id)
    {
        $transaksi = TransaksiTitip::findOrFail($id);
        $transaksi->update($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Transaksi titip berhasil diperbarui']);
    }

    // 4. DELETE: Hapus Transaksi (Dilindungi dari error Foreign Key)
    public function destroy($id)
    {
        try {
            $transaksi = TransaksiTitip::findOrFail($id);
            $transaksi->delete();
            return response()->json(['status' => 'sukses', 'pesan' => 'Transaksi titip berhasil dihapus']);
        } catch (Exception $e) {
            // Error ini akan muncul jika transaksi ini masih nyangkut di tabel Pembayaran / Aktivitas
            return response()->json([
                'status' => 'error', 
                'pesan' => 'Gagal menghapus! Transaksi ini sudah memiliki riwayat Pembayaran atau Aktivitas.'
            ], 500);
        }
    }
}