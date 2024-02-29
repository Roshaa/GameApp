<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerInventory extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['equipslot1','equipslot2','equipslot3','equipslot4','equipslot5','equipslot6','equipslot7','equipslot8','equipslot9','equipslot10','equipslot11','equipslot12','equipslot13','equipslot14'
,'bagslot1','bagslot2','bagslot3','bagslot4','bagslot5','bagslot6','bagslot7','bagslot8','bagslot9','bagslot10'

];
    
}
