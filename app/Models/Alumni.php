<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id', 'telepon', 'kota', 'provinsi', 'jenis_kelamin', 'linkedin',
    'status_kerja', 'program_studi', 'angkatan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }

    public function cv()
    {
        return $this->hasOne(CV::class);
    }

}

