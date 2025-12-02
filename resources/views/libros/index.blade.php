@extends('layouts.app')

@section('title', 'Catálogo de Libros')

@section('content')
<div class="bg-white rounded-lg shadow-xl p-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            📚 Catálogo de Libros
        </h1>
        <span class="bg-purple-100 text-purple-800 px-4 py-2 rounded-full text-sm font-semibold">
            {{ $libros->total() }} libros registrados
        </span>
    </div>

    <!-- Barra de Búsqueda -->
    <form action="{{ route('libros.index') }}" method="GET" class="mb-6">
        <div class="flex gap-2">
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </div>
                <input type="text" 
                       name="search" 
                       value="{{ request('search') }}"
                       class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                       placeholder="Buscar por título, autor, ISBN o editorial...">
            </div>
            <button type="submit" 
                    class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition font-medium whitespace-nowrap">
                Buscar
            </button>
            @if(request('search'))
                <a href="{{ route('libros.index') }}" 
                   class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-medium whitespace-nowrap">
                    Limpiar
                </a>
            @endif
        </div>
        @if(request('search'))
            <p class="mt-3 text-sm text-gray-600">
                Mostrando resultados para: <span class="font-semibold text-purple-600">"{{ request('search') }}"</span>
            </p>
        @endif
    </form>

    @if($libros->isEmpty())
        <div class="text-center py-12">
            <svg class="mx-auto h-24 w-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
            @if(request('search'))
                <h3 class="mt-4 text-lg font-medium text-gray-900">No se encontraron resultados</h3>
                <p class="mt-2 text-gray-500">No hay libros que coincidan con tu búsqueda "{{ request('search') }}"</p>
                <div class="mt-6">
                    <a href="{{ route('libros.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                        Ver todos los libros
                    </a>
                </div>
            @else
                <h3 class="mt-4 text-lg font-medium text-gray-900">No hay libros registrados</h3>
                <p class="mt-2 text-gray-500">Comienza agregando tu primer libro al catálogo.</p>
                <div class="mt-6">
                    <a href="{{ route('libros.create') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700">
                        + Agregar Primer Libro
                    </a>
                </div>
            @endif
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($libros as $libro)
                <div class="book-card bg-gradient-to-br from-purple-50 to-indigo-50 rounded-lg shadow-md overflow-hidden flex flex-col">
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-3">
                            <h3 class="text-xl font-bold text-gray-800 line-clamp-2">
                                {{ $libro->titulo }}
                            </h3>
                            <span class="bg-purple-500 text-white px-2 py-1 rounded text-xs font-semibold whitespace-nowrap ml-2">
                                ${{ number_format($libro->precio, 2) }}
                            </span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-2">
                            <span class="font-semibold">✍️ Autor:</span> {{ $libro->autor }}
                        </p>
                        
                        <p class="text-gray-600 text-sm mb-2">
                            <span class="font-semibold">📖 ISBN:</span> {{ $libro->isbn }}
                        </p>
                        
                        @if($libro->editorial)
                            <p class="text-gray-600 text-sm mb-2">
                                <span class="font-semibold">🏢 Editorial:</span> {{ $libro->editorial }}
                            </p>
                        @endif
                        
                        <div class="flex items-center mt-3">
                            <span class="text-sm {{ $libro->stock > 0 ? 'text-green-600' : 'text-red-600' }} font-semibold">
                                📦 Stock: {{ $libro->stock }}
                            </span>
                        </div>

                        @if($libro->descripcion)
                            <p class="text-gray-700 text-sm mt-3 line-clamp-3">
                                {{ $libro->descripcion }}
                            </p>
                        @endif
                    </div>
                    
                    <div class="bg-white px-6 py-3 flex justify-between items-center border-t mt-auto">
                        <a href="{{ route('libros.show', $libro) }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                            Ver detalles →
                        </a>
                        <div class="flex gap-2">
                            <a href="{{ route('libros.edit', $libro) }}" class="text-blue-600 hover:text-blue-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <form action="{{ route('libros.destroy', $libro) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este libro?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="mt-8">
            {{ $libros->appends(['search' => request('search')])->links() }}
        </div>
    @endif
</div>
@endsection
