@extends('layouts.app')
@section('title','Notícias')
@section('content')
    <div class="d-flex justify-content-between mb-3">
        <form class="d-flex" method="GET" action="{{ route('noticias.index') }}">
            <input class="form-control me-2" name="busca" placeholder="Buscar por título" value="{{ $busca ?? '' }}">
            <select name="categoria" class="form-select me-2">
                <option value="">Todas categorias</option>
                @foreach($categorias as $cat)
                    <option value="{{ $cat->id }}" @if(($categoriaFilter ?? '') == $cat->id) selected @endif>{{ $cat->nome }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-primary" type="submit">Buscar</button>
        </form>

        <a href="{{ route('noticias.create') }}" class="btn btn-primary">Nova notícia</a>
    </div>

    <div class="row g-4">
        @forelse($noticias as $n)
            <div class="col-md-4">
                <div class="card card-news shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $n->titulo }}</h5>
                        <p class="card-text small text-muted">{{ $n->categoria->nome ?? 'Sem categoria' }}</p>
                        <p class="card-text" style="flex:1; overflow:hidden; max-height:120px;">{{ Str::limit($n->conteudo, 250) }}</p>
                        <div class="mt-2">
                            <a href="{{ route('noticias.show',$n) }}" class="btn btn-sm btn-outline-secondary">Acessar</a>
                            <a href="{{ route('noticias.edit',$n) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                            <form action="{{ route('noticias.destroy',$n) }}" method="POST" class="d-inline" onsubmit="return confirm('Remover?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Remover</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12"><p>Nenhuma notícia encontrada.</p></div>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $noticias->links() }}
    </div>
@endsection
