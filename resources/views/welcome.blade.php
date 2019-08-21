<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <title>Luz do Sol</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Última versão CSS compilada e minificada -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Tema opcional -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Última versão JavaScript compilada e minificada -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css?ver=1.5">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:100,300,400,700,800,900" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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

<section class="banner-example">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="box-banner-example">
                    <h1>BANNER DE EXEMPLO</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-sm-10">
                <div class="box-about">
                    <span>Sobre a Luz do Sol</span><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices commodo sapien, nec faucibus dolor condimentum ut. Donec semper mauris ut dui viverra, vel malesuada quam mollis. Phasellus molestie bibendum tempus. Morbi nec venenatis elit, lobortis porta diam. Aliquam erat volutpat. Cras semper ex magna, vel porttitor felis elementum eget. Quisque felis libero, pulvinar in aliquet ac, sodales commodo sapien. Nam dignissim volutpat turpis, ut pharetra leo suscipit non. Nunc accumsan augue id malesuada rhoncus. Vestibulum rhoncus diam sodales neque egestas, sed auctor quam aliquet. Morbi at dolor tortor. Donec viverra fermentum ante, at pulvinar nisi condimentum sed.</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="box-about">
                    <span>Missão</span><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices commodo sapien, nec faucibus dolor condimentum ut. Donec semper mauris ut dui viverra, vel malesuada quam mollis. Phasellus molestie bibendum tempus. Morbi nec venenatis elit, lobortis porta diam. .</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-about">
                    <span>Visão</span><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices commodo sapien, nec faucibus dolor condimentum ut. Nam dignissim volutpat turpis, ut pharetra leo suscipit non. Nunc accumsan augue id malesuada rhoncus Donec semper mauris ut dui viverra, vel malesuada quam mollis. Phasellus molestie bibendum tempus.</p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="box-about">
                    <span>Valor</span><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ultrices commodo sapien, nec faucibus dolor condimentum ut. Nam dignissim volutpat turpis, ut pharetra leo suscipit non.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-sm-9">
                <p>&copy; 2019 Luz do Sol. Todos os direitos reservados.</p>
            </div>
            <div class="col-sm-3">
                <button class="btn-footer" onclick="window.location.href='{{url('user/login')}}';">ESCRITÓRIO VIRTUAL</button>
            </div>
        </div>
    </div>
</footer>

</body>
</html>