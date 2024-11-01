@props(['links'])

<div class="col-span-2 bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
    @if($links->isEmpty())
        <p>No se encontraron links</p>

    @else
        <ul>
            @foreach ($links as $link)
                <li class="mb-4 p-4 border border-gray-300 dark:border-gray-700 rounded-lg">
                    <form method="POST" action="/votes/{{ $link->id }}">
                        @csrf

                        <button type="submit"
                            class="px-4 py-2 text-white rounded hover:bg-gray-600 disabled:opacity-50 {{ Auth::check() && Auth::user()->votedFor($link) ? 'bg-green-500 hover:bg-green-600' : 'bg-gray-500 hover:bg-gray-600' }}"
                            {{ !Auth::user()->isTrusted() ? 'disabled' : '' }}>
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 inline-block mr-1 {{ Auth::check() && Auth::user()->votedFor($link) ? 'fill-current text-red-500' : 'fill-current text-white' }}"
                                viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                            </svg>
                            {{ $link->users()->count() }}
                        </button>
                    </form>

                    <div class="font-semibold text-lg">
                        {{$link->title}}
                    </div>
                    <small class="text-gray-600 dark:text-gray-400">
                        Contributed by: {{$link->creator->name}}
                        {{$link->updated_at->diffForHumans()}}
                    </small>
                    <a href="/dashboard/{{ $link->channel->slug}}">
                        <span class="inline-block px-2 py-1 text-white text-sm font-semibold rounded"
                            style="background-color: {{ $link->channel->color }}">
                            {{ $link->channel->title }}
                        </span>
                    </a>
                    <div class="flex items-center space-x-2">
                        <span class="text-gray-700 font-semibold">Votos:</span>
                        <span class="bg-blue-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                            {{$link->users()->count()}}
                        </span>
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4">
            {{$links->links()}}
        </div>
    @endif
</div>