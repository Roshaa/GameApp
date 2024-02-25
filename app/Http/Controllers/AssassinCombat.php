<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\Controller;

class AssassinCombat extends Controller
{
    //transportar turn na funcao para as futuras skills
    public static function AssassinAttack(){

        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damage = "$damage";
        $skilldamage = "$skilldamage";
        $ClassSpecial = "$ClassSpecial";

        $critroll=rand(0,99);

        $damagedealt= $damage;
        if($critroll <= $ClassSpecial ){
            $damagedealt=$damagedealt*2;
        }

        return $damagedealt;

    }
    public static function AssassinDefend($damagereceived){
        
        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damagereduction = "$damagereduction";

        $roguestaticdodgechance=rand(0,99);
        if($roguestaticdodgechance <= 30 ){
            $damagetaken=0;
            return $damagetaken;
        }

        $damagereduced=($damagereduction/100)*$damagereceived;
        $damagetaken=$damagereceived-$damagereduced;

        return $damagetaken;

    }

}
