@php($cartItems = auth()->guard('user')->user()->cart)
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
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="label label-danger">{{auth()->guard('user')->user()->cart->count()}}</span>
                        </a>
                        <ul class="dropdown-menu" style="min-width: 400px;">
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    @forelse($cartItems as $item)
                                    <li>
                                        <div class="pull-left">
                                            <img
                                                src="{{asset('uploads/products/thumbnail/'. $item->file)}}"
                                                alt="Imagem do produto">
                                        </div>
                                        <h4>
                                            <span class="cart-preview-title">{{$item->name}}</span><br>
                                            <b>Ref.:</b> {{$item->reference}}<br>
                                            <b>Qtd.:</b> {{$item->pivot->qty}}<br>
                                        </h4>
                                        <a href="{{route('user.cart.delete', ['cart' => $item->pivot->id])}}"
                                            title="Excluir" class="act-list act-delete cart">
                                            <span class="remove-item">
                                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                                            </span>
                                        </a>
                                    </li>

                                    @empty
                                    <li>Nenhum item adicionado ao carrinho</li>
                                    @endforelse

                                </ul>
                            </li>
                            <li class="footer"><a class="finaliza-btn" href="{{route('user.cart.index')}}">Finalizar Pedido</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
        </nav>
    </header>