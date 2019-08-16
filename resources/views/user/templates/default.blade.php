<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @include('user.includes.head')
    </head>

    <body class="hold-transition skin-yellow sidebar-mini">
        
        @include('user.includes.header')

        @include('user.includes.sidebar')

        @yield('content')

        @include('user.includes.modals')
        
        @include('user.includes.footer')
        
    </body>

</html>