<div class="col-lg-7">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h4>Bônus de consumo</h4>
                    <h4 class="bonus">R$ {{$data['bonus']}}</h4>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>

                <a href="#" class="small-box-footer">
                    @if(auth()->guard('user')->user()->status == 0)
                    Disponível após ATIVAÇÃO mensal
                    @else
                    -
                    @endif
                </a>
            </div>
        </div>
        <div class="col-xs-12 col-sm-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h4>Comissões da rede</h4>
                    <h4 class="commission">R$ {{$data['commission']}}</h4>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
                <a href="#" class="small-box-footer">
                    @if(auth()->guard('user')->user()->status == 0)
                    Disponível após ATIVAÇÃO mensal
                    @else
                    -
                    @endif
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h4>Bônus total</h4>
                    <h4 class="total"> R$ {{$data['total']}}</h4>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                </div>
                <a href="#" class="small-box-footer">
                    @if(auth()->guard('user')->user()->status == 0)
                    Disponível após ATIVAÇÃO mensal
                    @else
                    -
                    @endif
                </a>
            </div>
        </div>
    </div>
</div>