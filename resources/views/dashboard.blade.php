<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-table :page="$users['page']"
                     :limit="$users['limit']"
                     :total="$users['total']"
                     :has_next_page="$users['has_next_page']"
                     :has_previous_page="$users['has_previous_page']"
                     :next_page="$users['next_page']"
                     :previous_page="$users['previous_page']">

                <x-slot name="header">
                    <x-table-heading>{{ __('Name') }}</x-table-heading>
                    <x-table-heading>{{ __('Email') }}</x-table-heading>
                    <x-table-heading>{{ __('Gender') }}</x-table-heading>

                    @if(auth()->user()->isAdmin())
                        <x-table-heading>{{ __('Status') }}</x-table-heading>
                    @endif

                    <x-table-heading>{{ __('Action') }}</x-table-heading>
                </x-slot>
                @forelse($users['data'] as $user)
                    <x-table-row>
                        <x-table-column>{{ $user['name'] }}</x-table-column>
                        <x-table-column>{{ $user['email'] }}</x-table-column>
                        <x-table-column>{{ str($user['gender'])->ucfirst() }}</x-table-column>

                        @if(auth()->user()->isAdmin())
                            <x-table-column>
                                <x-user-status-badge :status="$user['status']" />
                            </x-table-column>
                        @endif

                        <x-table-column>
                            <a href="{{ route('admin.posts', $user['id']) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Posts') }}
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
