<?php

namespace App\Http\Controllers;

use App\Models\libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['libros'] = libro::paginate(2);
        return view('libro.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('libro.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $campos = [
            'nombre'=>'required|string|max:191',
            'url'=>'required|string|max:191',
            'imagen'=>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje = [
            "required"=>'El campo :attribute es requerido',
            "imagen.mimes"=>'La imagen debe ser jpeg, png o jpg'
        ];
        $this->validate($request, $campos, $mensaje);

        $datos = request()->all();

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }

        Libro::create($datos);
        return redirect('libro')->with('mensaje', 'Libro agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(libro $libro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
       // echo $id;
        $libro = Libro::findOrFail($id);
        return view('libro.edit', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $campos = [
            'nombre'=>'required|string|max:191',
            'url'=>'required|string|max:191',

        ];
        $mensaje = [
            "required"=>'El campo :attribute es requerido',
            
        ];

        if($request->hasFile('imagen')) {
            $campos = ['imagen'=>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje = ['imagen.mimes'=>'La imagen debe ser jpeg, png o jpg'];
        }

        $this->validate($request, $campos, $mensaje);

        $libro = Libro::findOrFail($id);
        $datos = $request->all();

        if($request->hasFile('imagen')) {
            Storage::delete('public/'.$libro->imagen);
            $datos['imagen'] = $request->file('imagen')->store('uploads', 'public');
        }

        $libro->update($datos);
        return redirect('/libro')->with('mensaje', 'Libro modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $libro = Libro::findOrFail($id);
        Storage::delete('public/'.$libro->imagen);
        $libro->delete();
        
        return redirect('/libro')->with('mensaje', 'Libro eliminado con exito');
    }
}
