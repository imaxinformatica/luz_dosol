<div class="row">
    <div class="col-xs-12">
        <div class="form-group">
            <label for="holder_name">Nome no cartão</label>
            <input type="text" name="holder_name" id="holder_name" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label for="cpf_holder">CPF titular</label>
            <input type="text" name="cpf_holder" id="cpf_holder" class="form-control input-cpf" onfocus="maskCpf();">
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label for="birthdate">Data de nascimento titular</label>
            <input type="text" name="birthdate" id="birthdate" class="form-control input-date" onfocus="maskDate();" autocomplete="off">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-6">
        <div class="form-group">
            <label for="number_card">Número Cartão</label>
            <input type="text" class="form-control" name="number_card" id="number_card">
        </div>
    </div>
    <div class="col-xs-6">
        <div class="form-group">
            <label for="brand">Bandeira</label>
            <select name="brand" id="brand" class="form-control">
                <option value="elo">Elo</option>
                <option value="visa">Visa</option>
                <option value="mastercard">Mastercard</option>
                <option value="hipercard">Hipercard</option>
                <option value="amex">Amex</option>
            </select>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-3 col-xs-4">
        <div class="form-group">
            <label for="expiration_month">Mês Venc.</label>
            <select name="expiration_month" id="expiration_month" class="form-control">
                <option selected disabled>..</option>
                @for($i=1; $i <= 12; $i++) <option value="{{$i}}">{{$i}}</option>
                    @endfor
            </select>
        </div>
    </div>
    <?php $year =  date('Y') ?>
    @php($year = date('Y'))
    <div class="col-sm-3 col-xs-4">
        <div class="form-group">
            <label for="expiration_year">Ano Venc.</label>
            <select name="expiration_year" id="expiration_year" class="form-control">
                <option selected disabled>..</option>
                @for($i = 0; $i < 15; $i++) <option value="{{$year+$i}}">{{$year+$i}}</option>
                    @endfor
            </select>
        </div>
    </div>
    <div class="col-sm-2 col-xs-4">
        <div class="form-group">
            <label for="cvv">CVV</label>
            <input type="text" class="form-control" name="cvv" id="cvv" onkeyup="getTokenCreditCard();">
        </div>
    </div>
    <div class="col-sm-4 col-xs-12">
        <div class="form-group">
            <label for="isBilling">Endereço do titular do cartão</label>
            <select name="isBilling" id="isBilling" class="form-control">
                <option value="1" selected>Mesmo endereço de entrega</option>
                <option value="0">Outro</option>
            </select>
        </div>
    </div>
</div>
<div id="address"></div> <!-- Coloca o conteudo do endereço-->
