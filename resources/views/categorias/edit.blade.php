@extends('layouts.app')
@section('title', 'Editar Categoria')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Editar Categoria</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('categorias.update', $categoria) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome da Categoria</label>
                    <input type="text" name="nome" id="nome" class="form-control @error('nome') is-invalid @enderror"
                           value="{{ old('nome', $categoria->nome) }}" required>
                    @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Atualizar</button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
