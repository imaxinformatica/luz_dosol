<!DOCTYPE HTML>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Luz do Sol</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Última versão CSS compilada e minificada -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
        integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Tema opcional -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
        integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Última versão JavaScript compilada e minificada -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css')}}">

    <!-- <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}"> -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css?ver=1.5')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('alertify/css/alertify.css')}}">
</head>

<body>
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="logo" href="{{url('/')}}"><img src="{{asset('images/logo.png')}}"></a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="{{url('/')}}">SOBRE A EMPRESA</a></li>
                        <li><a href="#">NOSSO CATÁLOGO</a></li>
                        <li class="office"><a href="{{url('user/login')}}">ESCRITÓRIO VIRTUAL</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>
        </nav>
    </header>

    <section class="register">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="box-register">
                        <form method="post" action="{{url('user/register')}}" autocomplete="off">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Finalize seu Cadastro</h3>
                                    <h4>Dados Pessoais</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>Nome <small>*</small></label>
                                        <input type="text" class="btn-form" value="{{old('name')}}" name="name"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group">
                                        <label>E-mail <small>*</small></label>
                                        <input type="email" class="btn-form" value="{{old('email')}}" name="email"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Senha <small>*</small></label>
                                        <input type="password" class="btn-form" name="password" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label>Confirmação de Senha <small>*</small></label>
                                        <input type="password" class="btn-form" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="cpf">CPF <small>*</small></label>
                                        <input type="text" class="btn-form input-cpf" value="{{old('cpf')}}" name="cpf"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="rg">RG <small>*</small></label>
                                        <input type="text" class="btn-form" value="{{old('rg')}}" name="rg" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="cellphone">Telefone Celular <small>*</small></label>
                                        <input type="text" class="btn-form input-phone" value="{{old('cellphone')}}"
                                            name="cellphone" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="phone">Telefone <small>(Opcional)</small></label>
                                        <input type="text" class="btn-form input-phone" value="{{old('phone')}}"
                                            name="phone">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Endereço do Titular</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label for="zip_code">CEP <small>*</small></label>
                                        <input type="text" class="btn-form input-cep" id="cep" value="{{old('zip_code')}}"
                                            name="zip_code" required>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="street">Logradouro <small>*</small></label>
                                        <input type="text" class="btn-form" value="{{old('street')}}" id="street" name="street"
                                            required>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                    <div class="form-group">
                                        <label for="number">Número <small>*</small></label>
                                        <input type="text" class="btn-form" value="{{old('number')}}" name="number"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="btn-form" value="{{old('complement')}}"
                                            name="complement">
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="form-group">
                                        <label for="neighborhood">Bairro<small>*</small></label>
                                        <input type="text" class="btn-form" id="neighborhood" value="{{old('neighborhood')}}"
                                            name="neighborhood" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="city">Cidade<small>*</small></label>
                                        <input type="text" class="btn-form" id="city" value="{{old('city')}}" name="city"
                                            required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="state">Estado<small>*</small></label>
                                        <select name="state" id="state" class="btn-form" required>
                                            <option selected disabled hidden>Selecione..</option>
                                            @foreach($states as $state)
                                            <option value="{{$state->initials}}">{{$state->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h4>Dados Financeiros</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="bank_code">Código Banco <small>*</small></label>
                                            <select name="bank_code" id="bank_code" class="select2" required>
                                                <option disabled hidden selected>Selecione...</option>
                                                @foreach($banks as $bank)
                                                <option value="{{$bank->bank_code}}"
                                                    {{$bank->bank_code == old('bank_code') ? "selected" : ""}}>
                                                    {{$bank->bank_code." - ". $bank->bank_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="agency">Agência <small>*</small></label>
                                            <input type="number" class="btn-form" value="{{old('agency')}}"
                                                name="agency" required>
                                        </div>
                                    </div>

                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="account">Conta (s/ dígito) <small>*</small></label>
                                            <input type="number" class="btn-form" value="{{old('account')}}"
                                                name="account" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-2">
                                        <div class="form-group">
                                            <label for="account_type">Dig. conta<small>*</small></label>
                                            <input type="number" class="btn-form" value="{{old('account_type')}}"
                                                name="account_type" required>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="name_holder">Nome Titular <small>*</small></label>
                                            <input type="text" class="btn-form" value="{{old('name_holder')}}"
                                                name="name_holder" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-xs-6">
                                        <div class="form-group">
                                            <label for="type_account">Tipo de Conta <small>*</small></label>
                                            <select name="type_account" id="type_account" class="btn-form">
                                                <option disabled hidden selected>Selecione...</option>
                                                <option value="1">Conta corrente</option>
                                                <option value="2">Conta poupança</option>
                                                <option value="3">Conta conjunta</option>
                                                <option value="4">Poupança conjunta</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label for="cpf_holder">CPF Titular <small>*</small></label>
                                            <input type="text" class="btn-form input-cpf" value="{{old('cpf_holder')}}"
                                                name="cpf_holder" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <button class="btn-form" type="submir">CONTINUAR</button>
                                    </div>
                                </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p class="text-center">&copy; 2019 Luz do Sol. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/i18n/pt-BR.js')}}"></script>

    <script src="{{asset('alertify/alertify.min.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#street").val("");
            $("#neighborhood").val("");
            $("#city").val("");
            $("#state").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep != "") {

                //Expressão regular para validar o CEP.
                var validacep = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if (validacep.test(cep)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#street").val("...");
                    $("#neighborhood").val("...");
                    $("#city").val("...");
                    $("#state").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#street").val(dados.logradouro);
                            $("#neighborhood").val(dados.bairro);
                            $("#city").val(dados.localidade);
                            $("#state").val(dados.uf);
                            
                            $('#street').attr('direadonlysabled', true);
                            $('#neighborhood').attr('readonly', true);
                            $('#city').attr('readonly', true);
                            $('#state').attr('readonly', true);
                        } //end if.
                        else {
                            //CEP pesquisado não foi encontrado.
                            limpa_formulário_cep();
                            alertify.error("CEP não encontrado.");
                        }
                    });
                } //end if.
                else {
                    //cep é inválido.
                    limpa_formulário_cep();
                    alertify.error("Formato de CEP inválido.");
                }
            } //end if.
            else {
                //cep sem valor, limpa formulário.
                limpa_formulário_cep();
            }
        });
    });
    $('.input-cep').inputmask({
        "mask": "99999-999",
        "placeholder": "_"
    });

    $('.input-cpf').inputmask({
        "mask": "999.999.999-99",
        "placeholder": "_"
    });
    $('.select2').select2({
        allowClear: true,
        placeholder: {
            id: "",
            placeholder: "Escolha..."
        }
    });

    $('.input-phone').focusout(function() {
        var phone = $(this).val().replace(/\D/g, '');
        if (phone.length > 10) {
            $(this).inputmask({
                "mask": "(99) 99999-9999",
                "placeholder": " "
            });
        } else {
            $(this).inputmask({
                "mask": "(99) 9999-99999",
                "placeholder": " "
            });
        }
    });
    </script>
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <script type="text/javascript">
    alertify.error("{{ $error }}");
    </script>
    @endforeach
    @endif
</body>

</html>