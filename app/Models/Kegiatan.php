<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [ 'tanggal', 'waktu', 'kegiatan', 'name', 'user_id'];

    public function boy() {
        return $this->hasMany(User::class);
    }
}
