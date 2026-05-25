<?php
namespace App\Http\Controllers;

use App\Models\Aktivitas;
use Illuminate\Http\Request;

class AktivitasController extends Controller
{
    public function index() {
        return response()->json(Aktivitas::orderBy('id_aktivitas', 'desc')->get());
    }
    public function store(Request $request) {
        Aktivitas::create($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Aktivitas ditambahkan']);
    }
    public function update(Request $request, $id) {
        Aktivitas::findOrFail($id)->update($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Aktivitas diperbarui']);
    }
    public function destroy($id) {
        Aktivitas::findOrFail($id)->delete();
        return response()->json(['status' => 'sukses', 'pesan' => 'Aktivitas dihapus']);
    }
}