@extends('admin.layouts.master')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Payment List</h1>
        </div>

        <div class="">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body shadow">
                            <form action="{{ route('payment#create') }}" method="post" class="p-3 rounded">
                                @csrf
                                <label for="paymentName" class="mt-3">Payment Name</label>
                                <input type="text" name="paymentName" value="{{ old('paymentName') }}"
                                    class=" form-control @error('paymentName')
                                        is-invalid
                                    @enderror "
                                    placeholder="Payment Name...">
                                @error('paymentName')
                                    <small class="text-danger">{{ $message }}</small><br>
                                @enderror

                                <label for="accountNumber" class="mt-3">Account Number</label>
                                <input type="text" name="accountNumber" value="{{ old('accountNumber') }}"
                                    class=" form-control @error('accountNumber')
                                        is-invalid
                                    @enderror "
                                    placeholder="Account Number...">
                                @error('accountNumber')
                                    <small class="text-danger">{{ $message }}</small><br>
                                @enderror

                                <label for="type" class="mt-3">Payment Type</label>
                                <input type="text" name="type" value="{{ old('type') }}"
                                    class=" form-control @error('type')
                                        is-invalid
                                    @enderror "
                                    placeholder="Payment Type...">
                                @error('type')
                                    <small class="text-danger">{{ $message }}</small><br>
                                @enderror

                                <input type="submit" value="Create" class="btn btn-outline-primary mt-3">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col ">
                    <table class="table table-hover shadow-sm ">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Created Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($payments) != 0)
                                @foreach ($payments as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->created_at->format('j-F-Y') }}</td>
                                        <td>
                                            <a href="{{ route('payment#edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-secondary">
                                                Edit </a>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="confirmDelete({{ $item->id }})">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>There is no data</td>
                                </tr>
                            @endif

                        </tbody>
                    </table>

                    <span class=" d-flex justify-content-end"></span>

                </div>

            </div>
        </div>

    </div>
@endsection

@section('js-script')
    <script>
        function confirmDelete($id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: "Deleted!",
                        text: "Your file has been deleted.",
                        icon: "success"
                    });

                    setInterval(() => {
                        location.href = 'payment/delete' + $id;
                    }, 1000);
                }
            });
        }
    </script>
