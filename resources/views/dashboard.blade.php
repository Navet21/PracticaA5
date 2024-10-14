<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Contributions') }}
        </h2>
        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('status') }}
            </div>
        @endif
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <!-- Caja para los links -->
                <div class="col-span-2 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                    @if($links->isEmpty())
                        <p>No se encontraron links</p>

                    @else
                        <ul>
                            @foreach ($links as $link)
                                <li class="mb-4 p-4 border border-gray-300 dark:border-gray-700 rounded-lg">
                                    <div class="font-semibold text-lg">
                                        {{$link->title}}
                                    </div>
                                    <small class="text-gray-600 dark:text-gray-400">
                                        Contributed by: {{$link->creator->name}}
                                        {{$link->updated_at->diffForHumans()}}
                                    </small>
                                    <span class="inline-block px-2 py-1 text-white text-sm font-semibold rounded"
                                        style="background-color: {{ $link->channel->color }}">
                                        {{ $link->channel->title }}
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="mt-4">
                            {{$links->links()}}
                        </div>
                    @endif
                </div>

                <!-- Caja para el formulario -->
                <div class="col-span-1 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 h-[450px]">
                    <x-community-add-link :channels="$channels"></x-community-add-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>