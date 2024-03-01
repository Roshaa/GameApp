<?php

namespace App\Http\Controllers;


class PaladinCombat extends Controller
{

    //transportar turn na funcao para as futuras skills
    //Combat de paladin, cada classe tem o seu porque podem ter atributos diferentes
    public static function PaladinAttack(){

        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damage = "$damage";
        $skilldamage = "$skilldamage";


        $damagedealt= $damage;


        return $damagedealt;

    }
    public static function PaladinDefend($damagereceived){
        
        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damagereduction = "$damagereduction";

        $ClassSpecial = "$ClassSpecial";
        $hp="$hp";
        $restorehp=$hp*($ClassSpecial/100);

        $damagereduced=($damagereduction/100)*$damagereceived;
        $damagetaken=$damagereceived-$damagereduced-$restorehp;

        return $damagetaken;

    }
}
