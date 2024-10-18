<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Community Contributions') }}
        </h2>
        <x-flash-message></x-flash-message>
    </x-slot>

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