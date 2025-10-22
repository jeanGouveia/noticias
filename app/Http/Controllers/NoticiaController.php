<?php
namespace App\Http\Controllers;
use App\Models\Noticia;
use App\Models\Categoria;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index(Request $request)
    {
        $busca = $request->input('busca');
        $categoriaFilter = $request->input('categoria');

        $query = Noticia::with('categoria');

        if ($busca) {
            $query->where('titulo', 'like', "%{$busca}%");
        }

        if ($categoriaFilter) {
            $query->where('categoria_id', $categoriaFilter);
        }

        $noticias = $query->latest()->paginate(6)->withQueryString();
        $categorias = Categoria::orderBy('nome')->get();

        return view('noticias.index', compact('noticias','categorias','busca','categoriaFilter'));
    }

    public function create()
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('noticias.create', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo'=>'required|string|max:255',
            'conteudo'=>'required|string',
            'categoria_id'=>'required|exists:categorias,id'
        ]);

        Noticia::create($data);
        return redirect()->route('noticias.index')->with('success','Notícia cadastrada.');
    }

    public function show(Noticia $noticia)
    {
        $noticia->load('categoria');
        return view('noticias.show', compact('noticia'));
    }

    public function edit(Noticia $noticia)
    {
        $categorias = Categoria::orderBy('nome')->get();
        return view('noticias.edit', compact('noticia','categorias'));
    }

    public function update(Request $request, Noticia $noticia)
    {
        $data = $request->validate([
            'titulo'=>'required|string|max:255',
            'conteudo'=>'required|string',
            'categoria_id'=>'required|exists:categorias,id'
        ]);

        $noticia->update($data);
        return redirect()->route('noticias.index')->with('success','Notícia atualizada.');
    }

    public function destroy(Noticia $noticia)
    {
        $noticia->delete();
        return redirect()->route('noticias.index')->with('success','Notícia removida.');
    }
}
