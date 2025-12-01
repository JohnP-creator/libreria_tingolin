@extends('layouts.app')

@section('title', 'Editar Libro')

@section('content')
<div class="max-w-3xl mx-auto">
  <div class="bg-white rounded-lg shadow-xl p-8">
    <div class="flex items-center mb-6">
      <a href="{{ route('libros.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </a>
      <h1 class="text-3xl font-bold text-gray-800">✏️ Editar Libro</h1>
    </div>

    <form action="{{ route('libros.update', $libro) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Título -->
        <div class="md:col-span-2">
          <label for="titulo" class="block text-sm font-medium text-gray-700 mb-2">
            Título <span class="text-red-500">*</span>
          </label>
          <input type="text"
            name="titulo"
            id="titulo"
            value="{{ old('titulo', $libro->titulo) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('titulo') border-red-500 @enderror">
          @error('titulo')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Autor -->
        <div>
          <label for="autor" class="block text-sm font-medium text-gray-700 mb-2">
            Autor <span class="text-red-500">*</span>
          </label>
          <input type="text"
            name="autor"
            id="autor"
            value="{{ old('autor', $libro->autor) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('autor') border-red-500 @enderror">
          @error('autor')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- ISBN -->
        <div>
          <label for="isbn" class="block text-sm font-medium text-gray-700 mb-2">
            ISBN <span class="text-red-500">*</span>
          </label>
          <input type="text"
            name="isbn"
            id="isbn"
            value="{{ old('isbn', $libro->isbn) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('isbn') border-red-500 @enderror">
          @error('isbn')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Editorial -->
        <div>
          <label for="editorial" class="block text-sm font-medium text-gray-700 mb-2">
            Editorial
          </label>
          <input type="text"
            name="editorial"
            id="editorial"
            value="{{ old('editorial', $libro->editorial) }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('editorial') border-red-500 @enderror">
          @error('editorial')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Año de Publicación -->
        <div>
          <label for="año_publicacion" class="block text-sm font-medium text-gray-700 mb-2">
            Año de Publicación
          </label>
          <input type="number"
            name="año_publicacion"
            id="año_publicacion"
            value="{{ old('año_publicacion', $libro->año_publicacion) }}"
            min="1000"
            max="{{ date('Y') }}"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('año_publicacion') border-red-500 @enderror">
          @error('año_publicacion')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Precio -->
        <div>
          <label for="precio" class="block text-sm font-medium text-gray-700 mb-2">
            Precio (MXN) <span class="text-red-500">*</span>
          </label>
          <input type="number"
            name="precio"
            id="precio"
            value="{{ old('precio', $libro->precio) }}"
            step="0.01"
            min="0"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('precio') border-red-500 @enderror">
          @error('precio')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Stock -->
        <div>
          <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
            Stock <span class="text-red-500">*</span>
          </label>
          <input type="number"
            name="stock"
            id="stock"
            value="{{ old('stock', $libro->stock) }}"
            min="0"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('stock') border-red-500 @enderror">
          @error('stock')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Imagen del Libro -->
        <div class="md:col-span-2">
          <label for="imagen" class="block text-sm font-medium text-gray-700 mb-2">
            📸 Imagen del Libro
          </label>

          @if($libro->imagen)
          <div class="mb-4">
            <p class="text-sm text-gray-600 mb-2">Imagen actual:</p>
            <img src="{{ asset('storage/' . $libro->imagen) }}"
              alt="{{ $libro->titulo }}"
              class="w-48 h-64 object-cover rounded-lg shadow-md">
          </div>
          @endif

          <div class="flex items-center gap-4">
            <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <svg class="w-10 h-10 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
                <p class="mb-2 text-sm text-gray-500">
                  <span class="font-semibold">{{ $libro->imagen ? 'Cambiar imagen' : 'Subir imagen' }}</span>
                </p>
                <p class="text-xs text-gray-500">PNG, JPG, GIF (MAX. 2MB)</p>
              </div>
              <input type="file"
                name="imagen"
                id="imagen"
                class="hidden"
                accept="image/*"
                onchange="previewImage(event)">
            </label>
          </div>

          <!-- Preview de la nueva imagen -->
          <div id="imagePreview" class="mt-4 hidden">
            <p class="text-sm text-gray-600 mb-2">Nueva imagen:</p>
            <img id="preview" src="" alt="Preview" class="w-48 h-64 object-cover rounded-lg shadow-md">
          </div>

          @error('imagen')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Descripción -->
        <div class="md:col-span-2">
          <label for="descripcion" class="block text-sm font-medium text-gray-700 mb-2">
            Descripción
          </label>
          <textarea name="descripcion"
            id="descripcion"
            rows="4"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('descripcion') border-red-500 @enderror">{{ old('descripcion', $libro->descripcion) }}</textarea>
          @error('descripcion')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <!-- Botones -->
      <div class="flex justify-end gap-4 mt-8">
        <a href="{{ route('libros.index') }}" class="px-6 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">
          Cancelar
        </a>
        <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
          Actualizar Libro
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
      const reader = new FileReader();
      reader.onload = function(e) {
        document.getElementById('preview').src = e.target.result;
        document.getElementById('imagePreview').classList.remove('hidden');
      }
      reader.readAsDataURL(file);
    }
  }
</script>
@endsection