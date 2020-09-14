<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $edit ? __('Edit Category') : __('Add Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-lg-12">
                    {{$edit ? __('Edit Category') : __('Add Category')}}
                 @if ($edit)

                <form
                    action="{{ route('category.update',$category->id)}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @method('PUT') @csrf
                @else

                <form
                    action="{{ route('category.create')}}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                @endif

                    <label for="name">Category Name</label>
                    <input
                        type="text"
                        name="category_name"
                        value="{{ old('name') ?? $category->category_name ?? null  }}"
                        class="form-control bg-light @error('category_name') is-invalid @enderror"
                        id="exampleFormControlInput1"
                        placeholder="Category Name">
                    @error('category_name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror

                    <button class="btn btn-primary btn-sm float-right text-white mr-md-1" type="submit">Save</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
