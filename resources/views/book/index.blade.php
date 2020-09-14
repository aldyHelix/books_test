<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-lg-12">
                    <div class="col-lg-12" style="padding: 10px">
                        <a class="btn btn-primary" href="{{route('book.add')}}"><i class="fas fa-plus mr-md-2"></i>Add</a>
                    </div>
                    <table class="table table-bordered mt-5" id="datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>ISBN</th>
                                <th>Book Title</th>
                                <th>Author</th>
                                <th>Price</th>
                                <th>Genre</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($book as $no=>$item)
                                <tr>
                                    <td>{{$no+1}}</td>
                                    <td>{{$item->isbn}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->author}}</td>
                                    <td>$ {{$item->price}}</td>
                                    <td>
                                        @if (count($item->genre) != 0)
                                            @foreach ($item->genre as $genre)
                                                <small><span class="badge badge-secondary">{{$genre->genre_name}}</span></small>
                                            @endforeach
                                        @else
                                            No genre added
                                        @endif
                                    </td>
                                    <td>
                                        @if (count($item->category) != 0)
                                        @foreach ($item->category as $category)
                                            <small><span class="badge badge-primary">{{$category->category_name}}</span></small>
                                        @endforeach
                                        @else
                                            No category added
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route("book.detail", $item->id) }}" class="btn"><i class="fas fa-ellipsis-v mr-md-2"></i></a>
                                        <a href="{{ route("book.edit", $item->id) }}" class="btn"><i class="fas fa-pen-square mr-md-2"></i></a>
                                        <a href="javascript:;" onclick="deleteData(`{{ route('book.delete',$item->id)}}`)" class="btn"><i class="fas fa-trash mr-md-2"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
               $("#datatable").DataTable({
                    dom: 'Bfrtip',
                    buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
               });
            });
        </script>
    @endpush
</x-app-layout>


