<div id="box-child-{{ $user->id }}" class="child display-none">
    @foreach ($user->children as $child)
        <div class="row">
            <div class="col-sm-1">
                <button type="button" class="btn btn-box-tool toggleChild" data-child="{{ $child->id }}"><i
                        id="icon-{{ $child->id }}" class="fa fa-plus"></i>
                </button>
            </div>
            <div class="col-sm-3">
                <p><b>Nome:</b> {{ $child->name }}</p>
            </div>
            <div class="col-sm-3">
                <p><b>E-mail:</b> {{ $child->name }}</p>
            </div>
            <div class="col-sm-3">
                <p><b>Graduação:</b> {{ $child->graduation_name }}</p>
            </div>
            <div class="col-sm-2">
                <p><b>Status:</b> {{ $child->status() }}</p>
            </div>
        </div>
        @if (count($child->children) > 0)
            @component('user.components.user', ['user' => $child])
            @endcomponent
        @endif
    @endforeach
</div>
