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
                            <base-title title=" Edit a Post">
                            </base-title>
                            <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class=" d-flex justify-content-center w-100">
                                    <div class="w-50">
                                        <base-input value="{{ $post->title }}" label="Title" name="title" type="text">
                                        </base-input>
                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <base-text-area value="{{ $post->body }}" label="Content" name="body" cols="5"
                                            rows="10"></base-text-area>
                                        @error('body')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <base-upload-image name="image" label="Upload Image"></base-upload-image>
                                        @error('image')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <base-button btn-name="Update" btn-class="btn btn-success" btn-type="submit">
                                        </base-button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>
    <script src="{{ asset('js/app.js') }}"></script>
</x-app-layout>
