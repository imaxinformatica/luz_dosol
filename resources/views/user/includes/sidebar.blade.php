  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{ asset('dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>João Carlos Silva</p>
          <span><small>ID: 2800082</small></span>
          
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
        <li {{ (Request::is('admin') ? 'class=active' : '') }} {{ (Request::is('admin/') ? 'class=active' : '') }}>
          <a href="{{ url('admin')}}">
            <i class="fa fa-home"></i> <span>INÍCIO</span>
          </a>
        </li>
        <li {{ (Request::is('admin/products') ? 'class=active' : '') }} {{ (Request::is('admin/products/*') ? 'class=active' : '') }} >
          <a href="{{ url('admin/products')}}">
            <i class="fa fa-shopping-cart"></i> <span>REALIZAR PEDIDO</span>
          </a>
        </li>
        <li {{ (Request::is('admin/orders') ? 'class=active' : '') }} {{ (Request::is('admin/orders/*') ? 'class=active' : '') }} >
          <a href="{{ url('admin/orders')}}">
            <i class="fa fa-list"></i> <span>MEUS PEDIDOS</span>
          </a>
        </li>
        <li {{ (Request::is('admin/register') ? 'class=active' : '') }} {{ (Request::is('admin/register/*') ? 'class=active' : '') }} >
          <a href="{{ url('admin/register')}}">
            <i class="fa fa-user"></i> <span>CADASTRAR</span>
          </a>
        </li>
        <li {{ (Request::is('admin/financial') ? 'class=active' : '') }} {{ (Request::is('admin/financial/*') ? 'class=active' : '') }} >
          <a href="{{ url('admin/financial')}}">
            <i class="fa fa-credit-card-alt"></i> <span>DADOS FINANCEIROS</span>
          </a>
        </li>
        <li {{ (Request::is('admin/network') ? 'class=active' : '') }} {{ (Request::is('admin/network/*') ? 'class=active' : '') }} >
          <a href="{{ url('admin/network')}}">
            <i class="fa fa-users"></i> <span>REDE</span>
          </a>
        </li>
        <li {{ (Request::is('admin/documents') ? 'class=active' : '') }} {{ (Request::is('admin/documents/*') ? 'class=active' : '') }} >
          <a href="{{ url('admin/documents')}}">
            <i class="fa fa-download"></i> <span>DOCUMENTOS</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-sign-out"></i> <span>LOGOUT</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>