<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

@extends('Shared_Layouts.SharedAdminView')

@section('Title')
    List Booking
@endsection

@section('Content')
    <div class="container mt-4">
        <table id="myTable" class="display table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>User Name</th>
                    <th>Phone Number</th>
                    <th>User Email</th>
                    <th>Number of People</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Book as $item)
                    <tr id="row-{{ $item->id }}">
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phoneNumber }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->NumberOfPerson }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item->booking_time }}</td>
                        <td id="status-{{ $item->id }}">
                            @if ($item->status === 'accepted')
                                <span class="badge bg-success">Accepted</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            {{-- Delete --}}
                            <button class="btn btn-danger btn-sm show-alert-delete-box"
                                data-id="{{ $item->id }}"
                                data-action="{{ route('Admin.DeleteBooking', $item->id) }}">
                                🗑 Delete
                            </button>

                            {{-- Accept --}}
                            @if ($item->status !== 'accepted')
                                <button class="btn btn-success btn-sm accept-booking"
                                    data-booking-id="{{ $item->id }}"
                                    data-booking-name="{{ $item->name }}">
                                    ✅ Accept
                                </button>
                            @else
                                <button class="btn btn-success btn-sm" disabled>
                                    ✅ Accepted
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#myTable').DataTable();

            // Delete
            $(document).on('click', '.show-alert-delete-box', function () {
                let action = $(this).data('action');
                swal({
                    title: "Are you sure?",
                    text: "If you delete this, it will be gone forever.",
                    icon: "warning",
                    buttons: ["Cancel", "Yes, delete it!"],
                }).then((willDelete) => {
                    if (!willDelete) return;

                    $.ajax({
                        url: action,
                        type: 'POST',
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'DELETE'
                        },
                        success: function () {
                            swal({
                                title: "Deleted!",
                                text: "Booking has been deleted.",
                                icon: "success",
                                timer: 2000,
                                buttons: false
                            }).then(() => location.reload());
                        },
                        error: function () {
                            swal("Error!", "Something went wrong.", "error");
                        }
                    });
                });
            });

            // Accept
            $(document).on('click', '.accept-booking', function () {
                let bookingId   = $(this).data('booking-id');
                let bookingName = $(this).data('booking-name');
                let button      = $(this);

                swal({
                    title: `Accept booking for ${bookingName}?`,
                    text: "A confirmation email will be sent to the customer.",
                    icon: "warning",
                    buttons: ["Cancel", "Yes, Accept!"],
                }).then((willAccept) => {
                    if (!willAccept) return;

                    $.ajax({
                        url: `/Admin/Bookings/Accept/${bookingId}`,
                        type: 'POST',
                        data: { _token: "{{ csrf_token() }}" },
                        success: function (response) {
                            if (response.success) {
                                $(`#status-${bookingId}`).html(
                                    '<span class="badge bg-success">Accepted</span>'
                                );
                                button.replaceWith(
                                    '<button class="btn btn-success btn-sm" disabled>✅ Accepted</button>'
                                );
                                swal({
                                    title: "Accepted!",
                                    text: response.message,
                                    icon: "success",
                                    timer: 3000,
                                    buttons: false
                                });
                            } else {
                                swal("Notice", response.message, "info");
                            }
                        },
                        error: function () {
                            swal("Error!", "Something went wrong. Please try again.", "error");
                        }
                    });
                });
            });

        });
    </script>
@endsection
