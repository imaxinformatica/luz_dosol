@extends('admin.templates.default')

@section('title', 'Editar Cliente')

@section('description', 'Descrição')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h1>Editar Cliente</h1>
        </div>
      </div>
    </section>

    @if(session()->has('success'))
      <section class="content-header">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-sm-12">
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {{session('success')}}
            </div>
          </section>
        </div>
      </section>
    @endisset

    @if ($errors->any())
      <div class="content-header">
        @foreach ($errors->all() as $error)
        <div class="row">
          <div class="col-sm-12">
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ $error }}
            </div>
          </div>
        </div>
        @endforeach
      </div>
    @endif

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-6">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Dados</h3>
            </div>
            <form method="POST" action="{{route('admin.customer.update')}}">
              {{csrf_field()}}
              <input type="hidden" name="id" value="{{$customer->id}}">
              <div class="box-body">
                <div class="form-group row box-razao-social">
                  <div class="col-xs-12">
                    <label for="company_name">Razão Social</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" value="{{$customer->company_name}}">
                  </div>
                </div>
                <div class="form-group row box-nome" >
                  <div class="col-xs-12">
                    <label for="trade">Nome Fantasia</label>
                    <input type="text" name="trade" class="form-control" id="trade" value="{{$customer->trade}}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 box-cnpj">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" class="form-control input-cnpj" id="cnpj" value="{{$customer->cnpj}}">
                  </div>
                  <div class="col-sm-6 box-nascimento">
                    <label for="state_registration">Inscrição Estadual</label>
                    <input type="text" name="state_registration" class="form-control input-creci" id="state_registration" value="{{$customer->state_registration}}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-12">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{$customer->email}}" required>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="zip_code">CEP</label>
                    <input type="text" name="zip_code" class="form-control input-cep" id="zip_code" value="{{$customer->zip_code}}" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="state">UF</label>
                    <select class="form-control" id="state" name="state" required>
                      <option></option>
                      <option value="AC" <?php if($customer->state == 'AC'){ echo 'selected'; } ?> >AC</option>
                      <option value="AL" <?php if($customer->state == 'AL'){ echo 'selected'; } ?> >AL</option>
                      <option value="AM" <?php if($customer->state == 'AM'){ echo 'selected'; } ?> >AM</option>
                      <option value="AP" <?php if($customer->state == 'AP'){ echo 'selected'; } ?> >AP</option>
                      <option value="BA" <?php if($customer->state == 'BA'){ echo 'selected'; } ?> >BA</option>
                      <option value="CE" <?php if($customer->state == 'CE'){ echo 'selected'; } ?> >CE</option>
                      <option value="DF" <?php if($customer->state == 'DF'){ echo 'selected'; } ?> >DF</option>
                      <option value="ES" <?php if($customer->state == 'ES'){ echo 'selected'; } ?> >ES</option>
                      <option value="GO" <?php if($customer->state == 'GO'){ echo 'selected'; } ?> >GO</option>
                      <option value="MA" <?php if($customer->state == 'MA'){ echo 'selected'; } ?> >MA</option>
                      <option value="MG" <?php if($customer->state == 'MG'){ echo 'selected'; } ?> >MG</option>
                      <option value="MS" <?php if($customer->state == 'MS'){ echo 'selected'; } ?> >MS</option>
                      <option value="MT" <?php if($customer->state == 'MT'){ echo 'selected'; } ?> >MT</option>
                      <option value="PA" <?php if($customer->state == 'PA'){ echo 'selected'; } ?> >PA</option>
                      <option value="PB" <?php if($customer->state == 'PB'){ echo 'selected'; } ?> >PB</option>
                      <option value="PE" <?php if($customer->state == 'PE'){ echo 'selected'; } ?> >PE</option>
                      <option value="PI" <?php if($customer->state == 'PI'){ echo 'selected'; } ?> >PI</option>
                      <option value="PR" <?php if($customer->state == 'PR'){ echo 'selected'; } ?> >PR</option>
                      <option value="RJ" <?php if($customer->state == 'RJ'){ echo 'selected'; } ?> >RJ</option>
                      <option value="RN" <?php if($customer->state == 'RN'){ echo 'selected'; } ?> >RN</option>
                      <option value="RO" <?php if($customer->state == 'RO'){ echo 'selected'; } ?> >RO</option>
                      <option value="RR" <?php if($customer->state == 'RR'){ echo 'selected'; } ?> >RR</option>
                      <option value="RS" <?php if($customer->state == 'RS'){ echo 'selected'; } ?> >RS</option>
                      <option value="SC" <?php if($customer->state == 'SC'){ echo 'selected'; } ?> >SC</option>
                      <option value="SE" <?php if($customer->state == 'SE'){ echo 'selected'; } ?> >SE</option>
                      <option value="SP" <?php if($customer->state == 'SP'){ echo 'selected'; } ?> >SP</option>
                      <option value="TO" <?php if($customer->state == 'TO'){ echo 'selected'; } ?> >TO</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label for="city">Cidade</label>
                    <input type="text" name="city" class="form-control" id="city" value="{{$customer->city}}" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="district">Bairro</label>
                    <input type="text" name="district" class="form-control" id="district" value="{{$customer->district}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9">
                    <label for="address">Endereço</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{$customer->address}}" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="address_number">Número</label>
                    <input type="text" name="address_number" class="form-control" id="address_number" value="{{$customer->address_number}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label for="phone">Telefone principal</label>
                    <input type="text" name="phone" class="form-control input-telefone" id="phone" value="{{$customer->phone}}" required>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Atualizar</button>
              </div>
            </form>
          </div>
        </section>
        
        <section class="col-lg-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <p>Número pedidos</p>
                <h3>{{$customer->order()->count()}}</h3>
              </div>
            </div>
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">Pedidos</h3>
              </div>
              <div class="box-body table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Número Pedido</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th>Ações</th>
                    </tr>
                      @forelse($customer->order()->get() as $order)
                    <tr>
                      <td>{{$order->id}}</td>
                      <td>R$ {{number_format($order->total_order, 2, ',', '.')}}</td>
                      <td>{{$order->statusOrder($order->id)}}</td>
                      <td>
                        @if($order->statusOrder($order->id) == 'Em aberto')
                        <a href="{{ route('admin.order.create', ['id' => $order->id])}}" title="Editar" class="act-list">
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        @elseif($order->statusOrder($order->id) == 'Aguardando Pagamento' )
                        <a href="{{ route('admin.order.finish', ['id' => $order->id])}}" title="Editar" >
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        @else
                        <a href="{{ route('admin.order.show', ['id' => $order->id])}}" title="Visualizar" >
                          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        @endif
                        @if($order->statusOrder($order->id) == 'Em aberto' || $order->statusOrder($order->id) == 'Aguardando Pagamento' )
                         <a href="{{ route('admin.order.destroy', ['id' => $order->id])}}" title="Excluir" class="act-list act-delete">
                          <i class="fa fa-minus-square-o" aria-hidden="true"></i>
                        </a>
                        @endif
                      </td>
                    </tr>
                      @empty
                      <tr>
                        <td colspan="7y">Nenhum resultado encontrado</td>
                      </tr>
                      @endforelse
                  </thead>
                  <tbody>
                      
                  </tbody>
                </table>
              </div>
            </div>
          </section>

      </section>
      <!-- /.content -->
      </div>
      <!-- /.row (main row) -->

  </div>

@stop