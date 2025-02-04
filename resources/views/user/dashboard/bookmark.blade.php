@extends('admin.layouts.master')

@section('content')
    <!-- favourite list -->
    <div class="row g-4 justify-content-center">
        @if (count($bookmarks) != 0)
            @foreach ($bookmarks as $course)
                <div class="col-lg-4 col-md-6 wow">
                    <div class="course-item position-relative bg-white py-2">
                        <div class="position-relative ">
                            <div class="d-flex justify-content-center h-100">
                                <img class="img-fluid w-100" src="{{ asset('course/' . $course->image) }}" alt="">
                            </div>
                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute"
                                style="top: 10px; left: 10px;">{{ $course->level }}</div>
                            <div class="w-100 d-flex justify-content-center position-absolute bottom-0 start-0 mt-4">
                                <a href="{{ route('courses#detail', $course->id) }}" class=" btn btn-sm btn-primary">Read
                                    More</a>
                            </div>
                        </div>
                        <div class="text-center mt-5 p-4 pb-0">
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
                <h5 class="text-muted">There is no bookmark</h5>
            </div>
        @endif


    </div>
    <!-- favourite list end -->
@endsection
