<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MissionOptionRequest;
use App\Models\UserCharacter;
use App\Models\user_shops;
use App\Models\Items;

class PlayerMenusController extends Controller
{
    //Retorna a view da chooseclass mas se já estiver uma class escolhida redireciona para o playerprofile
    public function chooseclass()
    {
        $user_id = Auth::user()->id;
        $class = DB::table('user_characters')->where('id', '=', $user_id)->value('class');
        if ($class != '') {
            return redirect()->route('playerprofile');
        }
        return view('chooseclass');
    }

    //Mostra os mobs possiveis de derrotar nas missoes
    public function missionsmobs()
    {
        $mobs = DB::table('mobsmissions')->get();
        return view('playermissions', ['mobs' => $mobs]);
    }

    //Mostra o resultado do combate nas missoes
    public function returncombatview(MissionOptionRequest $request)
    {

        $optionvalue = $request->option;
        $combatinfo = CombatPVE::combat($optionvalue);

        extract($combatinfo);


        return view(
            'playermissions',
            [
                'class' => "$class",
                'mobimg' => "$mobimg",
                'playermissinghp' => "$playermissinghp",
                'mobmissinghp' => "$mobmissinghp",
                'combatlog' => $combatlog,
                'itemgenerated'=>$itemgenerated
            ]
        );
    }
    public function returnshopinfo()
    {

        $user_id = Auth::user()->id;
        $CharInfo = UserCharacter::where('id', '=', $user_id)->get(); 
        $ShopInfo = User_shops::where('user_id', '=', $user_id)->get();
        $class= $CharInfo[0]->class;

        $unlockshopoption =0;
        if($ShopInfo->isEmpty()){
            $unlockshopoption =1;
        }
        $itemsinfoarray=[];
        if($unlockshopoption==0){
            for ($i=1; $i < 6; $i++) { 
            
                $string='shopitem' . strval($i);
                $b=$ShopInfo[0]->$string; 
    
                $a=Items::where('id', '=',$b)->first();
                array_push($itemsinfoarray,$a);
    
            } 
        }
        $usershopinfo=User_shops::where('user_id', '=', $user_id)->first();
            switch ($usershopinfo->reputationlevel) {
                case 0:
                    $valuemultiplier=30;
                    break;
                case 1:
                    $valuemultiplier=28;
                    break;
                case 2:
                    $valuemultiplier=24;
                    break;
                case 3:
                    $valuemultiplier=20;
                    break;

            }
        

          
        
        return view(
            'playershop',
            [
                'CharInfo'=>$CharInfo,
                'UnlockShop'=>$unlockshopoption,
                'ShopInfo'=>$ShopInfo,
                'ItemsInShopArray'=>$itemsinfoarray,
                'class'=>$class,
                'valuemultiplier'=>$valuemultiplier
            ]
        );
        
    }

    



}
