<?php

namespace App\Http\Controllers;


class WarlockCombat extends Controller
{
    public static function WarlockAttack(){

        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damage = "$damage";
        $skilldamage = "$skilldamage";

        //Este classpecial é para interagir com as futuras skills que de momento não estão disponiveis
        $ClassSpecial = "$ClassSpecial";

        $damagedealt= $damage;


        return $damagedealt;

    }
    public static function WarlockDefend($damagereceived){
        
        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damagereduction = "$damagereduction";

        

        $damagereduced=($damagereduction/100)*$damagereceived;
        $damagetaken=$damagereceived-$damagereduced;

        return $damagetaken;

    }
}
