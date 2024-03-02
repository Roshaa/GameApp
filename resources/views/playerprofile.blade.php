@extends('Layouts.app')
@section('pagecontent')
    <div class="w-3/12 mt-5">

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
    <div class="w-2/12 mt-5">

        <p>Main stat: {{ $GetStats['mainstat'] }}</p>
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
    <div class="w-7/12 mt-5">

        <div class="flex">
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Item Slot</p>
            </div>
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Item Slot</p>
            </div>
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Item Slot</p>
            </div>
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Item Slot</p>
            </div>

        </div>
        <div class="flex mt-4">
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Profession Tool</p>
            </div>
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Profession Tool</p>
            </div>
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Ring Slot</p>
            </div>
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Ring Slot</p>
            </div>

        </div>
        <div class="flex mt-4">
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Weapon Slot</p>
            </div>
            <div class="w-1/6 h-1/6 mx-8	border">
                <p>Relic</p>
            </div>
            <div class="w-1/6 h-1/6 mx-1	border">
                <p>Relic</p>
            </div>
            <div class="w-1/6 h-1/6 mx-1	border">
                <p>Relic</p>
            </div>
        </div>
        <div class="flex mt-4">
            <div class="w-1/6 h-1/6 mx-3	border">
                <p>Potion</p>
            </div>
            <div class="w-1/6 h-1/6 mx-8	border">
                <p>Potion</p>
            </div>
        </div>
        <div class="mt-4">

            {{-- Alterar para uma table no futuro --}}
            @for ($i = 1; $i <= 5; $i++)
                <div class="w-full border mt-1">
                    <p>
                        @isset($BagItemsArray[$i])
                            ID: {{ $BagItemsArray[$i]->id }}
                            Main Stat: {{ $BagItemsArray[$i]->stat1 }}
                            STAT2: {{ $BagItemsArray[$i]->stat2 }}
                            STAT3: {{ $BagItemsArray[$i]->stat3 }}
                            STAT4: {{ $BagItemsArray[$i]->stat4 }}
                            STAT5: {{ $BagItemsArray[$i]->stat5 }}
                            STAT6: {{ $BagItemsArray[$i]->stat6 }}
                            Armor: {{ $BagItemsArray[$i]->armor }}
                            SE1: {{ $BagItemsArray[$i]->specialeffect1 }}
                            SE2: {{ $BagItemsArray[$i]->specialeffect2 }}
                            SE3: {{ $BagItemsArray[$i]->specialeffect3 }}
                            SE4: {{ $BagItemsArray[$i]->specialeffect4 }}
                            Type: {{ $BagItemsArray[$i]->type }}
                            Rarity: {{ $BagItemsArray[$i]->rarity }}
                        @endisset
                    </p>
                </div>
            @endfor


{{-- Tem que se criar a form e um botao delete que mete o valor null(pesquisar) --}}

            @for ($i = 6; $i <= 10; $i++)
                <div class="w-full border mt-1">
                    <p>
                        @isset($BagItemsArray[$i])
                            ID: {{ $BagItemsArray[$i]->id }}
                            Main Stat: {{ $BagItemsArray[$i]->stat1 }}
                            STAT2: {{ $BagItemsArray[$i]->stat2 }}
                            STAT3: {{ $BagItemsArray[$i]->stat3 }}
                            STAT4: {{ $BagItemsArray[$i]->stat4 }}
                            STAT5: {{ $BagItemsArray[$i]->stat5 }}
                            STAT6: {{ $BagItemsArray[$i]->stat6 }}
                            Armor: {{ $BagItemsArray[$i]->armor }}
                            SE1: {{ $BagItemsArray[$i]->specialeffect1 }}
                            SE2: {{ $BagItemsArray[$i]->specialeffect2 }}
                            SE3: {{ $BagItemsArray[$i]->specialeffect3 }}
                            SE4: {{ $BagItemsArray[$i]->specialeffect4 }}
                            Type: {{ $BagItemsArray[$i]->type }}
                            Rarity: {{ $BagItemsArray[$i]->rarity }}
                        @endisset
                    </p>
                </div>
            @endfor

        </div>
    @endsection
