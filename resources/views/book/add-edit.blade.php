<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $edit ? __('Edit Book') : __('Add Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-lg-12" style="padding: 20px">
                    @if ($edit)
                    <form
                        action="{{ route('book.update',$book->id)}}"
                        method="POST"
                        enctype="multipart/form-data">
                        @method('PUT') @csrf
                    @else

                    <form
                        action="{{ route('book.create')}}"
                        method="POST"
                        enctype="multipart/form-data">
                        @csrf
                    @endif
                        <div class="col-lg-12">
                            <label for="title">Title</label>
                            <input class="form-control bg-light" type="text" name="title" value="{{ old('title') ?? $book->title ?? null  }}" id="title" placeholder="Book Title" >
                            @error('title')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="">Author</label>
                            <input class="form-control bg-light" type="text" name="author" value="{{ old('author') ?? $book->author ?? null  }}" id="author" placeholder="Author Name" >
                            @error('author')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="">Total Page</label>
                            <input class="form-control bg-light" type="number" name="total_page" value="{{ old('name') ?? $book->total_page ?? null }}" id="total_page" placeholder="Total Pages" >
                            @error('total_page')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <label for="rating">Rating</label><br>
                                <div class="col-sm-2">
                                    <input type="radio" name="rating" value="1" {{ $edit ? ($book->rating == 1 ? 'checked' : '') : '' }}> 1<br>
                                </div>
                                <div class="col-sm-2">
                                    <input type="radio" name="rating" value="2" {{ $edit ? ($book->rating == 2 ? 'checked' : '') : '' }}> 2<br>
                                </div>
                                <div class="col-sm-2">
                                    <input type="radio" name="rating" value="3" {{ $edit ? ($book->rating == 3 ? 'checked' : '') : '' }}> 3<br>
                                </div>
                                <div class="col-sm-2">
                                    <input type="radio" name="rating" value="4" {{ $edit ? ($book->rating == 4 ? 'checked' : '') : '' }}> 4<br>
                                </div>
                                <div class="col-sm-2">
                                    <input type="radio" name="rating" value="5" {{ $edit ? ($book->rating == 5 ? 'checked' : '') : '' }}> 5<br>
                                </div>
                            </div>
                            @error('rating')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="">ISBN</label>
                            <input class="form-control bg-light" type="text" name="isbn" value="{{ old('name') ?? $book->isbn ?? null }}" id="isbn" placeholder="ISBN Number" >
                            <small><span>value must be 10 - 13 Digits</span></small>
                            @error('isbn')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="">Publisher</label>
                            <input class="form-control bg-light" type="text" name="publisher" value="{{ old('name') ?? $book->publisher ?? null }}" id="publisher" placeholder="Publisher Name" >
                            @error('publisher')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="">Published Date</label>
                            <input class="date form-control bg-light" type="date" name="published_date" value="{{ old('name') ?? $book->published_date ?? null }}" id="published_date" placeholder="Published Date" >
                            @error('published_date')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="">Price</label>
                            <input type="text" class="form-control bg-light" type="number" name="price" value="{{ old('name') ?? $book->price ?? null }}" id="price" placeholder="Book Price" >
                            @error('price')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="category">Avaibility</label>
                            <select name="is_available" class="form-control bg-light">
                                <option value="1" {{ $edit ? ($book->is_available == true ? 'selected' : '') : '' }}>Available</option>
                                <option value="0" {{ $edit ? ($book->is_available == false ? 'selected' : '') : '' }}>Sold Out</option>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="category">Category</label>
                                @foreach ($category as $item)
                                <div class="col-sm-12">
                                    <input type="checkbox" value="{{$item->id}}" name="category[]" {{ $edit ? ($item->hasBook->contains($book->id) ? 'checked' : '') : ''}}>
                                    <label for="{{$item->id}}">{{$item->category_name}}</label>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-md-6">
                                <label for="category">Genre</label>
                                @foreach ($genre as $item)
                                <div class="col-sm-12">
                                    <input type="checkbox" value="{{$item->id}}" name="genre[]" {{ $edit ? ($item->hasBook->contains($book->id) ? 'checked' : '') : ''}}>
                                    <label for="{{$item->id}}">{{$item->genre_name}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="daterange">Available Date</label>
                            <input type="text" class="form-control bg-light" name="daterange" value="{{ old('available_from')  ?? ($edit ? date("d/m/Y", strtotime($book->available_from)) : '01/01/2020') ?? '01/01/2020' }}) - {{ old('available_until')  ?? ($edit ? date("d/m/Y", strtotime($book->available_until)) : '01/01/2020') ?? '01/01/2020' }}" />
                            @error('daterange')
                                <small><span style="color: red">{{$message}}</span></small>
                            @enderror
                        </div>
                        <div class="col-lg-12">
                            <label for="description">Description</label>
                            <textarea class="form-control bg-light" name="description" id="description" cols="30" rows="2">{{ old('description') ?? $book->description ?? null }}</textarea>
                        </div>
                        <div class="input_fields_wrap col-lg-12" style="padding: 10px">
                            <div class="row" style="padding: 5px">
                                <div class="col-sm-2">
                                    {{-- <button class="btn btn-primary "><i class="fas fa-plus mr-md-2">></i></button> --}}
                                    <a class="btn btn-primary add_field_button" href="#"><i class="fas fa-plus mr-md-2"></i>Add File</a>
                                </div>
                                <div class="col-sm-4">
                                    <input class="form-control bg-light" type="file" name="myfile[]">
                                </div>
                                <div class="col-sm-6">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-primary btn-sm float-right text-white mr-md-1" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
    <script>
        $('input[name="daterange"]').daterangepicker();
        $('.date').datepicker({
            format: 'yyyy-mm-dd'
        });

        $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row" style="padding: 5px"><div class="col-sm-2"></div><div class="col-sm-4"><input class="form-control bg-light" type="file" name="myfile[]"/></div><a href="#" class="remove_field">Remove</a></div>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });
    </script>
@endpush
</x-app-layout>

