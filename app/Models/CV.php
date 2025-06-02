<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;



class CV extends Model
{
    use HasFactory;

    protected $table = 'cv'; // <- tambahkan baris ini

    protected $fillable = [
    'user_id',
    'tentang_saya',
    'skill',
    'riwayat_pendidikan',
    'pengalaman_kerja',
    'pengalaman_organisasi',
    'penghargaan',
    ];

    protected $casts = [
    'riwayat_pendidikan' => 'array',
    'pengalaman_kerja' => 'array',
    'pengalaman_organisasi' => 'array',
    'penghargaan' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alumni(): BelongsTo
    {
        return $this->belongsTo(Alumni::class);
    }

    public function lamaran(): HasMany
    {
        return $this->hasMany(Lamaran::class);
    }

    public function lowongan(): HasMany
    {
        return $this->hasMany(Lowongan::class);
    }

}


