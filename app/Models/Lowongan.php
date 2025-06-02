<?php

// app/Models/Lowongan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;

    // Menambahkan kolom-kolom yang bisa diisi melalui form
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'lokasi',
        'tipe',
        'kualifikasi',
        'skills',
        'status',
        'kota',
        'provinsi',
        'gaji_min',
        'gaji_max',
        'deadline',
        'mitra_nama', // diisi admin
        'mitra_deskripsi', // diisi admin
        'mitra_logo', // diisi admin
        'link_pendaftaran', // diisi admin
        'created_by_role'
    ];


    // Relasi ke model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }

    // Di dalam model Lowongan
    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }


}

