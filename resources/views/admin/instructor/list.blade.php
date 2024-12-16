@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <form action="{{ route('instructor#list') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="searchKey" value="" class=" form-control"
                            placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover shadow-sm ">
                    <thead class="bg-success text-white">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th>Platform</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($instructors) != 0)
                            @foreach ($instructors as $instructor)
                                <tr>
                                    <td>{{ $instructor->id }}</td>
                                    <td>{{ $instructor->name ?? $instructor->nickname }}</td>
                                    <td>{{ $instructor->email }}</td>
                                    <td>{{ $instructor->address }}</td>
                                    <td>{{ $instructor->phone }}</td>
                                    <td><span
                                            class="btn btn-sm bg-danger text-white rounded shadow-sm">{{ $instructor->role }}</span>
                                    </td>

                                    <td>{{ $instructor->created_at ? $instructor->created_at->format('Y-m-d') : '' }}</td>
                                    <td>
                                        @if ($instructor->provider == 'google')
                                            <i class="fa-brands fa-google"></i>
                                        @elseif($instructor->provider == 'github')
                                            <i class="fa-brands fa-github"></i>
                                        @else
                                            <i class="fa-regular fa-user"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($instructor->role == 'instructor')
                                            <button type="button" class="btn deleteBtn"
                                                onclick="confirmDelete({{ $instructor->id }})">
                                                <i class="fa-solid text-danger fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="d-flex justify-content-center text-muted">There is no Instructor
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <span class=" d-flex justify-content-end"></span>

            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        function confirmDelete($id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    setInterval(() => {
                        location.href = 'admin/account/delete/' + $id;
                    }, 1000);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your Instructor Profile is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endsection
