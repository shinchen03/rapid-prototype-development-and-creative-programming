
@include('layouts.head')

    <body>
    <!--The Navigate Bar from Bootstrap-->
        @include('layouts.nav')
        <div class="container">
            @include('layouts.messages')
             @yield('content')
            <hr>
            <p class="text-center">Copyright Shin&Eason - All Right Reserved</p>  
        </div>
        @yield('image')
        @include('layouts.end')
    </body>

