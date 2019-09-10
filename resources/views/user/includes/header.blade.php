<div class="wrapper">
  <header class="main-header">
    <!-- Logo -->
    <a href="{{route('user.dashboard')}}" class="logo">
      <span class="logo-lg"><b>LUZ DO SOL</b></span>
      <span class="logo-mini"><b>LDS</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="time-cycle">
          <b>O clico finaliza em:</b><span class="timeOut"></span>
          </li>
         
          <li>
            <a href="{{route('user.cart.index')}}">
              <i class="fa fa-shopping-cart"></i>
              <span class="label label-danger" >{{auth()->guard('user')->user()->cart->count()}}</span>
            </a>
          </li>
        </ul>
      </div>
    </nav>
  </header>