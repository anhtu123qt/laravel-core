<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div id="app">
                            <div class="container">
                                <base-title title="Hello {{ auth()->user()->name }} !"></base-title>
                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="text-center">List Admin</h3>
                                        <ul>
                                            @forelse ($admins as $admin )
                                                <li class="text-center">{{ $admin->name }} / {{ $admin->email }}
                                                </li>
                                            @empty
                                                <h5 class="text-center py-5">There are no admins here!</h5>
                                            @endforelse
                                        </ul>
                                    </div>
                                    <div class="col-6">
                                        <h3 class="text-center">Popular User</h3>
                                        <ul>
                                            @forelse ($users as $user )
                                                <li class="text-center">
                                                    {{ $user->name }} ----
                                                    Post( {{ $user->posts_count }} ) ----
                                                    Newest Post(
                                                    @if (isset($user->newestpost))
                                                        {{ $user->newestpost->title }}
                                                    @endif
                                                    )
                                                </li>
                                            @empty
                                                <h5 class="text-center py-5">There are no user here!</h5>
                                            @endforelse
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
