<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Contributions') }}
        </h2>
        <x-flash-message></x-flash-message>
    </x-slot>
    <ul class="flex space-x-4">
        <li>
            <a class="px-4 py-2 rounded-lg {{ request()->exists('popular') ? 'text-blue-500 hover:text-blue-700' : 'text-gray-500 cursor-not-allowed' }}"
                href="{{ request()->url() }}">
                Most recent
            </a>
        </li>
        <li>
            <a class="px-4 py-2 rounded-lg {{ request()->exists('popular') ? 'text-gray-500 cursor-not-allowed' : 'text-blue-500 hover:text-blue-700' }}"
                href="?popular">
                Most popular
            </a>
        </li>
    </ul>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <!-- Caja para los links -->
                <x-community-links :links="$links" />

                <!-- Caja para el formulario -->
                <div class="col-span-1 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6 h-[450px]">
                    <x-community-add-link :channels="$channels"></x-community-add-link>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>