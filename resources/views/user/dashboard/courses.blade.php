@extends('admin.layouts.master')

@section('title', 'BrainBoost My Courses')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 primary">My Courses</h1>
        </div>
        <!-- Page heading end -->

        <!-- User Enroled courses list -->
        <div class="row g-4 justify-content-center">
            @if (count($courses) != 0)
                @foreach ($courses as $course)
                    <div class="col-lg-4 col-md-6 wow">
                        <div class="course-item bg-white py-2">
                            <div class="position-relative overflow-hidden">
                                <div class="d-flex justify-content-center">
                                    <img class="img-fluid w-100" style="height: 200px"
                                        src="{{ asset('course/' . $course->image) }}" alt="">
                                </div>
                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                    style="top: 10px; left: 10px;">{{ $course->level }}</div>

                                <div class="w-100 d-flex justify-content-center position-relative mb-4">
                                    <a href="{{ route('courses#detail', $course->id) }}"
                                        class="btn btn-primary btn-sm px-3 border-end rounded-pill">Read More</a>
                                </div>

                            </div>
                            <div class="text-center pb-0">
                                <h3 class="mb-0">{{ $course->price }} mmk</h3>
                                <div class="mb-3">
                                    @for ($i = 1; $i <= $course->average_rating; $i++)
                                        <small class="fa fa-star text-primary"></small>
                                    @endfor
                                    @for ($j = $course->average_rating + 1; $j <= 5; $j++)
                                        <small class="fa fa-star"></small>
                                    @endfor


                                    <small>(123)</small>
                                </div>
                                <h5 class="mb-4">{{ $course->name }}</h5>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"> <i
                                        class="fa fa-user-tie text-primary me-2"></i>{{ $course->instructor_name }}</small>
                                <small class="flex-fill text-center border-end py-2"> <i
                                        class="fa fa-clock text-primary me-2"></i>
                                    {{ $course->duration }} Hrs</small>
                                <small class="flex-fill text-center py-2"> <i class="fa fa-user text-primary me-2"></i>
                                    {{ $course->student_count }}
                                    Students</small>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="m-auto d-flex justify-content-center">
                    <h5 class="text-muted">
                        There is no enrolled course
                    </h5>
                </div>
            @endif
        </div>
        <!-- User Enroled Courses list end -->
    </div>
@endsection
