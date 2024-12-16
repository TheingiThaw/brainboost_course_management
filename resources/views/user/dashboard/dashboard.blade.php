@extends('admin.layouts.master')

@section('title', 'BrainBoost User Dashboard')

@section('content')
    <div class="container-fluid my-5">
        <div class="w-50 row d-flex">
            <div class="row col-8">
                <div class="col-5">
                    <img src="{{ asset(Auth::user()->profile ? 'profilePhoto/' . Auth::user()->profile : 'defaultProfile/profile.png') }}"
                        class="rounded-5 img-profile" style="width: 130px; height: 130px" alt="">
                </div>
                <div class="col-7 d-flex flex-column justify-content-center">
                    <h5>Hello, student</h5>
                    <h5>{{ Auth::user()->name ?? Auth::user()->username }}</h5>
                </div>
            </div>
            <div class="row col-4 d-flex flex-column justify-content-center">
                <a href="{{ route('user#profile') }}" class="btn btn-success"><i
                        class="fa-solid fa-arrow-right-to-bracket"></i> Profile</a>
            </div>
        </div>
    </div>

    <hr>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 primary">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Total Enrolled Courses -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success-emphasis text-uppercase mb-1">
                                    Enrolled Courses</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $courseCount }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa-solid fa-chalkboard-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Active Course -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <a href="">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Active Course</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $courseCount }}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fa-solid fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Completed Course -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Completed Course
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $courseCount }}</div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Row -->
        </div>
    </div>
@endsection
