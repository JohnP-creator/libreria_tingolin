@extends('layouts.app')

@section('title', $libro->titulo)

@section('content')
<div class="max-w-5xl mx-auto">
  <div class="bg-white rounded-lg shadow-xl overflow-hidden">
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 px-8 py-6">
      <div class="flex items-center">
        <a href="{{ route('libros.index') }}" class="text-white hover:text-gray-200 mr-4">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
        </a>
        <div>
          <h1 class="text-3xl font-bold text-white">{{ $libro->titulo }}</h1>
          <p class="text-purple-100 text-lg mt-1">por {{ $libro->autor }}</p>
        </div>
      </div>
    </div>

    <!-- Contenido Principal -->
    <div class="p-8">
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Columna Izquierda: Imagen -->
        <div class="lg:col-span-1">
          @if($libro->imagen)
          <div class="sticky top-8">
            <img src="{{ asset('storage/' . $libro->imagen) }}"
              alt="{{ $libro->titulo }}"
              class="w-full rounded-lg shadow-2xl object-cover"
              style="max-height: 500px;">
            <div class="mt-4 text-center">
              <span class="inline-block bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold">
                Portada Original
              </span>
            </div>
          </div>
          @else
          <div class="bg-gradient-to-br from-purple-100 to-indigo-100 rounded-lg shadow-lg p-12 flex items-center justify-center" style="min-height: 400px;">
            <div class="text-center">
              <svg class="w-32 h-32 mx-auto text-purple-300 mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z" />
              </svg>
              <p class="text-purple-400 font-medium">Sin imagen disponible</p>
            </div>
          </div>
          @endif
        </div>

        <!-- Columna Derecha: Información -->
        <div class="lg:col-span-2 space-y-6">
          <!-- Información del Libro -->
          <div class="bg-purple-50 rounded-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">📚 Información del Libro</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p class="text-sm text-gray-600 font-semibold uppercase mb-1">ISBN</p>
                <p class="text-gray-800 text-lg">{{ $libro->isbn }}</p>
              </div>

              @if($libro->editorial)
              <div>
                <p class="text-sm text-gray-600 font-semibold uppercase mb-1">Editorial</p>
                <p class="text-gray-800 text-lg">{{ $libro->editorial }}</p>
              </div>
              @endif

              @if($libro->año_publicacion)
              <div>
                <p class="text-sm text-gray-600 font-semibold uppercase mb-1">Año de Publicación</p>
                <p class="text-gray-800 text-lg">{{ $libro->año_publicacion }}</p>
              </div>
              @endif

              <div>
                <p class="text-sm text-gray-600 font-semibold uppercase mb-1">Autor</p>
                <p class="text-gray-800 text-lg">{{ $libro->autor }}</p>
              </div>
            </div>
          </div>

          <!-- Precio y Stock -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 border-2 border-green-200">
              <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">💰 Precio</h3>
              <p class="text-4xl font-bold text-green-600">
                ${{ number_format($libro->precio, 2) }}
              </p>
              <p class="text-sm text-gray-600 mt-1">MXN</p>
            </div>

            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6 border-2 border-blue-200">
              <h3 class="text-sm font-semibold text-gray-600 uppercase mb-2">📦 Stock Disponible</h3>
              <div class="flex items-baseline gap-3">
                <p class="text-4xl font-bold {{ $libro->stock > 0 ? 'text-blue-600' : 'text-red-600' }}">
                  {{ $libro->stock }}
                </p>
                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $libro->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                  {{ $libro->stock > 0 ? '✓ Disponible' : '✗ Agotado' }}
                </span>
              </div>
            </div>
          </div>

          <!-- Descripción -->
          @if($libro->descripcion)
          <div class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-3 flex items-center gap-2">
              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
              </svg>
              Descripción
            </h3>
            <p class="text-gray-700 leading-relaxed text-justify">{{ $libro->descripcion }}</p>
          </div>
          @endif

          <!-- Información de Registro -->
          <div class="border-t pt-6">
            <h3 class="text-sm font-semibold text-gray-600 uppercase mb-3">⏱️ Información de Registro</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-600">
              <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                <div>
                  <span class="font-medium">Registrado:</span>
                  {{ $libro->created_at->format('d/m/Y H:i') }}
                </div>
              </div>
              <div class="flex items-center gap-2">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                </svg>
                <div>
                  <span class="font-medium">Actualizado:</span>
                  {{ $libro->updated_at->format('d/m/Y H:i') }}
                </div>
              </div>
            </div>
          </div>

          <!-- Botones de Acción -->
          <div class="flex flex-wrap justify-end gap-4 pt-6 border-t">
            <a href="{{ route('libros.edit', $libro) }}"
              class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center gap-2 shadow-md hover:shadow-lg">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Editar Libro
            </a>

            <form action="{{ route('libros.destroy', $libro) }}"
              method="POST"
              onsubmit="return confirm('¿Estás seguro de eliminar este libro? Esta acción no se puede deshacer.')">
              @csrf
              @method('DELETE')
              <button type="submit"
                class="px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition flex items-center gap-2 shadow-md hover:shadow-lg">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
                Eliminar Libro
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection