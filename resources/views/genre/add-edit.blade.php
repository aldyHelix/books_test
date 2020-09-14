<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $edit ? __('Edit Genre') : __('Add Genre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div style="margin: 20px">
                    {{$edit ? __('Edit Genre') : __('Add Genre')}}
                        @if ($edit)

                    <form
                        action="{{ route('genre.update',$genre->id)}}"
                        method="POST"
                        enctype="multipart/form-data">
                        @method('PUT') @csrf
                    @else

                    <form
                        action="{{ route('genre.create')}}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                    @endif

                        <label for="name">Genre Name</label>
                        <input
                            type="text"
                            name="genre_name"
                            value="{{ old('name') ?? $genre->genre_name ?? null  }}"
                            class="form-control bg-light @error('genre_name') is-invalid @enderror"
                            id="exampleFormControlInput1"
                            placeholder="Genre Name">
                        @error('genre_name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                        <div style="margin: 10px">
                            <button class="btn btn-primary btn-sm float-right text-white mr-md-1" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
