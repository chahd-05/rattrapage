<?php

namespace App\Models;

use App\Models\Reservation;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title',
        'author',
        'description',
        'status'
    ];
    
public function reservations()
{
    return $this->hasMany(Reservation::class);
}

public function loans()
{
    return $this->hasMany(Loan::class);
}

}
