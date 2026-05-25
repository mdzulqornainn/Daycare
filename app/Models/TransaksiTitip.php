<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiTitip extends Model
{
    // Arahkan ke tabel yang benar di database MySQL
    protected $table = 'Transaksi_Titip';
    
    // Tentukan Primary Key-nya
    protected $primaryKey = 'id_transaksi';
    
    // Matikan timestamps bawaan Laravel
    public $timestamps = false;
    
    // Izinkan kolom-kolom ini untuk diisi melalui form HTML
    protected $fillable = ['id_anak', 'tanggal_titip'];
}