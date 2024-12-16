@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <a href="{{ route('user#list') }}"> <button class=" btn btn-sm btn-secondary  "> User List</button> </a>
            <div class="">
                <form action="{{ route('admin#list') }}" method="get">
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

                        @if (count($admins) != 0)
                            @foreach ($admins as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->name ?? $admin->nickname }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->address }}</td>
                                    <td>{{ $admin->phone }}</td>
                                    <td><span
                                            class="btn btn-sm bg-danger text-white rounded shadow-sm">{{ $admin->role }}</span>
                                    </td>

                                    <td>{{ $admin->created_at ? $admin->created_at->format('Y-m-d') : '' }}</td>
                                    <td>
                                        @if ($admin->provider == 'google')
                                            <i class="fa-brands fa-google"></i>
                                        @elseif($admin->provider == 'github')
                                            <i class="fa-brands fa-github"></i>
                                        @else
                                            <i class="fa-regular fa-user"></i>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($admin->role == 'admin')
                                            <a href="#" class=""><i
                                                    class="fa-solid text-danger fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="9" class="d-flex justify-content-center text-muted">There is no Admin</td>
                            </tr>
                        @endif

                    </tbody>
                </table>

                <span class=" d-flex justify-content-end"></span>

            </div>
        </div>
    </div>
@endsection
