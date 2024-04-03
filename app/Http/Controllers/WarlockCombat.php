<?php

namespace App\Http\Controllers;


class WarlockCombat extends Controller
{

    //transportar turn na funcao para as futuras skills
    //Combat de warlock, cada classe tem o seu porque podem ter atributos diferentes
    public static function WarlockAttack(){

        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damage = "$damage";
        $damage = $damage*0.7 + ($damage / rand(3, 5));
        $skilldamage = "$skilldamage";

        //Este classpecial é para interagir com as futuras skills que de momento não estão disponiveis
        $ClassSpecial = "$ClassSpecial";

        $damagedealt= $damage;


        return (float) number_format($damagedealt,2);

    }
    public static function WarlockDefend($damagereceived){
        
        $gettruestats = GeneratePlayerStats::GenerateStats();
        extract($gettruestats);

        $damagereduction = "$damagereduction";

        

        $damagereduced=($damagereduction/100)*$damagereceived;
        $damagetaken=$damagereceived-$damagereduced;

        //Evita curar ao ter demasiado dano reduzido
        if($damagetaken<0){
            $damagetaken=0;
        }

        return (float) number_format($damagetaken,2);

    }
}
