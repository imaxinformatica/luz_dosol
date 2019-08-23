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

    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css?ver=1.5')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700,800,900" rel="stylesheet">
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
                        @if($user)
                        <form method="post" action="{{route('register.session')}}">
                            {{csrf_field()}}
                            <div class="row">
                                <div class="col-sm-12">
                                    <h3>Cadastro</h3>
                                    <p>Antes de continuar com seu cadastro, por favor, confirme os dados do seu
                                        patrocinador</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="id">ID do patrocinador</label>
                                    <input type="text" name="id" id="id" value="{{$user->id}}" readonly>
                                </div>
                                <div class="col-sm-8">
                                    <label for="namepat">Nome do patrocinador</label>
                                    <input type="text" name="namepat" id="namepat" value="{{$user->name}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <button class="btn-form" type="submit">CONTINUAR</button>
                                </div>
                            </div>
                        </form>
                        @else
                        <div class="row">
                            <h3>Convite Inválido</h3>
                            <p>O convite apresentado é inválido, apresente um convite de um patrocinador válido.</p>
                        </div>
                        @endif
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

</body>

</html>