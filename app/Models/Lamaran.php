<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

   protected $fillable = [
    'lowongan_id', 'user_id', 'cv_pdf', 'portofolio', 'telepon', 'email', 'linkedin', 'status','pesan_notifikasi'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class);
    }

    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }

    public function cv()
    {
        return $this->belongsTo(CV::class, 'cv_id');
    }

}

