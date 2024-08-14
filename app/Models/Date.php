<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;
    protected $table = 'dates';
    public $timestamps = false;
    protected $fillable = [
        'date'
    ];

    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
