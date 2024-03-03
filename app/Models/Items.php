<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['itemname','user_owner_id','stat1','stat2','stat3','stat4','stat5','stat6','armor','damage','specialeffect1','specialeffect2','specialeffect3','specialeffect4','imglink','type','rarity'];
    //protected $guarded=['password'];


}
