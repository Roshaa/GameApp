<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player_shop extends Model
{

    public $timestamps = false;
    protected $fillable = [
        'item1',
        'item2',
        'item3',
        'item4',
        'item5',
        'item6',
        'shopupgrade1',
        'shopupgrade2',
        'shopupgrade3',
        'shopupgrade4'
    ];
}
