@extends('Layouts.app')
@section('pagecontent')
    <div class="flex w-full bg-opacity-25 bg-no-repeat bg-cover"
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

                <p class="border-2 rounded border-slate-700 text-center p-5 text-2xl font-medium">{{ $playername }}</p>
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
        </div>
        <div class="w-2/12 mt-5 text-white">

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
            <br>
            <p>Willpower: {{ $GetStats['Willpower'] }}</p>
            <p>Constituion: {{ $GetStats['Constituion'] }}</p>
            <p>Expertise: {{ $GetStats['Expertise'] }}</p>
            <p>Resistance: {{ $GetStats['Resistance'] }}</p>
            <p>Mastery: {{ $GetStats['Mastery'] }}</p>
            <br>
            <p>Alchemy: {{ $GetStats['Alchemy'] }}</p>
            <p>Armoursmith: {{ $GetStats['Armoursmith'] }}</p>
            <p>Weaponsmith: {{ $GetStats['Weaponsmith'] }}</p>
            <p>Jewellery: {{ $GetStats['Jewellery'] }}</p>
            <p>Librarian {{ $GetStats['Librarian'] }}</p>
            <br>
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
        <div class="w-7/12 mt-5 text-white mr-10">

            @for ($i = 0; $i <= 15; $i++)
                @isset($EquipItemsArray[$i])
                    <div class="w-full border mt-1">
                        <form action="" method="POST">
                            @csrf
                        
                        @if ($EquipItemsArray[$i]->stat1 != '')
                            @switch($class)
                                @case('Assassin')
                                    {{ 'Dexterity: ' }}
                                @break

                                @case('Paladin')
                                    {{ 'Strength: ' }}
                                @break

                                @case('Warlock')
                                    {{ 'Intelligence: ' }}
                                @break
                            @endswitch {{ $EquipItemsArray[$i]->stat1 }}
                        @endif
                        @if ($EquipItemsArray[$i]->stat2 != '')
                            Willpower: {{ $EquipItemsArray[$i]->stat2 }}
                        @endif
                        @if ($EquipItemsArray[$i]->stat3 != '')
                            Constitution: {{ $EquipItemsArray[$i]->stat3 }}
                        @endif
                        @if ($EquipItemsArray[$i]->stat4 != '')
                            Expertise: {{ $EquipItemsArray[$i]->stat4 }}
                        @endif
                        @if ($EquipItemsArray[$i]->stat5 != '')
                            Resistance: {{ $EquipItemsArray[$i]->stat5 }}
                        @endif
                        @if ($EquipItemsArray[$i]->stat6 != '')
                            Mastery: {{ $EquipItemsArray[$i]->stat6 }}
                        @endif
                        @if ($EquipItemsArray[$i]->armor != '')
                            Armor: {{ $EquipItemsArray[$i]->armor }}
                        @endif
                        @if ($EquipItemsArray[$i]->damage != '')
                            Damage: {{ $EquipItemsArray[$i]->damage }}
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
                        @if ($EquipItemsArray[$i]->type != '')
                            Type: {{ $EquipItemsArray[$i]->type }}
                        @endif
                        @if ($EquipItemsArray[$i]->rarity != '')
                            Rarity: {{ $EquipItemsArray[$i]->rarity }}
                        @endif
                        <button class="float-end mx-2" type="submit" value="{{ $EquipItemsArray[$i]->id }}"
                            name="Unequip">Unequip</button>
                    </form>
                    </div>
                @endisset
            @endfor


            <div class="mt-4 mr-10">

                {{-- Alterar para uma table no futuro --}}
                @for ($i = 1; $i <= 10; $i++)
                    <form action="" method="POST">
                        @csrf
                        <div>
                            @isset($BagItemsArray[$i])
                                <div class="w-full border mt-1 ">
                                    @if ($BagItemsArray[$i]->stat1 != '')
                                        @switch($class)
                                            @case('Assassin')
                                                {{ 'Dexterity: ' }}
                                            @break

                                            @case('Paladin')
                                                {{ 'Strength: ' }}
                                            @break

                                            @case('Warlock')
                                                {{ 'Intelligence: ' }}
                                            @break
                                        @endswitch {{ $BagItemsArray[$i]->stat1 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat2 != '')
                                        Willpower: {{ $BagItemsArray[$i]->stat2 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat3 != '')
                                        Constitution: {{ $BagItemsArray[$i]->stat3 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat4 != '')
                                        Expertise: {{ $BagItemsArray[$i]->stat4 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat5 != '')
                                        Resistance: {{ $BagItemsArray[$i]->stat5 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->stat6 != '')
                                        Mastery: {{ $BagItemsArray[$i]->stat6 }}
                                    @endif
                                    @if ($BagItemsArray[$i]->armor != '')
                                        Armor: {{ $BagItemsArray[$i]->armor }}
                                    @endif
                                    @if ($BagItemsArray[$i]->damage != '')
                                        Damage: {{ $BagItemsArray[$i]->damage }}
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
                                    @if ($BagItemsArray[$i]->type != '')
                                        Type: {{ $BagItemsArray[$i]->type }}
                                    @endif
                                    @if ($BagItemsArray[$i]->rarity != '')
                                        Rarity: {{ $BagItemsArray[$i]->rarity }}
                                    @endif
                                    <button class="float-end mx-2" type="submit" value="{{ $BagItemsArray[$i]->id }}"
                                        name="Equip">Equip</button>
                                    <button class="float-end" type="submit" value="{{ $BagItemsArray[$i]->id }}"
                                        name="Delete">Delete</button>
                                </div>
                            @endisset



                    </form>
            </div>
            @endfor
        </div>
    </div>
@endsection
