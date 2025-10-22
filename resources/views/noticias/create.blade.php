@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h4>Cadastrar Notícia</h4>
            <form method="POST" action="{{ route('noticias.store') }}">
                @csrf
                <div class="mb-3">
                    <label>Título</label>
                    <input name="titulo" value="{{ old('titulo') }}" class="form-control">
                    @error('titulo')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Categoria</label>
                    <select name="categoria_id" class="form-select">
                        <option value="">Selecione</option>
                        @foreach($categorias as $c)
                            <option value="{{ $c->id }}" @if(old('categoria_id')==$c->id) selected @endif>{{ $c->nome }}</option>
                        @endforeach
                    </select>
                    @error('categoria_id')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label>Conteúdo</label>
                    <textarea name="conteudo" rows="8" class="form-control">{{ old('conteudo') }}</textarea>
                    @error('conteudo')<div class="text-danger">{{ $message }}</div>@enderror
                </div>
                <button class="btn btn-primary">Salvar</button>
                <a href="{{ route('noticias.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
@endsection
