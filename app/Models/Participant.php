<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'webinar_id'];

    // Relasi ke webinar
    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }
}
