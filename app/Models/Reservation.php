<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'Reservations';

    protected $fillable = [
        'driverId',
        'passengerId',
        'routeId',
        'seats',
        'resDate',
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

    public function route()
    {
        return $this->belongsTo(Route::class, 'routeId');
    }



}
