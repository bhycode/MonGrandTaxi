<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $fillable = [
        'travelHour',
        'travelDate',
        'departCity',
        'arriveCity',
    ];

    public $timestamps = false;

    public function departureCity()
    {
        return $this->belongsTo(City::class, 'departCity');
    }

    public function arrivalCity()
    {
        return $this->belongsTo(City::class, 'arriveCity');
    }
}
