@extends('Layouts.app')
@section('pagecontent')
    <div class="flex w-full h-full bg-no-repeat bg-cover"
        style="background-image: url(
@switch($class)
@case('Assassin')
{{ 'images/assassinbackground.jpg' }}
@break

@case('Paladin')
{{ 'images/paladinbackground.jpg' }}
@break

@case('Warlock')
{{ 'images/warlockbackground.jpg' }}
@break

@default
@endswitch );">
        <div class="w-3/12 mt-5 text-white">

            <div class="mx-10">

                <div class="border-2 rounded border-slate-700 text-center p-5 font-medium">
                    <h2 class="text-2xl">{{ $playername }}</h2>
                    <h5>Level: {{ $CharInfo[0]->level }}</h5>

                </div>
                @switch($class)
                    @case('Assassin')
                        <img src="images/assassinclass.jpg" class="mt-3" alt="">
                    @break

                    @case('Paladin')
                        <img src="images/paladinclass.jpg" class="mt-3" alt="">
                    @break

                    @case('Warlock')
                        <img src="images/warlockclass.jpg" class="mt-3" alt="">
                    @break

                    @default
                @endswitch
            </div>
            <div class="flex mt-5 text-white">
                <div class=" ml-10">
                    <p> @switch($class)
                            @case('Assassin')
                                {{ 'Dexterity: ' }}
                            @break

                            @case('Paladin')
                                {{ 'Strength: ' }}
                            @break

                            @case('Warlock')
                                {{ 'Intelligence: ' }}
                            @break
                        @endswitch {{ $GetStats['mainstat'] }}</p>


                    <p>Willpower: {{ $GetStats['Willpower'] }}</p>
                    <p>Constituion: {{ $GetStats['Constituion'] }}</p>
                    <p>Expertise: {{ $GetStats['Expertise'] }}</p>
                    <p>Resistance: {{ $GetStats['Resistance'] }}</p>
                    <p>Mastery: {{ $GetStats['Mastery'] }}</p>
                </div>
                <div class="ml-5">
                    <p>Alchemy: {{ $GetStats['Alchemy'] }}</p>
                    <p>Armoursmith: {{ $GetStats['Armoursmith'] }}</p>
                    <p>Weaponsmith: {{ $GetStats['Weaponsmith'] }}</p>
                    <p>Jewellery: {{ $GetStats['Jewellery'] }}</p>
                    <p>Librarian {{ $GetStats['Librarian'] }}</p>
                </div>
                <div class="ml-5">
                    <p>HP: {{ $GetStats['hp'] }}</p>
                    <p>Damage: {{ $GetStats['damage'] }}</p>
                    <p>Skill Damage: {{ $GetStats['skilldamage'] }}</p>
                    <p>Damage Reduction: {{ $GetStats['damagereduction'] }}</p>
                    <p>Armor: {{ $GetStats['armor'] }}</p>
                    <p>
                        @switch($class)
                            @case('Assassin')
                                {{ 'Critical Strike: ' }}
                            @break

                            @case('Paladin')
                                {{ 'Self Heal: ' }}
                            @break

                            @case('Warlock')
                                {{ 'Mana: ' }}
                            @break
                        @endswitch
                        {{ $GetStats['ClassSpecial'] }}</p>
                </div>
            </div>
        </div>

        <div class="w-9/12 mt-5 text-white mr-10">
            <h1 class="text-2xl mb-5 border-t-2">Equipped</h1>
            <form class="" action="" method="POST">
                @for ($i = 0; $i <= 15; $i++)
                    @isset($EquipItemsArray[$i])
                        @csrf
                        <div class="h-12 w-full flex border-b-2">
                            <img class=""
                                src="
                                @switch($EquipItemsArray[$i]->type)
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



                                @if ($EquipItemsArray[$i]->stat1 != '')
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
                                    @endswitch {{ $EquipItemsArray[$i]->stat1 }}
                                @endif
                                @if ($EquipItemsArray[$i]->stat2 != '')
                                    WLP: {{ $EquipItemsArray[$i]->stat2 }}
                                @endif
                                @if ($EquipItemsArray[$i]->stat3 != '')
                                    CON: {{ $EquipItemsArray[$i]->stat3 }}
                                @endif
                                @if ($EquipItemsArray[$i]->stat4 != '')
                                    EXP: {{ $EquipItemsArray[$i]->stat4 }}
                                @endif
                                @if ($EquipItemsArray[$i]->stat5 != '')
                                    RES: {{ $EquipItemsArray[$i]->stat5 }}
                                @endif
                                @if ($EquipItemsArray[$i]->stat6 != '')
                                    MAS: {{ $EquipItemsArray[$i]->stat6 }}
                                @endif
                                @if ($EquipItemsArray[$i]->armor != '')
                                    AR: {{ $EquipItemsArray[$i]->armor }}
                                @endif
                                @if ($EquipItemsArray[$i]->damage != '')
                                    DAM: {{ $EquipItemsArray[$i]->damage }}
                                @endif
                                @if ($EquipItemsArray[$i]->specialeffect1 != '')
                                    SE1: {{ $EquipItemsArray[$i]->specialeffect1 }}
                                @endif
                                @if ($EquipItemsArray[$i]->specialeffect2 != '')
                                    SE2: {{ $EquipItemsArray[$i]->specialeffect2 }}
                                @endif
                                @if ($EquipItemsArray[$i]->specialeffect3 != '')
                                    SE3: {{ $EquipItemsArray[$i]->specialeffect3 }}
                                @endif
                                @if ($EquipItemsArray[$i]->specialeffect4 != '')
                                    SE4: {{ $EquipItemsArray[$i]->specialeffect4 }}
                                @endif
                                @if ($EquipItemsArray[$i]->rarity != '')
                                    <span
                                        class="mr-5 float-end item{{ $EquipItemsArray[$i]->rarity }}">{{ $EquipItemsArray[$i]->rarity }}</span>
                                @endif
                            </button>
                            <button class="mx-2 ml-auto" type="submit" value="{{ $EquipItemsArray[$i]->id }}"
                                name="Unequip">Unequip</button>
                        </div>
                    @endisset
                @endfor

            </form>

