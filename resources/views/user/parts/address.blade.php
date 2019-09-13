<div class="row">
    <div class="col-sm-12">
        <h5>Endereço de cobrança</h5>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label for="zip_code_billing">CEP</label>
            <input type="text" name="zip_code_billing" onblur="pesquisacep(this.value);" class="form-control input-cep" onfocus="maskCep();">
        </div>
    </div>
    <div class="col-xs-8">
        <div class="form-group">
            <label for="street_billing">Rua</label>
            <input type="text" name="street_billing" id="street_billing" class="form-control">
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label for="number_billing">Número</label>
            <input type="text" name="number_billing" id="number_billing" class="form-control">
        </div>
    </div>
    <div class="col-xs-8">
        <div class="form-group">
            <label for="neighborhood_billing">Bairro</label>
            <input type="text" name="neighborhood_billing" id="neighborhood_billing" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xs-4">
        <div class="form-group">
            <label for="complement_billing">Complemento</label>
            <input type="text" name="complement_billing" id="complement_billing" class="form-control">
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="city_billing">Cidade</label>
            <input type="text" name="city_billing" id="city_billing" class="form-control">
        </div>
    </div>
    <div class="col-xs-4">
        <div class="form-group">
            <label for="state_billing">Estado</label>
            <input type="text" name="state_billing" id="state_billing" class="form-control">
        </div>
    </div>
</div>
<hr>
