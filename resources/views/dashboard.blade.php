<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Contributions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @foreach ($links as $link)
                        <li>{{$link->title}}</li>
                    @endforeach
                    {{$links->links()}}
                    <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>
                </div>
                <!-- El código lo que hace es recorrer un arrays de links, por cada link del array genere un li donde se pone cada titulo de cada link,
                {{$links->links()}}) }} este ultimo código lo que hace es generar los enlaces de paginacion.
                El código <small>Contributed by: {{$link->creator->name}} {{$link->updated_at->diffForHumans()}}</small>, lo que hace es: obtiene el nombre del creador del link y ademas pone el momento en el que se actualizó de una forma legible para los humanos
                -->
            </div>
        </div>
    </div>
</x-app-layout>