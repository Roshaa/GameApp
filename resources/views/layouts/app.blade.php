<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'GameApp') }}</title>

    <link rel="stylesheet" href="/css/style.css">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="/js/js.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- blade-formatter-disable --}}
  <style type="text/tailwindcss">
    .btn{
        @apply w-full text-center h-16 hover:text-2xl hover:bg-slate-300
    }

  </style>
  {{-- blade-formatter-enable --}}

</head>

<body>
    <div class="flex">
        <div class="w-1/6 border-r-2 border-slate-700 h-screen">

            <a class="text-xl" href="playerprofile"><button class="btn">Player Profile</button></a>
            <a class="text-xl" href="template.html"><button class="btn">Horse</button></a>
            <a class="text-xl" href="template.html"><button class="btn">Job</button></a>
            <a class="text-xl" href="template.html"><button class="btn">Shop</button></a>
            <a class="text-xl" href="playermissions"><button class="btn">Missions</button></a>
            <a class="text-xl" href="template.html"><button class="btn">Raid</button></a>
            <a class="text-xl" href="template.html"><button class="btn">Trade</button></a>
            <a class="text-xl" href="template.html"><button class="btn">Ranking</button></a>
            <a class="text-xl" href="devpage"><button class="btn">Devpage</button></a>

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
