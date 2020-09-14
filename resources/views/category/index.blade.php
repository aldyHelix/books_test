<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="col-lg-12">
                    <div style="padding: 20px">
                     <a class="btn btn-primary" href="{{route('category.add')}}"><i class="fas fa-plus mr-md-2"></i>Add</a>
                    </div>
                    <table class="table table-bordered mt-5" id="datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category as $no=>$item)
                                <tr>
                                    <td>{{$no+1}}</td>
                                    <td>{{$item->category_name}}</td>
                                    <td>
                                        <a href="{{ route("category.edit" ,$item->id ) }}" class="btn"><i class="fas fa-pen-square mr-md-2"></i></a>
                                        <a href="javascript:;" onclick="deleteData(`{{ route('category.delete',$item->id)}}`)" class="btn"><i class="fas fa-trash mr-md-2"></i></a>
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
