@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">


        <!-- DataTales Example -->
        <div class="card shadow mb-4 col">
            <div class="card-header py-3">
                <div class="">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-primary">Admin Profile ( <span
                                class="text-danger">{{ Auth::user()->role }} Role</span> )
                        </h6>
                    </div>
                </div>
            </div>
            <form action="{{ route('profile#edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">

                            <img class="img-profile img-thumbnail" id="output"
                                src="
                            {{ asset($userData->profile ? 'profilePhoto/' . $userData->profile : 'defaultProfile/profile.png') }}
                            ">


                            <input type="file" name="image" id="" class="form-control mt-1 "
                                onchange="imageOnChange(event)">

                        </div>
                        <div class="col">

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Name</label>
                                        <input type="text" name="name" class="form-control " placeholder="Name..."
                                            value="{{ $userData->name ?? $userData->nickname }}">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Email</label>
                                        <input type="text" name="email" class="form-control "
                                            value="{{ $userData->email }}" placeholder="Email...">

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Phone</label>
                                        <input type="text" name="phone" class="form-control "
                                            value="{{ $userData->phone }}" placeholder="09xxxxxx">

                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="exampleFormControlInput1" class="form-label">
                                            Address</label>
                                        <input type="text" name="address" class="form-control "
                                            value="{{ $userData->address }}" placeholder="Address">

                                    </div>
                                </div>
                            </div>

                            <input type="submit" value="Update" class="btn btn-primary mt-3">
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
