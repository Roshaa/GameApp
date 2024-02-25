<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobsmissions extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['MobName','BaseHP','BaseDamage','MobTier'];
}
