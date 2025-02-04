@extends('user.layouts.master')

@section('title', 'BrainBoost Course Detail')

@section('content')
    <div class="container-fluid bg-body-secondary py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9 ">
                    <a href=""> Course </a> <i class=" mx-1 mb-4 fa-solid fa-greater-than"></i> Details
                    <h1>{{ $course->name }}</h1>
                    <h6>{{ $course->name }}</h6>
                    <div class="row" style="width: 400px">
                        <div class="col">
                            @for ($i = 1; $i <= $rateCount; $i++)
                                <i class="fa-solid fa-star text-success"></i>
                            @endfor
                            @for ($j = $rateCount + 1; $j <= 5; $j++)
                                <i class="fa-regular fa-star"></i>
                            @endfor
                        </div>
                        <div class="col">
                            <p class="text-muted">(1 ratings)</p>
                        </div>
                        <div class="col">
                            <p class="text-muted">3 Students</p>
                        </div>
                    </div>
                    <p class="text-muted">Created By {{ $course->instructor_name }}</p>
                    <div class="d-flex">
                        <p class="text-muted">
                            <i class="fa-solid fa-circle-info"></i>
                            Last updated {{ $course->updated_at->format('Y-m-d') }}
                        </p>
                        <p class="text-muted mx-3">
                            <i class="fa-solid fa-globe"></i> English
                        </p>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="btn btn-outline-primary rounded-3"><i class="fa-solid fa-share"></i>
                            Share</a>
                        <input type="hidden" name="courseId" id="courseId" value="{{ $course->id }}">
                        <input type="hidden" name="userId" id="userId" value="{{ Auth::user()->id }}">
                        <button type="button" id="favourite" class="btn btn-outline-primary mx-3 rounded-3"><i
                                class="fa-regular fa-heart favourite"></i>
                            Favourite</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-8">
                    <div class="container-fluid bg-body-tertiary mt-3">
                        <div class="container py-2">
                            <div class="bg-primary-subtle p-2">
                                <h4>What you'll learn?</h4>
                                <ul class=" d-flex flex-wrap">
                                    @if (count($goals) != 0)
                                        @foreach ($goals as $goal)
                                            <li class="list-group-item border-0"><i class="fa-solid fa-check"></i>
                                                {{ $goal->goal }}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="container mt-5">
                        <h4>Description</h4>
                        <p>{{ $course->description }}</p>
                    </div>

                    <div class="container mt-5">
                        <div class="row">
                            <div class="col-6">
                                <h4>Course content</h4>
                            </div>
                            <div class="col d-flex">
                                <strong>Total: </strong>
                                <p class="text-muted">12 lectures</p>
                            </div>
                            <div class="col d-flex">
                                <strong>Total hours: </strong>
                                <p class="text-muted">{{ $course->duration }}</p>
                            </div>
                        </div>

                        @if (count($sections) != 0)
                            @foreach ($sections as $section)
                                <div class="row bg-body-tertiary">
                                    <div class="col-1"><i class="fa-solid fa-minus"></i></div>
                                    <div class="col">
                                        {!! $course->status == 1
                                            ? '<a href="' .
                                                route('section#detail', ['id' => $course->id]) .
                                                '?link=' .
                                                urlencode($course->video) .
                                                '">' .
                                                $section->title .
                                                '</a>'
                                            : $section->title !!}
                                    </div>


                                    <div class="col-2">3 lectures</div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="container my-5">
                        <h4>About the instructor</h4>
                        <div class="row">
                            <div class="col">
                                <img src="{{ asset($course->profile ? 'profilePhoto/' . $course->profile : 'defaultProfile/profile.png') }}"
                                    class="w-100 img-thumbnail rounded-5" alt="">
                            </div>
                            <div class="col">
                                <p>{{ $course->instructor_name }}</p>
                                <small class="text-muted">Joined {{ $course->created_at->format('Y-m-d') }}</small>
                                <p>{{ $course->email }}</p>
                                <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam
                                    perspiciatis velit molestias nam corrupti, dolore quo non veniam, nemo quia iure sunt
                                    qui. Totam vel ad id modi quae atque?</p>
                            </div>
                        </div>
                    </div>

                    <div class="container my-5">

                        <form action="{{ route('user#review') }}" method="post">
                            @csrf
                            <input type="hidden" name="courseId" value="{{ $course->id }}">

                            <h4 class="mb-5 fw-bold">Leave a Comment</h4>

                            <div class="row g-1">
                                <!-- Comment Section -->
                                <div class="col-lg-12">
                                    <div class="border-bottom rounded">
                                        <textarea name="comment" class="form-control border-0 shadow-sm" cols="30" rows="4"
                                            placeholder="Your Review *" spellcheck="false" required>{{ old('comment') }}</textarea>
                                    </div>
                                </div>

                                <!-- Rating Section -->
                                <div class="col-lg-12 mt-3">
                                    <h5>Rate this product:</h5>
                                    <div class="rating-css">
                                        <div class="star-icon">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" value="{{ $i }}" name="rating"
                                                    id="rating{{ $i }}"
                                                    @if ($i === 1) checked @endif>
                                                <label for="rating{{ $i }}" class="fa fa-star"></label>
                                            @endfor
                                        </div>
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="col-lg-12 mt-4">
                                    <button type="submit"
                                        class="btn border border-secondary rounded-pill px-4 py-3 text-primary">
                                        Post Comment & Rate
                                    </button>
                                </div>
                            </div>
                        </form>


                        <h4 class="mt-5 mb-4">Student Review</h4>
                        <div class="tab-pane" role="tabpanel" aria-labelledby="nav-mission-tab">

                            @if (count($reviews) != 0)
                                @foreach ($reviews as $review)
                                    <div class="d-flex">
                                        <img src="{{ asset($review->profile ? 'profilePhoto/' . $review->profile : 'defaultProfile/profile.png') }}"
                                            class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;">
                                        <div class="">
                                            <p class="" style="font-size: 14px;">
                                                {{ $review->created_at->format('Y-m-d') }}
                                            </p>
                                            <div class="d-flex justify-content-between">
                                                <h5>{{ $review->name }}</h5>

                                            </div>
                                            <p>{{ $review->commment }}</p>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            @endif

                            <div>
                                <span>{{ $reviews->links() }}</span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col">
                    <div class="bg-white rounded-1">
                        <div class="m-auto w-75">
                            <img src="{{ asset('course/' . $course->image) }}" class="img-thumbnail h-75"
                                alt="">
                        </div>

                        <div class="my-4">
                            <h2>{{ $course->price }} mmk</h2>
                            <a href="{{ route('course#join', $course->id) }}" class="btn btn-primary rounded-1 w-100">
                                Add to cart
                            </a>
                        </div>

                        <div class="my-4">
                            <h5>This course includes</h5>
                            <ul class="p-0">
                                <li class="list-group-item border-0">
                                    <i class="fa-solid fa-play"></i>
                                    <small class="text-muted ms-2">{{ $course->duration }} hours on-demand video</small>
                                </li>
                                <li class="list-group-item border-0">
                                    <i class="fa-solid fa-wrench"></i>
                                    <small class="text-muted ms-2">Full lifetime access</small>
                                </li>
                                <li class="list-group-item border-0">
                                    <i class="fa-solid fa-tv"></i>
                                    <small class="text-muted ms-2">Access on mobile and TV</small>
                                </li>
                                <li class="list-group-item border-0">
                                    <i class="fa-solid fa-certificate"></i>
                                    <small class="text-muted ms-2">Full lifetime access</small>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="bg-white my-3 rounded-1">
                        <div class="card border-0">
                            <div class="card-header border-0 border-bottom">
                                <h5>Course Features</h5>
                            </div>
                            <div class="card-body border-0 p-1">
                                <div class="d-flex p-3 justify-content-between">
                                    <p class="text-muted">
                                        <i class="fa-regular fa-clock me-2"></i>
                                        Duration
                                    </p>
                                    <p class="text-muted">{{ $course->duration }} hours</p>
                                </div>
                                <div class="d-flex p-3 justify-content-between">
                                    <p class="text-muted">
                                        <i class="fa-solid fa-globe"></i>
                                        Language
                                    </p>
                                    <p class="text-muted">English</p>
                                </div>
                                <div class="d-flex p-3 justify-content-between">
                                    <p class="text-muted">
                                        <i class="fa-regular fa-lightbulb"></i>
                                        Skill level
                                    </p>
                                    <p class="text-muted">{{ $course->level }}</p>
                                </div>
                                <div class="d-flex p-3 justify-content-between">
                                    <p class="text-muted">
                                        <i class="fa-solid fa-user-group"></i>
                                        Students
                                    </p>
                                    <p class="text-muted">30,567</p>
                                </div>
                                <div class="d-flex p-3 justify-content-between">
                                    <p class="text-muted">
                                        <i class="fa-solid fa-certificate"></i>
                                        Certificate
                                    </p>
                                    <p class="text-muted">{{ $course->certificate == 1 ? 'Yes' : 'No' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('js-script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '#favourite', function(event) {
                console.log('clicked');
                const parentNode = $(this).closest('.d-flex');
                const userId = parentNode.find('#userId').val();
                const courseId = parentNode.find('#courseId').val();

                console.log(userId, courseId);

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        userId: userId,
                        courseId: courseId
                    },
                    url: '/user/course/bookmark',
                    success: function(res) {
                        if (res.status === 'success') {
                            $('#favourite i.favourite')
                                .removeClass('fa-regular fa-heart')
                                .addClass('fa-solid fa-heart text-success');
                        } else if (res.status === 'exists') {
                            alert(res.message); // Bookmark already exists
                        }
                    },
                    error: function(error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
