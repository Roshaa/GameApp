<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User_shops;
use App\Models\UserCharacter;
use App\Models\Items;
use Illuminate\Support\Facades\Auth;
use App\Models\PlayerInventory;


class ShopController extends Controller
{
    public function unlockshop()
    {
        $user_id = Auth::user()->id;
        $playergold = UserCharacter::where('id', '=', Auth::user()->id)->value('gold');
        $ShopInfo = User_shops::where('user_id', '=', $user_id)->get();

        if ($ShopInfo->isEmpty()) {
            if ($playergold >= 10000) {

                $user_character = UserCharacter::where('id', '=', Auth::user()->id)->first();
                $user_character->gold = $playergold - 10000;

                $user_shop = new user_shops;
                $user_shop->user_id = $user_id;
                $user_shop->shopunlocked = 1;

                $user_shop->save();
                $user_character->save();

                return redirect()->route('playershop');

            }
        }

    }

    public function shopupgrade()
    {

        $user_id = Auth::user()->id;

        $ShopInfo = User_shops::where('user_id', '=', $user_id)->first();
        $playergold = UserCharacter::where('id', '=', Auth::user()->id)->value('gold');
        $user_character = UserCharacter::where('id', '=', Auth::user()->id)->first();

        $currentshoplevel = $ShopInfo->shopitems;

        if ($currentshoplevel == 0 && $playergold >= 30000) {

            $ShopInfo->shopitems = 1;
            $user_character->gold = $playergold - 30000;

        } else if ($currentshoplevel == 1 && $playergold >= 100000) {

            $ShopInfo->shopitems = 2;
            $user_character->gold = $playergold - 100000;

        } else if ($currentshoplevel == 2 && $playergold >= 1000000) {

            $ShopInfo->shopitems = 3;
            $user_character->gold = $playergold - 1000000;

        }

        $ShopInfo->save();
        $user_character->save();
        return redirect()->route('playershop');
    }

    public function shoprestock()
    {
        $user_id = Auth::user()->id;
        $ShopInfo = User_shops::where('user_id', '=', $user_id)->first();
        $unlockedslots = 3 + $ShopInfo->shopitems;


        for ($i = 1; $i <= $unlockedslots; $i++) {
            $shopitemstring = 'shopitem' . $i;
            ItemGeneration::shopitemgeneration($shopitemstring);
        }

        return redirect()->route('playershop');
    }


    public function shopbuy(Request $request)
    {
        $user_id = Auth::user()->id;

        $verifyitemownage = Items::where('id', '=', $request->itemid)->value('user_owner_id');
        $usercharacter = UserCharacter::where('id', '=', Auth::user()->id)->first();

        if ($verifyitemownage != '') {
            $itembought = Items::find($request->itemid);

            $Inventoryid = PlayerInventory::where('user_id', '=', $user_id)->value('id');
            $PlayerInventory = PlayerInventory::find($Inventoryid);
            $bagslotstring = ItemsController::verifyavailablebagslot();

            if ($bagslotstring != 'FullBag') {

                for ($i = 1; $i <= 6; $i++) {
                    $shopslotstring = 'shopitem' . $i;
                    $deleteonshop = User_shops::where('user_id', '=', $user_id)
                        ->where($shopslotstring, '=', $request->itemid)
                        ->first();
                        if ($deleteonshop) {
                            $deleteonshop->$shopslotstring = null;
                            $deleteonshop->save();
                        }
                }
                $usercharacter->gold = $usercharacter->gold - $itembought->value*30;
                $PlayerInventory->$bagslotstring = $itembought->id;
                $PlayerInventory->save();
                $usercharacter->save();

            }


        }

        return redirect()->route('playershop');
    }


}
