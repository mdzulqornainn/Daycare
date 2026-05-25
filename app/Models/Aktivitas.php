<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model {
    protected $table = 'Aktivitas';
    protected $primaryKey = 'id_aktivitas';
    public $timestamps = false;
    protected $fillable = ['id_transaksi', 'id_individu_pengasuh', 'kegiatan', 'jam_kegiatan', 'catatan'];
}