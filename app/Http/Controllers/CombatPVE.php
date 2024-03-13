<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Controllers\ItemGeneration;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\AssassinCombat;
use App\Http\Controllers\WarlockCombat;
use App\Http\Controllers\PaladinCombat;
use App\Http\Controllers\PlayerRewardsGeneration;

use App\Models\mobsmissions;
use App\Models\UserCharacter;




class CombatPVE extends Controller
{

    //Isto é o combate (PVE) falta adicionar as habilidades e animações por segundo
    public static function combat($mobchosen)
    {

        $user_id = Auth::user()->id;
        $class = UserCharacter::where('id', '=', $user_id)->value('class');
        $level = UserCharacter::where('id', '=', $user_id)->value('level');

        $mobinfo=mobsmissions::find($mobchosen);

        $mobname = $mobinfo->MobName;
        $mobhp = $mobinfo->BaseHP;
        $mobhp=$mobhp+($mobhp*($level*0.7));
        $mobdamage = $mobinfo->BaseDamage;
        $mobtier = $mobinfo->MobTier;
        $mobimg = $mobinfo->imglink;
        
        $mobexp=$mobinfo->mobexp;
        $incrementalexp=$level*0.05;
        $mobexp=$mobexp*(1+$incrementalexp);

        $getstats = GeneratePlayerStats::GenerateStats();
        extract($getstats);
        $playerhp = "$hp";
        $playerhp=str_replace(",","",$playerhp);


        while ($mobhp >= 0 && $playerhp >= 0) {
            $mobrandomdamage = $mobdamage + ($mobdamage / rand(1, 5)) * ($level * 1.3);
            switch ($class) {
                case "Assassin":

                    $playerattack = AssassinCombat::AssassinAttack();
                    $playerdefend = AssassinCombat::AssassinDefend($mobrandomdamage);

                    break;
                case "Paladin":

                    $playerattack = PaladinCombat::PaladinAttack();
                    $playerdefend = PaladinCombat::PaladinDefend($mobrandomdamage);
                   


                    break;
                case "Warlock":

                    $playerattack = WarlockCombat::WarlockAttack();
                    $playerdefend = WarlockCombat::WarlockDefend($mobrandomdamage);

                    break;
            }


            $mobhp = $mobhp - $playerattack;
            echo "Player Attack: " . "$playerattack" . "<br>";
            $playerhp = $playerhp - $playerdefend;
            echo "Player DamageTaken: " . "$playerdefend" . "<br>";
        }

        $combatresult = [

            'playermissinghp' => number_format($playerhp, 2),
            'mobmissinghp' => number_format($mobhp, 2),

        ];
        extract($combatresult);
        $combatresultinfo =
            [
                'class' => $class,
                'mobimg' => $mobimg,
                'playermissinghp' => "$playermissinghp",
                'mobmissinghp' => "$mobmissinghp",
            ];


        if ($mobhp <= 0) {

            ItemGeneration::missionitemgeneration($mobtier);
            PlayerRewardsGeneration::expreward($mobexp);

        }


        return $combatresultinfo;
    }
}
