@extends('layouts.app')
@section('title', 'Categorias')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Categorias</h3>
        <a href="{{ route('categorias.create') }}" class="btn btn-primary">Nova Categoria</a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Criado em</th>
                        <th class="text-end">Ações</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nome }}</td>
                            <td>{{ $categoria->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">
                                <a href="{{ route('categorias.edit', $categoria) }}"
                                   class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="{{ route('categorias.destroy', $categoria) }}"
                                      method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                Nenhuma categoria cadastrada.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $categorias->links() }}
    </div>
@endsection
