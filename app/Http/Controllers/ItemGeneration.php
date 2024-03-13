<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GeneratePlayerStats;


use App\Models\Items;
use App\Models\UserCharacter;
use App\Models\PlayerInventory;


class ItemGeneration extends Controller
{

    //Gera um item aleatorio e grava no inventario do jogador, na altura em que isto está ser escrito so funciona para os 3 mobs nas missoes
    public static function missionitemgeneration($mobtier)
    {

        $user_id = Auth::user()->id;
        $class = UserCharacter::where('id', '=', $user_id)->value('class');
        $level = UserCharacter::where('id', '=', $user_id)->value('level');

        //1 common, 2 uncommon, 3 rare, 4 epic
        //controlar com mob tier no futuro
        $itemrarityroll = rand(0, 99);
        if(($mobtier=2)){$itemrarityroll=rand(51, 99);}
        switch ($itemrarityroll) {
            case $itemrarityroll <= 50:
                $itemrarityroll = 'common';
                break;

            case $itemrarityroll >= 51 && $itemrarityroll < 80:
                $itemrarityroll = 'uncommon';
                break;

            case $itemrarityroll >= 81 && $itemrarityroll < 95:
                $itemrarityroll = 'rare';
                break;

            case $itemrarityroll >= 95:
                $itemrarityroll = 'epic';
                break;
        }


        //é necessario controlar o item generation perante o tipo de item, no momento que isto esta a ser escrito só da para generar armor
        function getrandomstatvalue($level)
        {
            return rand($level * 3.5, $level * 6);
        }

        $itemvalue=getrandomstatvalue($level)*0.8;
        $getrandomitemtype = rand(1, 7);

        /*
            stat 1 -> main stat
            stat 2 -> Willpower
            stat 3 -> Constituion
            stat 4 -> Expertise
            stat 5 -> Resistance
            stat 6 -> Mastery
        */


        //necessario optimizar depois
        $randomstatsarray = [2, 3, 4, 5, 6];
        $getrandomstattofill1 = $randomstatsarray[rand(0, 4)];
        $getrandomstattofill2 = $randomstatsarray[rand(0, 4)];
        while ($getrandomstattofill2 == $getrandomstattofill1) {
            $getrandomstattofill2 = $randomstatsarray[rand(0, 4)];
        }
        $getrandomstattofill3 = $randomstatsarray[rand(0, 4)];
        while ($getrandomstattofill3 == $getrandomstattofill2) {
            $getrandomstattofill3 = $randomstatsarray[rand(0, 4)];
        }

        $dbrandomstatstring1 = 'stat' . strval($getrandomstattofill1);
        $dbrandomstatstring2 = 'stat' . strval($getrandomstattofill2);
        $dbrandomstatstring3 = 'stat' . strval($getrandomstattofill3);

        switch ($getrandomitemtype) {
            case $getrandomitemtype == 1:
                $itemtype = 'Head';
                break;
            case $getrandomitemtype == 2:
                $itemtype = 'Chest';
                break;
            case $getrandomitemtype == 3:
                $itemtype = 'Gloves';
                break;
            case $getrandomitemtype == 4:
                $itemtype = 'Boots';
                break;
            case $getrandomitemtype == 5:
                $itemtype = 'ProfessionTool';
                break;
            case $getrandomitemtype == 6:
                $itemtype = 'Ring';
                break;
            case $getrandomitemtype == 7:
                $itemtype = 'Weapon';
                break;
                /*

            //Por desenvolver
            case $getrandomitemtype == 8:
                $itemtype = 'Relic';
                break;
            case $getrandomitemtype == 9:
                $itemtype = 'Potion';
                break;*/
        }

        $Items = new Items;
        $Items->user_owner_id = $user_id;
        $Items->itemname = 'NoName';
        $Items->type = $itemtype;
        $Items->rarity = $itemrarityroll;
        $Items->value=$itemvalue;

        if ($itemtype == 'Head' || $itemtype == 'Chest' || $itemtype == 'Gloves' || $itemtype == 'Boots') {
            $Items->armor = rand($level * 10, $level * 20);
        }
        if ($itemtype == 'Weapon') {
            $Items->damage = rand($level * 15, $level * 20);
        }



        switch ($itemrarityroll) {
            case $itemrarityroll == 'common':

                if ($itemtype == 'Weapon') {
                    $Items->stat1 = getrandomstatvalue($level) * 2;
                } else if ($itemtype == 'ProfessionTool') {
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level) * 2;
                } else {
                    $Items->stat1 = getrandomstatvalue($level);
                }
                break;
            case $itemrarityroll == 'uncommon':

                if ($itemtype == 'Weapon') {
                    $Items->stat1 = getrandomstatvalue($level) * 2.3;
                } else if ($itemtype == 'ProfessionTool') {
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level) * 2.3;
                } else {
                    $Items->stat1 = getrandomstatvalue($level);
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level);
                }
                break;
            case $itemrarityroll == 'rare':

                if ($itemtype == 'Weapon') {
                    $Items->stat1 = getrandomstatvalue($level) * 2.6;
                } else if ($itemtype == 'ProfessionTool') {
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level) * 2.6;
                } else {
                    $Items->stat1 = getrandomstatvalue($level);
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level);
                    $Items->$dbrandomstatstring2 = getrandomstatvalue($level);

                }
                break;
            case $itemrarityroll == 'epic':

                if ($itemtype == 'Weapon') {
                    $Items->stat1 = getrandomstatvalue($level) * 3;
                } else if ($itemtype == 'ProfessionTool') {
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level) * 3;
                } else {
                    $Items->stat1 = getrandomstatvalue($level);
                    $Items->$dbrandomstatstring1 = getrandomstatvalue($level);
                    $Items->$dbrandomstatstring2 = getrandomstatvalue($level);
                    $Items->$dbrandomstatstring3 = getrandomstatvalue($level);
                }

                break;
        }

        $Inventoryid = PlayerInventory::where('user_id', '=', $user_id)->value('id');
        $PlayerInventory = PlayerInventory::find($Inventoryid);
        $bagslotstring = ItemsController::verifyavailablebagslot();

        if ($bagslotstring != 'FullBag') {
            $Items->save();
            $LastItem = Items::where('user_owner_id', '=', $user_id)->orderBy('id', 'desc')->first();
            $PlayerInventory->$bagslotstring = $LastItem->id;
            $PlayerInventory->save();
        }
    }
}
