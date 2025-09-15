<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>


@extends('Shared_Layouts.SharedAdminView')

@section('Title')
    List Booking
@endsection




@section('Content')
    <div class="container mt-4">
        <table id="myTable" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">User Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">User Email</th>
                    <th scope="col">Number of People</th>
                    <th scope="col">Booking Date</th>
                    <th scope="col">Booking Time</th>
                    <th scope="col">Created_At</th>
                    <th scope="col">Updated_At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($Book as $Book)
                    <tr>
                        <th scope="row">{{ $Book->id }}</th>
                        <td>{{ $Book->name }}</td>
                        <td>{{ $Book->phoneNumber }}</td>
                        <td>{{ $Book->email }}</td>
                        <td>{{ $Book->NumberOfPerson }}</td>
                        <td>{{ $Book->date }}</td>
                        <td>{{ $Book->booking_time }}</td>
                        <td>{{ $Book->created_at }}</td>
                        <td>{{ $Book->updated_at }}</td>
                        <td>
                            <form style="display: inline" method="POST"
                                action="{{ route('Admin.DeleteBooking', $Book->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-xs btn-danger btn-flat show-alert-delete-box btn-sm"
                                    data-toggle="tooltip" title='Delete'>Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>

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
