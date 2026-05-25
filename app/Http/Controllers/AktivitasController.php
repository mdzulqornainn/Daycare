<?php
namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Wajib ditambahkan untuk fitur JOIN

class AktivitasController extends Controller
{
    // 1. READ: Mengambil data aktivitas + Nama Pengasuh
    public function index() {
        $data = DB::table('Aktivitas')
            ->join('Pengasuh', 'Aktivitas.id_individu_pengasuh', '=', 'Pengasuh.id_individu')
            ->join('Individu', 'Pengasuh.id_individu', '=', 'Individu.id_individu')
            ->select('Aktivitas.*', 'Individu.nama AS nama_pengasuh') // Ambil nama asli pengasuh
            ->orderBy('Aktivitas.id_aktivitas', 'desc')
            ->get();
            
        return response()->json($data);
    }

    // 2. CREATE: Menyimpan data baru
    public function store(Request $request) {
        Aktivitas::create($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Aktivitas ditambahkan']);
    }

    // 3. UPDATE: Mengubah data
    public function update(Request $request, $id) {
        Aktivitas::findOrFail($id)->update($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Aktivitas diperbarui']);
    }

    // 4. DELETE: Menghapus data
    public function destroy($id) {
        Aktivitas::findOrFail($id)->delete();
        return response()->json(['status' => 'sukses', 'pesan' => 'Aktivitas dihapus']);
    }
}