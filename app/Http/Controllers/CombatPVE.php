<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\AssassinCombat;
use App\Http\Controllers\WarlockCombat;
use App\Http\Controllers\PaladinCombatt;



class CombatPVE extends Controller
{
    public static function combat($mobchosen){

        $user_id = Auth::user()->id;
        $class = DB::table('user_characters')->where('user_id', '=', $user_id)->value('class');
        $level = DB::table('user_characters')->where('user_id', '=', $user_id)->value('level');

        $mobname=DB::table('mobsmissions')->where('id', '=', $mobchosen)->value('MobName');
        $mobhp=DB::table('mobsmissions')->where('id', '=', $mobchosen)->value('BaseHP');
        $mobdamage=DB::table('mobsmissions')->where('id', '=', $mobchosen)->value('BaseDamage');
        $mobtier=DB::table('mobsmissions')->where('id', '=', $mobchosen)->value('MobTier');
        $mobimg=DB::table('mobsmissions')->where('id', '=', $mobchosen)->value('imglink');


        $getstats = GeneratePlayerStats::GenerateStats();
        extract($getstats);
        $playerhp = "$hp";

        switch ($class) {
            case "Assassin":

                $playerattack=AssassinCombat::AssassinAttack();
                $playerdefend=AssassinCombat::AssassinDefend($mobdamage);

            break;
            case "Paladin":
                
            break;
            case "Warlock":
                
            break;
        }

            while ($mobhp>0 && $playerhp>0) {

            $mobhp=$mobhp-$playerattack;
            $playerhp=$playerhp-$playerdefend;
            
             }




        $combatresult=[
            'playermissinghp'=>$playerhp,
            'mobmissinghp'=>$mobhp,

        ];
        extract($combatresult);
        $combatinfo=
            [
                'class'=>$class,
                'mobimg' => $mobimg,
                'playermissinghp'=>"$playermissinghp",
                'mobmissinghp'=>"$mobmissinghp",
            ];

        return $combatinfo;

    }


    
}
