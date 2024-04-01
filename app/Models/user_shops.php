<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_shops extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[

        'user_id',
        'shopunlocked',
        'shopitems',
        'reputationlevel',
        'reputation',
        'shopitem1',
        'shopitem2',
        'shopitem3',
        'shopitem4',
        'shopitem5',
        'shopitem6',
        
    ];
}
