<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GameApp') }}</title>
 
    <link href="{{ asset('\build\assets\rpg-awesome.css') }}" rel="stylesheet">   
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- blade-formatter-disable --}}
  <style type="text/tailwindcss">
    .btn{
        @apply w-full text-center h-16 hover:text-3xl hover:text-white hover:border-t-2 hover:border-b-2
    }
    .itemcommon{
        @apply text-stone-500
    }
    .itemuncommon{
        @apply text-lime-400	
    }
    .itemrare{
        @apply text-cyan-500	
    }
    .itemepic{
        @apply text-fuchsia-600
    }

  </style>
  {{-- blade-formatter-enable --}}

</head>

<body>
    <div class="flex">
        <div class="w-1/6 h-screen bg-black bg-no-repeat bg-contain text-2xl	 text-black " style="background-image: url('images/scroll.jpg'        );">

            
            <a class="" href="playerprofile"><button class="btn" style="margin-top: 35%">Player Profile</button></a>
            <a class="" href="template.html"><button class="btn">Horse</button></a>
            <a class="" href="template.html"><button class="btn">Job</button></a>
            <a class="" href="playershop"><button class="btn">Shop</button></a>
            <a class="" href="playermissions"><button class="btn">Missions</button></a>
            <a class="" href="template.html"><button class="btn">Raid</button></a>
            <a class="" href="template.html"><button class="btn">Trade</button></a>
            <a class="" href="template.html"><button class="btn">Ranking</button></a>
            <a class="" href="devpage"><button class="btn">Devpage</button></a>

            <div class="flex justify-end p-2 border-b-2 border-slate-700">

                <a class=" text-lg" href="profile">Profile</a>
        
                <form class="mx-5 text-lg" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a>
                </form>
        
        
        </div>
        

        </div>


        <div class="w-5/6 h-screen flex">@yield('pagecontent')
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/fbe6b2fb71.js" crossorigin="anonymous"></script>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>

</html>
