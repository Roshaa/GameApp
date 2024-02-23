<div class="flex justify-end p-2 border-b-2 border-slate-700">

        <a class=" text-lg" href="profile">Profile</a>

        <form class="mx-5 text-lg" method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">{{ __('Log Out') }}</a>
        </form>


</div>
