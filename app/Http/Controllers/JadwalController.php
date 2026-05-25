<?php
namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index() {
        return response()->json(Jadwal::orderBy('id_jadwal', 'desc')->get());
    }
    public function store(Request $request) {
        Jadwal::create($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Jadwal ditambahkan']);
    }
    public function update(Request $request, $id) {
        Jadwal::findOrFail($id)->update($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Jadwal diperbarui']);
    }
    public function destroy($id) {
        Jadwal::findOrFail($id)->delete();
        return response()->json(['status' => 'sukses', 'pesan' => 'Jadwal dihapus']);
    }
}