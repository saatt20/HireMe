<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi
    protected $fillable = [
        'user_id', 'phone_number', 'gender', 'linkedin', 'address', 'provinsi', 'kota', 'photo',
        'company_description', 'company_email', 'company_phone', 'company_logo',
    ];

    // Relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
