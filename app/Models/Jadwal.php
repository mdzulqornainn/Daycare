<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model {
    protected $table = 'Jadwal_Pengasuh';
    protected $primaryKey = 'id_jadwal';
    public $timestamps = false;
    protected $fillable = ['id_pengasuh', 'tanggal', 'jam_mulai', 'jam_selesai', 'jam_masuk_real', 'jam_keluar_real', 'status_hadir'];
}