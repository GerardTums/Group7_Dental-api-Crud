<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model

{
    use HasFactory;

    protected $fillable = [];

    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
