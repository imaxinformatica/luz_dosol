@extends('admin.templates.default')

@section('title', 'Alterar Página')

@section('description', 'Descrição')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="row">
            <div class="col-sm-6">
                <h1>Alterar Página</h1>
            </div>
        </div>
    </section>
    @if(session()->has('success'))
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('success')}}
                </div>
            </section>
        </div>
    </section>
    @endisset
    @if(session()->has('error'))
    <section class="content-header">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{session('error')}}
                </div>
            </section>
        </div>
    </section>
    @endisset

    @if ($errors->any())
    <div class="content-header">
        @foreach ($errors->all() as $error)
        <div class="row">
            <div class="col-sm-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {{ $error }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    <!-- Main content -->
    <section class="content">
        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <section class="col-lg-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Dados</h3>
                    </div>
                    <form method="POST" action="{{route('admin.pages.update', ['page' => $page])}}">
                        {{csrf_field()}}
                        <input type="hidden" name="page_id" value="{{$page->id}}">
                        <div class="box-body">
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label>Nome <small>*</small></label>
                                    <input type="text" class="form-control" value="{{$page->name}}" name="name"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="slug">Slug <small>*</small></label>
                                    <input type="text" class="form-control input-slug" value="{{$page->slug}}" name="slug"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="meta_title">Meta Title <small>*</small></label>
                                    <input type="text" class="form-control" value="{{$page->meta_title}}" name="meta_title"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="meta_description">Meta Description <small>*</small></label>
                                    <textarea name="meta_description" id="meta_description" class="form-control" rows="5">{{$page->meta_description}}</textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-xs-12">
                                    <label for="content">Conteúdo <small>*</small></label>
                                    <textarea class="form-control medium-text-editor" name="content" rows="10">{{$page->content}}</textarea>
                                </div>
                            </div>

                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Editar</button>
                            <button type="button" class="btn btn-secondary"
                                onclick="window.location.href='{{route('admin.pages.index')}}'">Voltar</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </section>
</div>

@stop