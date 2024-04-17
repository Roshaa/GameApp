<?php

namespace App\Http\Controllers;

use App\Http\Controllers\GeneratePlayerStats;
use App\Http\Controllers\Controller;

class AssassinCombat extends Controller
{
    //transportar turn na funcao para as futuras skills
    //Combat de assassin, cada classe tem o seu porque podem ter atributos diferentes
    public static function AssassinAttack(){

        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damage = "$damage";
        $damage = $damage*0.7 + ($damage / rand(3, 5));
        $skilldamage = "$skilldamage";
        $ClassSpecial = "$ClassSpecial";

        $critroll=rand(1,100);

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

        //Evita curar ao ter demasiado dano reduzido
        if($damagetaken<0){
            $damagetaken=0;
        }

        return $damagetaken;

    }

}
