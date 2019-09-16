<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                @php($auth = auth()->guard('admin')->user())
                <p>{{$auth->name}}
                    <span class="configuration" onclick="window.location.href='{{route('admin.configuration.index')}}'">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </span>
                </p>
                <span><small>ID: {{str_pad($auth->id, 5, 0, STR_PAD_LEFT )}}</small></span>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MENU PRINCIPAL</li>
            <li {{ (Request::is('admin/dashboard') ? 'class=active' : '') }}
                {{ (Request::is('admin/dashboard') ? 'class=active' : '') }}>
                <a href="{{ route('admin.dashboard')}}">
                    <i class="fa fa-home"></i> <span>INÍCIO</span>
                </a>
            </li>
            <li {{ (Request::is('admin/commission') ? 'class=active' : '') }}
                {{ (Request::is('admin/commission/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.commission.edit')}}">
                    <i class="fa fa-list"></i> <span>COMISSÕES</span>
                </a>
            </li>
            <li {{ (Request::is('admin/banner') ? 'class=active' : '') }}
                {{ (Request::is('admin/banner/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.banner.index')}}">
                    <i class="fa fa-picture-o" aria-hidden="true"></i> <span>BANNERS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/categorias') ? 'class=active' : '') }}
                {{ (Request::is('admin/categorias/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.category.index')}}">
                    <i class="fa fa-cubes"></i> <span>CATEGORIAS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/produtos') ? 'class=active' : '') }}
                {{ (Request::is('admin/produtos/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.product.index')}}">
                    <i class="fa fa-cube"></i> <span>PRODUTOS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/banco') ? 'class=active' : '') }}
                {{ (Request::is('admin/banco/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.bank.index')}}">
                    <i class="fa fa-university"></i> <span>BANCOS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/user') ? 'class=active' : '') }}
                {{ (Request::is('admin/user/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.user.index')}}">
                    <i class="fa fa-user"></i> <span>USUÁRIOS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/pages') ? 'class=active' : '') }}
                {{ (Request::is('admin/pages/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.pages.index')}}">
                    </i><i class="fa fa-file" aria-hidden="true"></i> <span>PÁGINAS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/pedido') ? 'class=active' : '') }}
                {{ (Request::is('admin/pedido/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.order.index')}}">
                    <i class="fa fa-usd" aria-hidden="true"></i> <span>PEDIDOS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/export') ? 'class=active' : '') }}
                {{ (Request::is('admin/export/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.export.index')}}">
                    <i class="fa fa-download"></i> <span>EXPORTAÇÃO</span>
                </a>
            </li>
            <li {{ (Request::is('admin/documento') ? 'class=active' : '') }}
                {{ (Request::is('admin/documento/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.document.index')}}">
                    <i class="fa fa-archive"></i> <span>DOCUMENTOS</span>
                </a>
            </li>
            <li {{ (Request::is('admin/configuracao') ? 'class=active' : '') }}
                {{ (Request::is('admin/configuracao/*') ? 'class=active' : '') }}>
                <a href="{{ route('admin.configuration.index')}}">
                    <i class="fa fa-cog"></i> <span>CONFIGURAÇÃO</span>
                </a>
            </li>
          
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>