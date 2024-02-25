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

        <p>Main stat: {{ $mainstat }}</p>
        <br>
        <p>Willpower: {{ $Willpower }}</p>
        <p>Constituion: {{ $Constituion }}</p>
        <p>Expertise: {{ $Expertise }}</p>
        <p>Resistance: {{ $Resistance }}</p>
        <p>Mastery: {{ $Mastery }}</p>
        <br>
        <p>Alchemy: {{ $Alchemy }}</p>
        <p>Armoursmith: {{ $Armoursmith }}</p>
        <p>Weaponsmith: {{ $Weaponsmith }}</p>
        <p>Jewellery: {{ $Jewellery }}</p>
        <p>Librarian {{ $Librarian }}</p>
        <br>
        <p>HP: {{ $hp }}</p>
        <p>Damage: {{ $damage }}</p>
        <p>Skill Damage: {{ $skilldamage }}</p>
        <p>Damage Reduction: {{ $damagereduction }}</p>
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
            {{ $ClassSpecial }}</p>

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
        <div class="flex mt-4">
            <div class="w-1/6 h-1/6	border">
                <p>Bag Slot</p>
            </div>
            <div class="w-1/6 h-1/6	border">
                <p>Bag Slot</p>
            </div>
            <div class="w-1/6 h-1/6 	border">
                <p>Bag Slot</p>
            </div>
            <div class="w-1/6 h-1/6 	border">
                <p>Bag Slot</p>
            </div>
            <div class="w-1/6 h-1/6	border">
                <p>Bag Slot</p>
            </div>
        </div>
    </div>
@endsection
