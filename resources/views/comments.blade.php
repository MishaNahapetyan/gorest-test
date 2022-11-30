<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comments') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(isset($comments['data']) && count($comments['data']))
                <div class="grid mb-8 border border-gray-200 rounded-lg shadow-sm dark:border-gray-700 md:mb-12 md:grid-cols-2">

                    @foreach($comments['data'] as $comment)
                        <figure class="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-gray-200 rounded-t-lg md:rounded-t-none md:rounded-tl-lg md:border-r dark:bg-gray-800 dark:border-gray-700">
                            <figcaption class="flex items-center justify-center space-x-3">
                                <div class="space-y-0.5 font-medium dark:text-white">
                                    <div>{{ $comment['name'] }}</div>
                                    <div class="text-sm font-light text-gray-500 dark:text-gray-400">{{ $comment['email'] }}</div>
                                </div>
                            </figcaption>
                            <blockquote class="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                                <p class="my-4 font-light">{{ $comment['body'] }}</p>
                            </blockquote>
                        </figure>
                    @endforeach

                </div>
            @endif

        </div>
    </div>
</x-app-layout>
