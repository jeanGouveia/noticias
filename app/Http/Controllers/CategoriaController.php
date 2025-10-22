<?php
namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate(['nome'=>'required|string|max:100|unique:categorias,nome']);
        Categoria::create($data);
        return redirect()->route('categorias.index')->with('success','Categoria criada.');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate(['nome'=>'required|string|max:100|unique:categorias,nome,'.$categoria->id]);
        $categoria->update($data);
        return redirect()->route('categorias.index')->with('success','Categoria atualizada.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success','Categoria removida.');
    }
}
