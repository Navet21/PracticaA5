<div class="md:col-span-1 bg-gray-800 p-6 rounded-lg shadow-md border border-gray-600 self-start">
    <h3 class="text-xl font-semibold mb-4 text-white">Contribute a link</h3>
    <form method="POST" action="/dashboard">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-white font-medium">Title:</label>
            <input type="text" id="title" name="title"
                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('title') is-invalid @enderror"
                placeholder="What is the title of your article?" value="{{old('title')}}">
            @error('title')
                <div class="bg-red-500 text-white mt-1 p-2 rounded">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="link" class="block text-white font-medium">Link:</label>
            <input type="text" id="link" name="link"
                class="mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                placeholder="What is the URL?" value="{{old('link')}}">
            @error('link')
                <div class="bg-red-500 text-white mt-1 p-2 rounded">{{ $message }}</div>
            @enderror
            <div class="mb-4">
                <label for="Channel" class="block text-white font-medium">Channel:</label>
                <select
                    class="@error('channel_id') is-invalid @enderror mt-1 block w-full rounded-md border-gray-600 bg-gray-700 text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                    name="channel_id">
                    <option selected disabled>Pick a Channel...</option>
                    @foreach ($channels as $channel)
                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                            {{ $channel->title }}
                        </option>
                    @endforeach
                </select>
                @error('channel_id')
                    <span class="text-red-500 mt-2">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="pt-3">
            <button type="submit"
                class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Contribute!</button>
        </div>
    </form>
</div>

{{--

1.¿Qué hace la directiva @crsf?

La directiva @csrf en Laravel se utiliza para proteger las aplicaciones contra ataques de tipo Cross-Site Request
Forgery (CSRF), que son un tipo de ataque en el que un atacante hace que un usuario autenticado realice una acción no
deseada en una aplicación web.

¿Qué método se llamará en el controlador CommunityController al enviar el formulario?

Se llamara al metodo store() para guardar la informacion en la base de datos

Intenta enviar un enlace. ¿Qué ocurrse y cómo puedes resolver el problema?

Pues da error porque la vista que esta configurada es con el metodo get y nos da el dashboard con el index de comunnity
links, hay que hacer una vista con el metodo get y el metodo store()



--}}