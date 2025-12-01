<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibroController extends Controller
{
  public function index()
  {
    $libros = Libro::latest()->paginate(10);
    return view('libros.index', compact('libros'));
  }

  public function create()
  {
    return view('libros.create');
  }

  public function store(Request $request)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'autor' => 'required|string|max:255',
      'isbn' => 'required|string|unique:libros,isbn|max:20',
      'descripcion' => 'nullable|string',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'precio' => 'required|numeric|min:0',
      'stock' => 'required|integer|min:0',
      'editorial' => 'nullable|string|max:255',
      'año_publicacion' => 'nullable|integer|min:1000|max:' . date('Y')
    ], [
      'titulo.required' => 'El título es obligatorio',
      'autor.required' => 'El autor es obligatorio',
      'isbn.required' => 'El ISBN es obligatorio',
      'isbn.unique' => 'Este ISBN ya está registrado',
      'imagen.image' => 'El archivo debe ser una imagen',
      'imagen.mimes' => 'La imagen debe ser formato: jpeg, png, jpg o gif',
      'imagen.max' => 'La imagen no debe pesar más de 2MB',
      'precio.required' => 'El precio es obligatorio',
      'precio.min' => 'El precio debe ser mayor a 0',
      'stock.required' => 'El stock es obligatorio',
      'stock.min' => 'El stock no puede ser negativo'
    ]);

    // Manejar la subida de imagen
    if ($request->hasFile('imagen')) {
      $validated['imagen'] = $request->file('imagen')->store('libros', 'public');
    }

    Libro::create($validated);

    return redirect()->route('libros.index')
      ->with('success', '¡Libro agregado exitosamente!');
  }

  public function show(Libro $libro)
  {
    return view('libros.show', compact('libro'));
  }

  public function edit(Libro $libro)
  {
    return view('libros.edit', compact('libro'));
  }

  public function update(Request $request, Libro $libro)
  {
    $validated = $request->validate([
      'titulo' => 'required|string|max:255',
      'autor' => 'required|string|max:255',
      'isbn' => 'required|string|max:20|unique:libros,isbn,' . $libro->id,
      'descripcion' => 'nullable|string',
      'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
      'precio' => 'required|numeric|min:0',
      'stock' => 'required|integer|min:0',
      'editorial' => 'nullable|string|max:255',
      'año_publicacion' => 'nullable|integer|min:1000|max:' . date('Y')
    ]);

    // Manejar la nueva imagen
    if ($request->hasFile('imagen')) {
      // Eliminar la imagen anterior si existe
      if ($libro->imagen) {
        Storage::disk('public')->delete($libro->imagen);
      }
      $validated['imagen'] = $request->file('imagen')->store('libros', 'public');
    }

    $libro->update($validated);

    return redirect()->route('libros.index')
      ->with('success', '¡Libro actualizado exitosamente!');
  }

  public function destroy(Libro $libro)
  {
    // Eliminar la imagen si existe
    if ($libro->imagen) {
      Storage::disk('public')->delete($libro->imagen);
    }

    $libro->delete();

    return redirect()->route('libros.index')
      ->with('success', '¡Libro eliminado exitosamente!');
  }
}