<div class="flex w-full h-12 text-2xl border-t-2 mb-3 mt-10 justify-start text-center">

    <h1 class="text-2xl mr-auto">Inventory      {{$BagSlots}} / 10 Slots</h1>
    <button class="h-12 w-36 flex" disabled>{{$CharInfo[0]->gold}}<img class="h-12 w-12" src="images/icons/two-coins.svg" alt=""></button>
        

    
</div>
            

            <div class="mt-4 w-full">

                {{-- Alterar para uma table no futuro --}}
                <form action="" method="POST">
                    @for ($i = 1; $i <= 10; $i++)
                        @csrf
                        @isset($BagItemsArray[$i])
                            <div class="h-12 w-full border-b-2 flex">
                                <img class=""
                                    src="
                                @switch($BagItemsArray[$i]->type)
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



                                    @if ($BagItemsArray[$i]->stat1 != '')
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
                                        @endswitch {{ $BagItemsArray[$i]->stat1 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat2 != '')
                                        WLP: {{ $BagItemsArray[$i]->stat2 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat3 != '')
                                        CON: {{ $BagItemsArray[$i]->stat3 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat4 != '')
                                        EXP: {{ $BagItemsArray[$i]->stat4 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat5 != '')
                                        RES: {{ $BagItemsArray[$i]->stat5 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat6 != '')
                                        MAS: {{ $BagItemsArray[$i]->stat6 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->armor != '')
                                        AR: {{ $BagItemsArray[$i]->armor }}
                                    @endif
                                    @if ($BagItemsArray[$i]->damage != '')
                                        DAM: {{ $BagItemsArray[$i]->damage }}
                                    @endif
                                    @if ($BagItemsArray[$i]->specialeffect1 != '')
                                        SE1: {{ $BagItemsArray[$i]->specialeffect1 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->specialeffect2 != '')
                                        SE2: {{ $BagItemsArray[$i]->specialeffect2 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->specialeffect3 != '')
                                        SE3: {{ $BagItemsArray[$i]->specialeffect3 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->specialeffect4 != '')
                                        SE4: {{ $BagItemsArray[$i]->specialeffect4 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->rarity != '')
                                        <span class="mr-5 float-end item{{ $BagItemsArray[$i]->rarity }}">
                                            {{ $BagItemsArray[$i]->rarity }}</span>
                                    @endif
                                    @if ($BagItemsArray[$i]->value != '')
                                        <span class="mr-5 float-end">Value:
                                            {{ $BagItemsArray[$i]->value }}</span>
                                    @endif
                                    

                                    <button class="ml-auto mr-2 pr-5 text-red-500" type="submit" value="{{ $BagItemsArray[$i]->id }}"
                                        name="Sell">Sell</button>
                                    <button class="ml-auto mr-2" type="submit" value="{{ $BagItemsArray[$i]->id }}"
                                        name="Equip">Equip</button>
                                    <button class="" type="submit" value="{{ $BagItemsArray[$i]->id }}"
                                        name="Delete">Delete</button>
                            </div>
                        @endisset
                    @endfor
                </form>

            </div>
            <div class="flex w-full mt-5">
                <form action="" method="POST">
                    @csrf
                    <button type="submit" name="SellAll" value="SellAll">Sell All</button>
                </form>
            </div>

        </div>
    </div>

@endsection
