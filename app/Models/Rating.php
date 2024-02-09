<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = 'Ratings';

    protected $fillable = [
        'rateValue',
        'driverId',
        'passengerId',
        'comment',
    ];

    public $timestamps = false;

    public function driver()
    {
        return $this->belongsTo(User::class, 'driverId');
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'passengerId');
    }
}
