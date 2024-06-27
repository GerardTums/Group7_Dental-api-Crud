<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model

{
    use HasFactory;

    protected $fillable = [
        'dentist_id',
        'nurse_id',
        'user_id',
        'procedure_id',
        'treatment_date',
        'treatment_time',];

    public function nurse(){
        return $this->belongsTo(Nurse::class);
    }
    public function profile(){
        return $this->belongsTo(Profile::class);
    }
}
