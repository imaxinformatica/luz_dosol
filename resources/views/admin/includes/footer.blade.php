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
<script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/locales/bootstrap-datepicker.pt-BR.min.js">
</script>


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

<script type="text/javascript">
$('#type-transaction').on('change', function() {
    var type = $(this).val();
    if (type != 1) {
        $('#due_date').hide();
    } else {
        $('#due_date').show();
    }
});

//////////////////////////////////////////////////////////////////////////////////
$('.simple-text-editor').wysihtml5({
    toolbar: {
        "font-styles": false, // Font styling, e.g. h1, h2, etc.
        "emphasis": false, // Italics, bold, etc.
        "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": false, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": false, // Button to change color of font
        "blockquote": false
    }
});

$('.medium-text-editor').wysihtml5({
    toolbar: {
        "font-styles": false, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": true, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": true, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": true, // Button to change color of font
        "blockquote": false
    }
});




// Converte número do formato brasileiro para tipo float
function realToFloat(amount) {
    amount = amount.replace(/\./g, "");
    amount = amount.replace(",", ".");
    amount = parseFloat(amount);
    return amount;
}
// Converte número do formato float para o formato brasileiro
function floatToReal(n, c, d, t) {
    c = isNaN(c = Math.abs(c)) ? 2 : c, d = d == undefined ? "," : d, t = t == undefined ? "." : t, s = n < 0 ? "-" :
        "", i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", j = (j = i.length) > 3 ? j % 3 : 0;
    return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n -
        i).toFixed(c).slice(2) : "");
}
//////////////////////////////////////////////////////////////////////////////////
$('.act-delete').on('click', function(e) {
    e.preventDefault();
    $('#confirmationModal .modal-title').html('Confirmação');
    $('#confirmationModal .modal-body p').html('Tem certeza que deseja realizar esta exclusão?');
    var href = $(this).attr('href');
    $('#confirmationModal').modal('show').on('click', '#confirm', function() {
        window.location.href = href;
    });
});

$('.clear-filters').click(function() {
    $(':input', '#filterForm')
        .not(':button, :submit, :reset, :hidden')
        .val('')
        .prop('checked', false)
        .prop('selected', false);
});

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

// Mask
$(document).ready(function() {
    $('.input-telefone').each(function() {
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

    $('.input-cep').inputmask({
        "mask": "99999-999",
        "placeholder": "_"
    });

    $('.input-cnpj').inputmask({
        "mask": "99.999.999/9999-99",
        "placeholder": "_"
    });
    $('.input-cpf').inputmask({
        "mask": "999.999.999-99",
        "placeholder": "_"
    });

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


$('.alert .close').click(function() {
    $(this).parent().hide();
});

$('.input-date').datepicker({
    language: 'pt-BR',
    format: 'dd/mm/yyyy',
    autoclose: true
});
$('.input-slug').keyup(function() {
    var slug = slugify($(this).val());
    $(this).val(slug);
});

function upperCase(letter) {
    upper = letter.value.toUpperCase();
    letter.value = upper;
}


function slugify(string) {
    const a = 'àáäâãåăæçèéëêǵḧìíïîḿńǹñòóöôœøṕŕßśșțùúüûǘẃẍÿź·/_,:;'
    const b = 'aaaaaaaaceeeeghiiiimnnnooooooprssstuuuuuwxyz------'
    const p = new RegExp(a.split('').join('|'), 'g')
    return string.toString().toLowerCase()
        .replace(/\s+/g, '-') // Replace spaces with -
        .replace(p, c => b.charAt(a.indexOf(c))) // Replace special characters
        .replace(/&/g, '-and-') // Replace & with ‘and’
        .replace(/[^\w\-]+/g, '') // Remove all non-word characters
        .replace(/\-\-+/g, '-') // Replace multiple - with single -
    /*
    .replace(/^-+/, '') // Trim - from start of text
    .replace(/-+$/, '') // Trim - from end of text
    */
}

$(".input-money").maskMoney({
    thousands: '.',
    decimal: ',',
    allowZero: true,
    symbolStay: true
});
</script>
@yield('scripts')