<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


@extends('Shared_Layouts.SharedAdminView')

@section('Title')
    List Settings
@endsection




@section('Content')
    <div class="container mt-4">
        <div class="left-center">
            <a href="{{ route('Admin.AddNewSettings') }}" class="btn btn-secondary">Add New Settings </a>
        </div>
        <table id="myTable" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Site Name</th>
                    <th scope="col">Logo</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Facebook</th>
                    <th scope="col">Twitter</th>
                    <th scope="col">Instagram</th>
                    <th scope="col">About Us</th>
                    <th scope="col">Opening Days</th>
                    <th scope="col">Opening Hours</th>
                    <th scope="col">Created_At</th>
                    <th scope="col">Updated_At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Settings as $Settings)
                    <tr>
                        <th scope="row">{{ $Settings->id }}</th>
                        <td>{{ $Settings->site_name }}</td>
                        <td><img src="{{ asset($Settings->logo) }}" width="100" height="100" alt="Settings Image"></td>
                        <td>{{ $Settings->address }}</td>
                        <td>{{ $Settings->phone }}</td>
                        <td>{{ $Settings->email }}</td>
                        <td>{{ $Settings->facebook }}</td>
                        <td>{{ $Settings->twitter }}</td>
                        <td>{{ $Settings->instagram }}</td>
                        <td>{{ $Settings->about_us }}</td>
                        <td>{{ $Settings->opening_days }}</td>
                        <td>{{ $Settings->opening_hours }}</td>
                        <td>{{ $Settings->created_at }}</td>
                        <td>{{ $Settings->updated_at }}</td>
                        <td>
                            <a href="{{ route('Admin.EditSettings', $Settings->id) }}" class="btn btn-primary">Edit</a>

                            <form style="display: inline" method="POST"
                                action="{{ route('Admin.DeleteSettings', $Settings->id) }}">
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
