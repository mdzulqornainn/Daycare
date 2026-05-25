<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    // Beritahu nama tabel yang spesifik
    protected $table = 'Anak';
    
    // Beritahu primary key-nya bukan 'id', melainkan 'id_anak'
    protected $primaryKey = 'id_anak';
    
    // Matikan fitur otomatis created_at & updated_at karena di SQL kamu tidak ada kolom tersebut
    public $timestamps = false;
    
    // Daftarkan kolom apa saja yang boleh diisi (mass assignment)
    protected $fillable = [
        'id_individu_orangtua', 
        'nama_anak', 
        'tanggal_lahir', 
        'jenis_kelamin', 
        'alergi'
    ];
}