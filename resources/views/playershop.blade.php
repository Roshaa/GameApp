@extends('Layouts.app')
@section('pagecontent')
    <div class="w-full h-full bg-opacity-25 bg-no-repeat bg-cover text-white" style="background-image: url( 'images/playershopbackground.jpg'  );">
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
                    <div>{{ $ShopInfo[0]->shopitem1 }}</div>
                    <div>{{ $ShopInfo[0]->shopitem2 }}</div>
                    <div>{{ $ShopInfo[0]->shopitem3 }}</div>

                    @if ($ShopInfo[0]->shopitems==1)
                    <div>{{ $ShopInfo[0]->shopitem4 }}</div>
                    @endif
                    @if ($ShopInfo[0]->shopitems==2)
                    <div>{{ $ShopInfo[0]->shopitem4 }}</div>
                    <div>{{ $ShopInfo[0]->shopitem5 }}</div>
                    @endif
                    @if ($ShopInfo[0]->shopitems==3)
                    <div>{{ $ShopInfo[0]->shopitem4 }}</div>
                    <div>{{ $ShopInfo[0]->shopitem5 }}</div>
                    <div>{{ $ShopInfo[0]->shopitem6 }}</div>
                    @endif
                    <form method="POST" action="/shoprestock" class="mt-5">
                        @csrf
                        <button type="submit" class="border p-2 border-white rounded text-orange-400">Restock</button>
                    </form>
                </div>
                <div class="w-3/12 pr-5">
                    <div>Reputation <br>{{ $ShopInfo[0]->reputation }}</div>
                    <div>Reputation Level <br>{{ $ShopInfo[0]->reputationlevel }}</div>
                    @if ($ShopInfo[0]->shopitems!=3)
                    <div class="mt-5">
                        <form method="POST" action="/shopupgrade">
                            @csrf
                            <div>Stock Level<br>{{ $ShopInfo[0]->shopitems }}</div>
                            <button type="submit" class="border p-2 border-white rounded text-orange-400">Upgrade</button>
                        </form>
                    </div>
                    @endif
                    
                    <div class="mt-5"> Gold: {{$CharInfo[0]->gold}}</div>
                </div>
            @endif
            
        </div>

    </div>
@endsection
