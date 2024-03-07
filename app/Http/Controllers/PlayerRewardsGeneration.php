<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\UserCharacter;
class PlayerRewardsGeneration extends Controller
{
    public static function expreward ($exp){

        $user_id = Auth::user()->id;
        $CharacterInfo = Usercharacter::find($user_id);

        $level = $CharacterInfo['level'];

        $exp=$exp+($exp*($level/8));
        $CharacterInfo->currentlvlexp=$CharacterInfo->currentlvlexp+$exp;

        if($CharacterInfo->currentlvlexp>=$CharacterInfo->exptonextlevel){
            $CharacterInfo->currentlvlexp=0;
            $CharacterInfo->level=$level+1;
            $CharacterInfo->exptonextlevel=$CharacterInfo->exptonextlevel*1.3;
        }
        $CharacterInfo->save();
    }
}
