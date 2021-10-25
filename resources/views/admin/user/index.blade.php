<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User') }}
        </h2>
    </x-slot>
    <x-slot name="slot">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div id="app">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    <h4 class="text-center">{{ session('success') }}</h4>
                                </div>
                            @endif
                            <base-title title="All User"></base-title>

                            <base-button :route="`{{ route('users.create') }}`" btn-name="Add new User"
                                btn-class="btn btn-success float-right px-3 mb-2">
                            </base-button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th class="text-center" scope="col">Email</th>
                                        <th class="text-center" scope="col">Role</th>
                                        <th class="text-center" scope="col">Count Post</th>
                                        <th class="text-center" scope="col">Created At</th>
                                        <th class="text-center" scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <th scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">
                                                @if ($user->is_admin == 0)
                                                    <p class="text-success">User</p>
                                                @else
                                                    <p class="text-primary">Admin</a>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $user->posts_count }}</td>
                                            <td class="text-center">{{ $user->date_create }}</td>
                                            <td class="text-center">
                                                <base-button btn-name="Edit" btn-class="btn btn-dark w-75 mb-2"
                                                    :route="`{{ route('users.edit', $user->id) }}`">
                                                </base-button>
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <base-button btn-type="submit" btn-class="btn btn-danger w-75 mb-2"
                                                        btn-name="Delete">
                                                    </base-button>
                                                </form>
                                                {{-- <base-button btn-name="Active" btn-class="btn btn-warning w-75"
                                                    :route="`{{ route('users.active', $user->id) }}`">
                                                </base-button> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <h4 class="text-center">Opps!There is no user in DB!</h4>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
