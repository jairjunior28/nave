@extends('layouts.app')

@section('body-class', 'product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/city.jpg') }}');">
</div>

<div class="main main-raised">
    <div class="container">

        <div class="section">
            <h2 class="title text-center">Editar categoria selecionada</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="post" action="{{ url('/admin/categories/'.$category->id.'/edit') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group label-floating">
                            <label class="control-label">Nome da categoria</label>
                            <input type="text" class="form-control" name="name" value="{{ old('name', $category->name) }}">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label">Imagem da categoria</label>
                        <input type="file" name="image">
                        @if ($category->image)
                        <p class="help-block">
                            Upload (somente se você quiser substituir a
                            <a href="{{ asset('/images/categories/'.$category->image) }}" target="_blank">imagem atual</a>
                        </p>
                        @endif
                    </div>                    
                </div>

                <textarea class="form-control" placeholder="Descrição da categoria" rows="5" name="description">{{ old('description', $category->description) }}</textarea>

                <button class="btn btn-primary">Salvar alterações</button>
                <a href="{{ url('/admin/categories') }}" class="btn btn-default">Cancelar</a>
            </form>
        </div>

    </div>

</div>

@include('includes.footer')
@endsection
