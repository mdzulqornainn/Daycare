<?php
namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index() {
        return response()->json(Pembayaran::orderBy('id_pembayaran', 'desc')->get());
    }
    public function store(Request $request) {
        Pembayaran::create($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Pembayaran dicatat']);
    }
    public function update(Request $request, $id) {
        Pembayaran::findOrFail($id)->update($request->all());
        return response()->json(['status' => 'sukses', 'pesan' => 'Pembayaran diperbarui']);
    }
    public function destroy($id) {
        Pembayaran::findOrFail($id)->delete();
        return response()->json(['status' => 'sukses', 'pesan' => 'Pembayaran dihapus']);
    }
}