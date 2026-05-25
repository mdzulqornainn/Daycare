<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model {
    protected $table = 'Pembayaran';
    protected $primaryKey = 'id_pembayaran';
    public $timestamps = false;
    protected $fillable = ['id_transaksi', 'tanggal_bayar', 'jumlah', 'status'];
}