<!DOCTYPE html>
<html lang="pt-br">
    <head>
        @include('admin.includes.head')
    </head>

    <body class="hold-transition skin-yellow sidebar-mini">
        
        @include('admin.includes.header')

        @include('admin.includes.sidebar')

        @yield('content')

        @include('admin.includes.modals')
        
        @include('admin.includes.footer')
        
    </body>

</html>