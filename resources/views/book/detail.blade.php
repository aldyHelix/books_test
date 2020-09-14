<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Book') }} {{$book->title}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="card col-sm-4">
                            Book Title : {{$book->title}} <br>
                            Book Author : {{$book->author}} <br>
                            Book Total Page : {{$book->total_page}} <br>
                            Book Rating : {{$book->rating}} <br>
                            Book ISBN : {{$book->isbn}} <br>
                            Book Publisher : {{$book->publisher}} <br>
                            Book Available : {{$book->is_available ? 'Available' : 'Sold Out'}} <br>
                            Book Avaibility Date : from {{$book->available_from}} until {{$book->available_until}}<br>
                            Book Price : $ {{$book->price}}
                        </div>
                        <div class="card col-sm-4">
                            <div class="card card-header">
                                Genre
                            </div>
                            @foreach ($book->genre as $genre)
                                <small><span class="badge badge-secondary">{{$genre->genre_name}}</span></small>
                            @endforeach
                        </div>
                        <div class="card col-sm-4">
                            <div class="card card-header">
                                Category
                            </div>
                            @foreach ($book->category as $category)
                                <small><span class="badge badge-primary">{{$category->category_name}}</span></small>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

