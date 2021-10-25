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
                            <base-title title=" Add a new
                            User">
                            </base-title>
                            <form action="{{ route('users.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class=" d-flex justify-content-center w-100">
                                    <div class="w-50">
                                        <base-input label="Name" name="name" type="text"></base-input>
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <base-input label="Email" name="email" type="email"></base-input>
                                        @error('email')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <base-input label="Password" name="password" type="password"></base-input>
                                        @error('password')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                        <base-button btn-name="Create" btn-class="btn btn-success" btn-type="submit">
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
