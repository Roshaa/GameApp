@extends('Layouts.app')
@section('pagecontent')
    <div class="w-full h-full bg-opacity-25 bg-no-repeat bg-cover text-white"
        style="background-image: url( 'images/playershopbackground.jpg'  );">
        <div class="w-full text-center h-full pt-5 flex">

            @if ($UnlockShop == 1)
                <form action="/unlockshop" method="POST">
                    @csrf
                    <button type="submit">Teste</button>
                </form>
            @endif

            @if ($UnlockShop == 0)
                <div class="w-3/12 pl-5"> <img src="images/playershopvendor.jpg" alt=""></div>
                <div class="w-6/12">
                    <div>

                        @foreach ($ItemsInShopArray as $Item)
                            @if ($Item)
                                <form method="POST" class="h-12 w-full border-b-2 flex" action="/shopbuy" class="mt-5">
                                    @csrf
                                    <img class=""
                                        src="
                                @switch($Item->type)
                                @case('Head')
                                    {{ 'images/icons/elf-helmet.svg' }}
                                @break
                            
                                @case('Chest')
                                    {{ 'images/icons/chest-armor.svg' }}
                                @break
                            
                                @case('Gloves')
                                    {{ 'images/icons/gloves.svg' }}
                                @break
                            
                                @case('Boots')
                                    {{ 'images/icons/leg-armor.svg' }}
                                @break
                            
                                @case('Weapon')
                                    {{ 'images/icons/sword-wound.svg' }}
                                @break
                            
                                @case('Ring')
                                    {{ 'images/icons/ring.svg' }}
                                @break
                            
                                @case('ProfessionTool')
                                    {{ 'images/icons/anvil-impact.svg' }}
                                @break
                            
                                @default
                            @endswitch
                                "
                                        alt="">
                                    <button disabled class="ml-2 w-full text-left">



                                        @if ($Item->stat1 != '')
                                            @switch($class)
                                                @case('Assassin')
                                                    {{ 'DEX: ' }}
                                                @break

                                                @case('Paladin')
                                                    {{ 'STR: ' }}
                                                @break

                                                @case('Warlock')
                                                    {{ 'INT: ' }}
                                                @break
                                            @endswitch {{ $Item->stat1 }}
                                        @endif
                                        @if ($Item->stat2 != '')
                                            WLP: {{ $Item->stat2 }}
                                        @endif
                                        @if ($Item->stat3 != '')
                                            CON: {{ $Item->stat3 }}
                                        @endif
                                        @if ($Item->stat4 != '')
                                            EXP: {{ $Item->stat4 }}
                                        @endif
                                        @if ($Item->stat5 != '')
                                            RES: {{ $Item->stat5 }}
                                        @endif
                                        @if ($Item->stat6 != '')
                                            MAS: {{ $Item->stat6 }}
                                        @endif
                                        @if ($Item->armor != '')
                                            AR: {{ $Item->armor }}
                                        @endif
                                        @if ($Item->damage != '')
                                            DAM: {{ $Item->damage }}
                                        @endif
                                        @if ($Item->specialeffect1 != '')
                                            SE1: {{ $Item->specialeffect1 }}
                                        @endif
                                        @if ($Item->specialeffect2 != '')
                                            SE2: {{ $Item->specialeffect2 }}
                                        @endif
                                        @if ($Item->specialeffect3 != '')
                                            SE3: {{ $Item->specialeffect3 }}
                                        @endif
                                        @if ($Item->specialeffect4 != '')
                                            SE4: {{ $Item->specialeffect4 }}
                                        @endif
                                        @if ($Item->rarity != '')
                                            <span class="mr-5 float-end item{{ $Item->rarity }}">
                                                {{ $Item->rarity }}</span>
                                        @endif
                                        @if ($Item->value != '')
                                            <span class="mr-5 float-end">Value:
                                                {{ $Item->value * 30}}</span>
                                        @endif

                                        <span>
                                            <button type="submit" value="{{ $Item->id }}" name='itemid'
                                                class="text-white">Buy</button>
                                        </span>
                                </form>
                            @endif
                        @endforeach


                    </div>

                    <form method="POST" action="/shoprestock" class="mt-5">
                        @csrf
                        <button type="submit" class="border p-2 border-white rounded text-orange-400">Restock</button>
                    </form>
                </div>
                <div class="w-3/12 pr-5">
                    <div>Reputation <br>{{ $ShopInfo[0]->reputation }}</div>
                    <div>Reputation Level <br>{{ $ShopInfo[0]->reputationlevel }}</div>
                    @if ($ShopInfo[0]->shopitems != 3)
                        <div class="mt-5">
                            <form method="POST" action="/shopupgrade">
                                @csrf
                                <div>Stock Level<br>{{ $ShopInfo[0]->shopitems }}</div>
                                <button type="submit"
                                    class="border p-2 border-white rounded text-orange-400">Upgrade</button>
                                <p>
                                    @switch($ShopInfo[0]->shopitems)
                                        @case(0)
                                            30000
                                        @break

                                        @case(1)
                                            100000
                                        @break

                                        @case(2)
                                            1000000
                                        @break

                                        @default
                                    @endswitch
                                </p>
                            </form>
                        </div>
                    @endif

                    <div class="mt-5"> Gold: {{ $CharInfo[0]->gold }}</div>
                </div>
            @endif

        </div>

    </div>
@endsection
