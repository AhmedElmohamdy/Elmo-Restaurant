<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


@extends('Shared_Layouts.SharedAdminView')

@section('Title')
    List Products
@endsection




@section('Content')
    <div class="container mt-4">
        <div class="left-center">
            <a href="{{ route('Admin.AddNewProduct') }}" class="btn btn-secondary">Add New Product </a>
        </div>
        <table id="myTable" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image Name</th>
                    <th scope="col">Created_At</th>
                    <th scope="col">Updated_At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Product as $Products)
                    <tr>
                        <th scope="row">{{ $Products->id }}</th>
                        <td>{{ $Products->product_name }}</td>
                        <td>{{ $Products->category->category_name }}</td>
                        <td>{{ $Products->price }}</td>
                        <td>{{ $Products->description }}</td>
                        <td><img src="{{ asset($Products->image_name) }}" width="100" height="100" alt="Product Image"></td>
                        <td>{{ $Products->created_at }}</td>
                        <td>{{ $Products->updated_at }}</td>
                        <td>
                            <a href="{{ route('Admin.EditProduct', $Products->id) }}" class="btn btn-primary">Edit</a>

                            <form style="display: inline" method="POST"
                                action="{{ route('Admin.DeleteProduct', $Products->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                    data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

                <script type="text/javascript">
                    $(document).ready(function() {
                        $(document).on('click', '.show-alert-delete-box', function(event) {
                            var form = $(this).closest("form");

                            event.preventDefault();
                            swal({
                                title: "Are you sure you want to delete this record?",
                                text: "If you delete this, it will be gone forever.",
                                icon: "warning",
                                type: "warning",
                                buttons: ["Cancel", "Yes!"],
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((willDelete) => {
                                if (willDelete) {
                                    form.submit();
                                }
                            });
                        });
                    });
                </script>
            </tbody>
        </table>
    </div>
@endsection

<script>
    $(document).ready(function() {
        let table = new DataTable('#myTable');
    });
</script>
