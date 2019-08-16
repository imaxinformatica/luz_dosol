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
                  <p>{{$auth->name}}</p>
                  <span><small>ID: {{str_pad($auth->id, 5, 0, STR_PAD_LEFT )}}</small></span>

              </div>
          </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu" data-widget="tree">
              <li class="header">MENU PRINCIPAL</li>
              <li {{ (Request::is('user/dashboard') ? 'class=active' : '') }}
                  {{ (Request::is('user/dashboard/*') ? 'class=active' : '') }}>
                  <a href="{{ route('user.dashboard')}}">
                      <i class="fa fa-home"></i> <span>INÍCIO</span>
                  </a>
              </li>
              <li {{ (Request::is('user/produtos') ? 'class=active' : '') }}
                  {{ (Request::is('user/produtos/*') ? 'class=active' : '') }}>
                  <a href="{{ route('user.product')}}">
                      <i class="fa fa-shopping-cart"></i> <span>REALIZAR PEDIDO</span>
                  </a>
              </li>
              <li {{ (Request::is('user/checkout') ? 'class=active' : '') }}
                  {{ (Request::is('user/checkout/*') ? 'class=active' : '') }}>
                  <a href="{{ route('user.checkout')}}">
                      <i class="fa fa-credit-card"></i> <span>FINALIZAR PEDIDO</span>
                  </a>
              </li>
              <li {{ (Request::is('user/orders') ? 'class=active' : '') }}
                  {{ (Request::is('user/orders/*') ? 'class=active' : '') }}>
                  <a href="{{ url('user/orders')}}">
                      <i class="fa fa-list"></i> <span>MEUS PEDIDOS</span>
                  </a>
              </li>
              <li {{ (Request::is('user/register') ? 'class=active' : '') }}
                  {{ (Request::is('user/register/*') ? 'class=active' : '') }}>
                  <a href="{{ url('user/register')}}">
                      <i class="fa fa-user"></i> <span>CADASTRAR</span>
                  </a>
              </li>
              <li {{ (Request::is('user/financial') ? 'class=active' : '') }}
                  {{ (Request::is('user/financial/*') ? 'class=active' : '') }}>
                  <a href="{{ url('user/financial')}}">
                      <i class="fa fa-credit-card-alt"></i> <span>DADOS FINANCEIROS</span>
                  </a>
              </li>
              <li {{ (Request::is('user/network') ? 'class=active' : '') }}
                  {{ (Request::is('user/network/*') ? 'class=active' : '') }}>
                  <a href="{{ url('user/network')}}">
                      <i class="fa fa-users"></i> <span>REDE</span>
                  </a>
              </li>
              <li {{ (Request::is('user/documents') ? 'class=active' : '') }}
                  {{ (Request::is('user/documents/*') ? 'class=active' : '') }}>
                  <a href="{{ url('user/documents')}}">
                      <i class="fa fa-download"></i> <span>DOCUMENTOS</span>
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