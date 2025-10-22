@extends('layouts.app')
@section('title', 'Editar Notícia')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Editar Notícia</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('noticias.update', $noticia) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input name="titulo" value="{{ old('titulo', $noticia->titulo) }}"
                           class="form-control @error('titulo') is-invalid @enderror" required>
                    @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Categoria</label>
                    <select name="categoria_id" class="form-select @error('categoria_id') is-invalid @enderror">
                        <option value="">Selecione uma categoria</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('categoria_id', $noticia->categoria_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Conteúdo</label>
                    <textarea name="conteudo" rows="10"
                              class="form-control @error('conteudo') is-invalid @enderror">{{ old('conteudo', $noticia->conteudo) }}</textarea>
                    @error('conteudo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Atualizar Notícia</button>
                    <a href="{{ route('noticias.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection
