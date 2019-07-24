@extends('admin.templates.default')

@section('title', 'Adicionar Cliente')

@section('description', 'Descrição')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
        <div class="col-sm-6">
          <h1>Adicionar Cliente</h1>
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
            <form method="POST" action="{{route('admin.customer.store')}}">
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group row box-razao-social">
                  <div class="col-xs-12">
                    <label for="company_name">Razão Social</label>
                    <input type="text" name="company_name" class="form-control" id="company_name" value="{{old('company_name')}}">
                  </div>
                </div>
                <div class="form-group row box-nome" >
                  <div class="col-xs-12">
                    <label for="trade">Nome Fantasia</label>
                    <input type="text" name="trade" class="form-control" id="trade" value="{{old('trade')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 box-cnpj">
                    <label for="cnpj">CNPJ</label>
                    <input type="text" name="cnpj" class="form-control input-cnpj" id="cnpj" value="{{old('cnpj')}}">
                  </div>
                  <div class="col-sm-6 box-nascimento">
                    <label for="state_registration">Inscrição Estadual</label>
                    <input type="text" name="state_registration" class="form-control input-creci" id="state_registration" value="{{old('state_registration')}}">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-xs-12">
                    <label for="email">E-mail</label>
                    <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}" required>
                  </div>
                </div>


                <div class="form-group row">
                  <div class="col-sm-8">
                    <label for="zip_code">CEP</label>
                    <input type="text" name="zip_code" class="form-control input-cep" id="zip_code" value="{{old('zip_code')}}" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="state">UF</label>
                    <select class="form-control" id="state" name="state" required>
                      <option></option>
                      <option value="AC" <?php if(old('state') == 'AC'){ echo 'selected'; } ?> >AC</option>
                      <option value="AL" <?php if(old('state') == 'AL'){ echo 'selected'; } ?> >AL</option>
                      <option value="AM" <?php if(old('state') == 'AM'){ echo 'selected'; } ?> >AM</option>
                      <option value="AP" <?php if(old('state') == 'AP'){ echo 'selected'; } ?> >AP</option>
                      <option value="BA" <?php if(old('state') == 'BA'){ echo 'selected'; } ?> >BA</option>
                      <option value="CE" <?php if(old('state') == 'CE'){ echo 'selected'; } ?> >CE</option>
                      <option value="DF" <?php if(old('state') == 'DF'){ echo 'selected'; } ?> >DF</option>
                      <option value="ES" <?php if(old('state') == 'ES'){ echo 'selected'; } ?> >ES</option>
                      <option value="GO" <?php if(old('state') == 'GO'){ echo 'selected'; } ?> >GO</option>
                      <option value="MA" <?php if(old('state') == 'MA'){ echo 'selected'; } ?> >MA</option>
                      <option value="MG" <?php if(old('state') == 'MG'){ echo 'selected'; } ?> >MG</option>
                      <option value="MS" <?php if(old('state') == 'MS'){ echo 'selected'; } ?> >MS</option>
                      <option value="MT" <?php if(old('state') == 'MT'){ echo 'selected'; } ?> >MT</option>
                      <option value="PA" <?php if(old('state') == 'PA'){ echo 'selected'; } ?> >PA</option>
                      <option value="PB" <?php if(old('state') == 'PB'){ echo 'selected'; } ?> >PB</option>
                      <option value="PE" <?php if(old('state') == 'PE'){ echo 'selected'; } ?> >PE</option>
                      <option value="PI" <?php if(old('state') == 'PI'){ echo 'selected'; } ?> >PI</option>
                      <option value="PR" <?php if(old('state') == 'PR'){ echo 'selected'; } ?> >PR</option>
                      <option value="RJ" <?php if(old('state') == 'RJ'){ echo 'selected'; } ?> >RJ</option>
                      <option value="RN" <?php if(old('state') == 'RN'){ echo 'selected'; } ?> >RN</option>
                      <option value="RO" <?php if(old('state') == 'RO'){ echo 'selected'; } ?> >RO</option>
                      <option value="RR" <?php if(old('state') == 'RR'){ echo 'selected'; } ?> >RR</option>
                      <option value="RS" <?php if(old('state') == 'RS'){ echo 'selected'; } ?> >RS</option>
                      <option value="SC" <?php if(old('state') == 'SC'){ echo 'selected'; } ?> >SC</option>
                      <option value="SE" <?php if(old('state') == 'SE'){ echo 'selected'; } ?> >SE</option>
                      <option value="SP" <?php if(old('state') == 'SP'){ echo 'selected'; } ?> >SP</option>
                      <option value="TO" <?php if(old('state') == 'TO'){ echo 'selected'; } ?> >TO</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <label for="city">Cidade</label>
                    <input type="text" name="city" class="form-control" id="city" value="{{old('city')}}" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="district">Bairro</label>
                    <input type="text" name="district" class="form-control" id="district" value="{{old('district')}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-9">
                    <label for="address">Endereço</label>
                    <input type="text" name="address" class="form-control" id="address" value="{{old('address')}}" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="address_number">Número</label>
                    <input type="text" name="address_number" class="form-control" id="address_number" value="{{old('address_number')}}" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-12">
                    <label for="phone">Telefone principal</label>
                    <input type="text" name="phone" class="form-control input-telefone" id="phone" value="{{old('phone')}}" required>
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Adicionar</button>
              </div>
            </form>
          </div>
        </section>
        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>

@stop