<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        @php($auth = auth()->guard('user')->user())
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('uploads/profile/'.$auth->avatar)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{$auth->name}}</p>
                <span><small>ID: {{str_pad($auth->id, 5, 0, STR_PAD_LEFT )}}</small></span>
                <span class="change-avatar"><i class="fa fa-pencil"></i> </span>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU PRINCIPAL</li>
            <li {{ (Request::is('user/dashboard') ? 'class=active' : '') }}
                {{ (Request::is('user/dashboard/*') ? 'class=active' : '') }}>
                <a href="{{ route('user.dashboard')}}">
                    <i class="fa fa-tachometer"></i> <span>DASHBOARD</span>
                </a>
            </li>
            <li {{ (Request::is('user/produtos') ? 'class=active' : '') }}
                {{ (Request::is('user/produtos/*') ? 'class=active' : '') }}>
                <a href="{{ route('user.product')}}">
                    <i class="fa fa-shopping-cart"></i> <span>REALIZAR PEDIDO</span>
                </a>
            </li>
            <!-- <li {{ (Request::is('user/checkout') ? 'class=active' : '') }}
                {{ (Request::is('user/checkout/*') ? 'class=active' : '') }}>
                <a href="#">
                    <i class="fa fa-credit-card"></i> <span>FINALIZAR PEDIDO</span>
                </a>
            </li> -->
            <li {{ (Request::is('user/pedido') ? 'class=active' : '') }}
                {{ (Request::is('user/pedido/*') ? 'class=active' : '') }}>
                <a href="{{ route('user.order.index')}}">
                    <i class="fa fa-list"></i> <span>MEUS PEDIDOS</span>
                </a>
            </li>
            <li {{ (Request::is('user/dados-bancarios') ? 'class=active' : '') }}
                {{ (Request::is('user/dados-bancarios/*') ? 'class=active' : '') }}>
                <a href="{{ route('user.financial.edit')}}">
                    <i class="fa fa-credit-card-alt"></i> <span>DADOS FINANCEIROS</span>
                </a>
            </li>
            <li {{ (Request::is('user/usuario/rede') ? 'class=active' : '') }}>
                <a href="{{ route('user.user.index')}}">
                    <i class="fa fa-users"></i> <span>REDE</span>
                </a>
            </li>
            <li {{ (Request::is('user/documento') ? 'class=active' : '') }}
                {{ (Request::is('user/documento/*') ? 'class=active' : '') }}>
                <a href="{{ route('user.document.index')}}">
                    <i class="fa fa-download"></i> <span>DOCUMENTOS</span>
                </a>
            </li>
            <li {{ (Request::is('user/congiguracao') ? 'class=active' : '') }}
                {{ (Request::is('user/congiguracao/*') ? 'class=active' : '') }}>
                <a href="{{ route('user.configuration.index')}}">
                    <i class="fa fa-cog"></i> <span>CONFIGURAÇÃO</span>
                </a>
            </li>
            <li>
                <a href="{{url('user/logout')}}">
                    <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>