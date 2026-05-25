<?php
namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use Exception;

class AnakController extends Controller
{
    // 1. READ: Mengambil semua data
    public function index() {
        // Otomatis urutkan dari yang terbaru
        $data = Anak::orderBy('id_anak', 'desc')->get();
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