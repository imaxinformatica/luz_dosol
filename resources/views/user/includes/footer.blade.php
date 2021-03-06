<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Versão</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2019 <b>Luz do Sol</b>.</strong> Todos os direitos reservados.
</footer>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="{{ asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ asset('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ asset('plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ asset('bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ asset('bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{ asset('bower_components/select2/dist/js/i18n/pt-BR.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ asset('bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.js?ver=1.1')}}"></script>

<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-maskmoney/3.0.2/jquery.maskMoney.min.js"></script>
<!-- Pagseguro Sandbox -->
<script type="text/javascript" src=
"https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>

<script type="text/javascript"
src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js">
</script>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">
$('.change-avatar').on('click', function(){
  $('#changeAvatar').modal('show');
});
  
  // Converte número do formato brasileiro para tipo float
  function realToFloat(amount){
    amount = amount.replace(/\./g, "");
    amount = amount.replace(",", ".");
    amount = parseFloat(amount);
    return amount;
  }
  // Converte número do formato float para o formato brasileiro
  function floatToReal(n, c, d, t){
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" : "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
  }
// ***********************//
  $('.act-delete').on('click', function (e) {
    e.preventDefault();
    $('#confirmationModal .modal-title').html('Confirmação');
    $('#confirmationModal .modal-body p').html('Tem certeza que deseja realizar esta exclusão?');
    var href = $(this).attr('href');
    $('#confirmationModal').modal('show').on('click', '#confirm', function() {
      window.location.href=href;
    });
  });

  function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    $('#street_billing').val("");
    $('#neighborhood_billing').val("");
    $('#city_billing').val("");
    $('#state_billing').val("");
  }
  // $(document).ready(function() {
  //     validatePix();
  // });
        
  $('.key_type').on('change', function() {
      validatePix();
  });
  function validatePix() {
      let type = $('.key_type').val();
      if (type == 'cpf') {
          $('.key').addClass('input-cpf');
          $('.key').removeClass('input-key');
          $('.key').removeClass('input-phone');
          $('.key').attr('type', 'text');
      } else if (type == 'email') {
          $('.key').removeClass('input-cpf');
          $('.key').removeClass('input-key');
          $('.key').removeClass('input-phone');
          $('.key').attr('type', 'email');
      } else if (type == 'cellphone') {
          $('.key').addClass('input-phone');
          $('.key').removeClass('input-cpf');
          $('.key').removeClass('input-key');
          $('.key').attr('type', 'text');
      } else {
          $('.key').addClass('input-key');
          $('.key').removeClass('input-cpf');
          $('.key').removeClass('input-phone');
          $('.key').attr('type', 'text');
      }
  }

  function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
      //Atualiza os campos com os valores.
      $('#street_billing').val(conteudo.logradouro);
      $('#neighborhood_billing').val(conteudo.bairro);
      $('#city_billing').val(conteudo.localidade);
      $('#state_billing').val(conteudo.uf);
    } //end if.
    else {
      //CEP não Encontrado.
      limpa_formulário_cep();
      $('#modalCEPNotFound').modal('show');
    }
  }
        
    function pesquisacep(valor) {
        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;
            //Valida o formato do CEP.
            if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                $('#street_billing').val("Carregando...");
                $('#neighborhood_billing').val("Carregando...");
                $('#city_billing').val("Carregando...");
                $('#state_billing').val("Carregando...");

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                $('#modalCEPNotFound').modal('show');
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

  // Mask
  $( document ).ready(function() {
    $('.input-telefone').each( function(){
      var phone = $(this).val().replace(/\D/g, '');
      if(phone.length > 10){
        $(this).inputmask({"mask": "(99) 99999-9999", "placeholder":" "});
      } else {
        $(this).inputmask({"mask": "(99) 9999-99999", "placeholder":" "});
      }
    });

    $('.input-cep').inputmask({"mask": "99999-999", "placeholder":"_"});
    $('.input-cpf').inputmask({"mask": "999.999.999-99", "placeholder":"_"});

    $('.input-cnpj').inputmask({"mask": "99.999.999/9999-99", "placeholder":"_"});

  });
  function maskCpf(){
    $('.input-cpf').inputmask({"mask": "999.999.999-99", "placeholder":"_"});
      
  }

  function maskCep(){
    $('.input-cep').inputmask({"mask": "99999-999", "placeholder":"_"});
      
  }
  function maskDate(){
    $('.input-date').datepicker({
      language: 'pt-BR',
      format: 'dd/mm/yyyy',
      autoclose: true
  });
      
  }

  $('.input-phone').focusout( function(){
    var phone = $(this).val().replace(/\D/g, '');
    if(phone.length > 10){
      $(this).inputmask({"mask": "(99) 99999-9999", "placeholder":" "});
    } else {
      $(this).inputmask({"mask": "(99) 9999-99999", "placeholder":" "});
    }
  });

  function copyClipboard()
  {
    $('input').select();
    var copiar = document.execCommand('copy');
    if(copiar){
      $('#copyClipboard').popover();
    }else{
      alert('Erro ao copiar, seu navegador pode não ter suporte a essa função.');
      
    }
  }
  
  var lastday = function(y,m){
    return  new Date(y, m +1, 0).getDate();
  }
  $(document).ready(function(){
    timeOut()
  });
  function timeOut(){
    let d = new Date();
    let yearActual = d.getFullYear();
    let monthActual = d.getMonth();
    let hours = d.getHours();
    let lastDay = lastday(yearActual, monthActual);
    // Set the date we're counting down to
    if(monthActual == 12){
        monthActual = 1;
        yearActual = yearActual+1;
    }else{
        monthActual = monthActual+1;
    }
    let countDownDate = new Date(yearActual, monthActual, 1, 0, 0, 0, 0).getTime();

    // Update the count down every 1 second
    let x = setInterval(function() {

    // Get today's date and time
    let now = new Date().getTime();
        
    // Find the distance between now and the count down date
    let distance = countDownDate - now;
        
    // Time calculations for days, hours, minutes and seconds
    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
    // Output the result in an element with id="timeOut"
    $('.timeOut').html(days + "d " + hours + "h "
    + minutes + "m " + seconds + "s ");
        
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
        $('.timeOut').html('Ciclo Finalizado');
    }
    }, 1000);
}
    

$('.clear-filters').click(function() {
    $(':input', '#filterForm')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
});
	$('.alert .close').click( function(){
    $(this).parent().hide();
  });

	$('.input-date').datepicker({
      language: 'pt-BR',
      format: 'dd/mm/yyyy',
      autoclose: true
  });

  $(".input-money").maskMoney({
      thousands:'.', 
      decimal:',', 
      allowZero: true,
      symbolStay: true
  });
 
</script>

@yield('scripts')