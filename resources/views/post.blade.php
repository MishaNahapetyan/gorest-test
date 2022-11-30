<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-table>
                <x-slot name="header">
                    <x-table-heading>{{ __('Title') }}</x-table-heading>
                    <x-table-heading>{{ __('Body') }}</x-table-heading>
                    <x-table-heading>{{ __('Action') }}</x-table-heading>
                </x-slot>

                @forelse($posts['data'] as $post)
                    <x-table-row>
                        <x-table-column>{{ $post['title'] }}</x-table-column>
                        <x-table-column>{{ str($post['body'])->limit() }}</x-table-column>
                        <x-table-column>
                            <a href="{{ route('admin.post', $post['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </a>
                        </x-table-column>
                    </x-table-row>
                @empty
                @endforelse
            </x-table>

        </div>
    </div>
</x-app-layout>
