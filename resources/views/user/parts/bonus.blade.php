<div class="col-lg-7">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <p>Bônus de consumo</p>
                    <h3 class="bonus">R$ {{$data['bonus']}}</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <p>Comissões da rede</p>
                    <h3 class="commission">R$ {{$data['commission']}}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <p>Bônus total</p>
                    <h3 class="total"> R$ {{$data['total']}}</h3>
                </div>
            </div>
        </div>
    </div>
</div>