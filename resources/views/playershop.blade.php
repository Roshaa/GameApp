@extends('Layouts.app')
@section('pagecontent')
<div class="w-full h-full bg-no-repeat bg-cover"
        style="background-color: grey;">
<div class="w-full text-center h-full pt-5 flex">

        @if ($UnlockShop == 1)  
        <form action="/unlockshop" method="POST">
                @csrf
                <button type="submit">Teste</button>
        </form>    
        @endif

        @if ($UnlockShop == 0)
                <div class="w-3/12"> Merchant image</div>
                <div class="w-6/12"> items on sale</div>
                <div class="w-3/12"> Upgrades to Unlock</div>
        @endif

</div>

</div>
@endsection