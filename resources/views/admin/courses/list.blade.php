@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <button class=" btn btn-secondary rounded shadow-sm"> <i class="fa-solid fa-database"></i>
                    Course Count ({{ count($courses) }} ) </button>
                <a href="" class=" btn btn-outline-primary  rounded shadow-sm">All Courses</a>
            </div>
            <div class="">
                <form action="{{ route('course#list') }}" method="get">
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
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Image</th>
                            <th>Course Name</th>
                            <th>Sub-Category</th>
                            <th>Price</th>
                            <th>Instructor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($courses) != 0)
                            @foreach ($courses as $course)
                                <tr>
                                    <td> <img src="{{ asset('course/' . $course->image) }}"
                                            class=" img-thumbnail rounded shadow-sm" style="width:100px" alt="">
                                    </td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->sub_category_name }}</td>
                                    <td>{{ $course->price }} mmk</td>
                                    <td>
                                        {{ $course->instructor_name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('course#seemore', $course->id) }}"
                                            class="btn btn-sm btn-outline-primary"> <i class="fa-solid fa-eye"></i> </a>
                                        <a href="{{ route('course#edit', $course->id) }}"
                                            class="btn btn-sm btn-outline-secondary"> <i
                                                class="fa-solid fa-pen-to-square"></i> </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDelete({{ $course->id }})"> <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h5 class="text-muted text-center">There is no courses</h5>
                                </td>
                            </tr>
                        @endif




                    </tbody>
                </table>



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
                        text: "Your Course file has been deleted.",
                        icon: "success"
                    });

                    setInterval(() => {
                        location.href = '/admin/course/delete/' + $id;
                    }, 500);
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Your Course file is safe :)",
                        icon: "error"
                    });
                }
            });
        }
    </script>
@endsection
