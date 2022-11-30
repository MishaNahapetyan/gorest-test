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
                            <a href="{{ route('admin.comments', $post['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Comments') }}
                            </a>
                        </x-table-column>
                    </x-table-row>
                @empty
                    <x-table-row>
                        <x-table-column :colspan="3" class="text-center">{{ __('Empty') }}</x-table-column>
                    </x-table-row>
                @endforelse
            </x-table>

        </div>
    </div>
</x-app-layout>
