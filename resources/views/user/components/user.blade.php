<div id="box-child-{{ $user->id }}" class="child display-none">
    @foreach ($user->children as $child)
        <div class="row {{ $count % 2 == 0 ? 'gray' : ''}}">
            <div class="col-sm-1">
                <button type="button" class="btn btn-box-tool toggleChild status-total-{{$count + 1}} status-{{$child->status}} status-{{$child->status}}-{{$count + 1}}" data-child="{{ $child->id }}"><i
                        id="icon-{{ $child->id }}" class="fa fa-plus"></i>
                </button>
            </div>
            <div class="col-sm-3">
                <p><b>Nome:</b> {{ $child->name }}</p>
            </div>
            <div class="col-sm-3">
                <p><b>Graduação:</b> {{ $active == 1 ? $child->graduation_name : 'disponível após ATIVAÇÃO' }}</p>
            </div>
            <div class="col-sm-3">
                <p><b>Status:</b> {{ $active == 1 ? $child->status() : 'disponível após ATIVAÇÃO' }}</p>
            </div>
            <div class="col-sm-2">
                <p><b>Nível {{ $count }}</b></p>
            </div>
        </div>
        @if (count($child->children) > 0)
            @component('user.components.user', ['user' => $child, 'count' => $count + 1, 'active' => $active])
            @endcomponent
        @endif
    @endforeach
</div>
