@extends('layouts.app')
@section('content')
    <div class="card">
        <div class="card-body">
            <h2>{{ $noticia->titulo }}</h2>
            <p class="text-muted small">{{ $noticia->categoria->nome ?? 'Sem categoria' }} - {{ $noticia->created_at->format('d/m/Y H:i') }}</p>
            <div>{!! nl2br(e($noticia->conteudo)) !!}</div>
            <a href="{{ route('noticias.index') }}" class="btn btn-link mt-3">Voltar</a>
        </div>
    </div>
@endsection
