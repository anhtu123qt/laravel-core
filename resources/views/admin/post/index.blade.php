<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post') }}
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
                            <base-title title="All Post"></base-title>
                            <base-button :route="`{{ route('posts.create') }}`" btn-name="Add new Post"
                                btn-class="btn btn-success float-right px-3 mb-2">
                            </base-button>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Title</th>
                                        <th class="text-center" scope="col">Status</th>
                                        <th class="text-center" scope="col">Publicted at</th>
                                        <th class="text-center" scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($posts as $post)
                                        <tr>
                                            <th scope="row">{{ $post->id }}</th>
                                            <td>{{ $post->title }}</td>
                                            <td class="text-center">
                                                @if ($post->is_active == 0)
                                                    <a class="text-danger">Inactive</a>
                                                @else
                                                    <a class="text-success">Active</a>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $post->publicted_at }}</td>
                                            <td class="text-center">
                                                <base-button btn-name="Edit" btn-class="btn btn-dark w-75 mb-2"
                                                    :route="`{{ route('posts.edit', $post->id) }}`">
                                                </base-button>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <base-button btn-type="submit" btn-class="btn btn-danger w-75 mb-2"
                                                        btn-name="Delete">
                                                    </base-button>
                                                </form>
                                                <base-button btn-name="Active" btn-class="btn btn-warning w-75"
                                                    :route="`{{ route('posts.active', $post->id) }}`">
                                                </base-button>
                                            </td>
                                        </tr>
                                    @empty
                                        <h4 class="text-center">Opps!There is no post in DB!</h4>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
