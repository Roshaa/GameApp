<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

Use App\Http\Controllers\ItemGeneration;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\AssassinCombat;
use App\Http\Controllers\WarlockCombat;
use App\Http\Controllers\PaladinCombat;

use App\Models\Items;
use App\Models\mobsmissions;
use App\Models\UserCharacter;




class CombatPVE extends Controller
{
    public static function combat($mobchosen)
    {

        $user_id = Auth::user()->id;
        $class = UserCharacter::where('user_id', '=', $user_id)->value('class');
        $level = UserCharacter::where('user_id', '=', $user_id)->value('level');

        $mobname = mobsmissions::where('id', '=', $mobchosen)->value('MobName');
        $mobhp = mobsmissions::where('id', '=', $mobchosen)->value('BaseHP');
        $mobdamage = mobsmissions::where('id', '=', $mobchosen)->value('BaseDamage');
        $mobtier = mobsmissions::where('id', '=', $mobchosen)->value('MobTier');
        $mobimg = mobsmissions::where('id', '=', $mobchosen)->value('imglink');


        $getstats = GeneratePlayerStats::GenerateStats();
        extract($getstats);
        $playerhp = "$hp";

        switch ($class) {
            case "Assassin":

                $playerattack = AssassinCombat::AssassinAttack();
                $playerdefend = AssassinCombat::AssassinDefend($mobdamage);

                break;
            case "Paladin":

                break;
            case "Warlock":

                break;
        }

        while ($mobhp > 0 && $playerhp > 0) {

            $mobhp = $mobhp - $playerattack;
            $playerhp = $playerhp - $playerdefend;
        }

        $combatresult = [
            'playermissinghp' => $playerhp,
            'mobmissinghp' => $mobhp,

        ];
        extract($combatresult);
        $combatresultinfo =
            [
                'class' => $class,
                'mobimg' => $mobimg,
                'playermissinghp' => "$playermissinghp",
                'mobmissinghp' => "$mobmissinghp",
            ];


            if($mobhp<=0){

                ItemGeneration::missionitemgeneration();

            }
        
        
        return $combatresultinfo;
    }
}
