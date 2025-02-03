@extends('user.layouts.master')

@section('title', 'BrainBoost Course Section')

@section('content')
    <!-- Navbar start -->
    {{-- <div class="container-fluid bg-dark d-flex align-items-center fixed-top px-0" style="height: 50px;">
        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="d-flex align-items-center ">
                    <h5 class="text-white">{{ $course->name }}</h5>
                </div>
                <div class="d-flex">
                    <div class="ms-3 d-flex align-items-center">
                        <i class="fa-solid fa-moon text-light"></i>
                    </div>
                    <div class="ms-3">
                        <form action="" method="">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                class="btn btn-outline-light"><i class="fa-solid fa-star me-2"></i> Rating</button>
                        </form>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title text-white fs-5" id="exampleModalLabel">Rate this product
                                        </h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">

                                        <div class="modal-body">

                                            <input type="hidden" name="productId" value="">

                                            <div class="rating-css">
                                                <div class="star-icon">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Rating</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="ms-3">
                        <button type="button" class="btn btn-outline-light">
                            <i class="fa-solid fa-share"></i> share
                        </button>
                    </div>
                    <div class="ms-3">
                        <button type="button" class="btn btn-outline-light">
                            <i class="fa-solid fa-info"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Navbar End -->

    <div class="container-fluid pb-5 mt-5">
        <div class="container py-2">
            <div class="row">
                <div class="col-lg-10 col-md-8 col-sm-10">
                    <iframe width="1050" height="515" id="videoURL" src={{ $link }} title="YouTube video player"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

                </div>
                <div class="col-lg-1 offset-1 col-md-4 col-sm-2">
                    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa-solid fa-bars"></i>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                        aria-labelledby="offcanvasRightLabel">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="offcanvasRightLabel">Course Content</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            .<div class="accordion" id="accordionPanelsStayOpenExample">
                                @if (count($sections) != 0)
                                    @foreach ($sections as $index => $section)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#panelsStayOpen-collapse{{ $index + 1 }}"
                                                    aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                                    Section {{ $index + 1 }}: {{ $section->title }}
                                                </button>
                                            </h2>
                                            <div id="panelsStayOpen-collapse{{ $index + 1 }}"
                                                class="accordion-collapse collapse show">
                                                <div class="accordion-body">
                                                    <ul>
                                                        @foreach ($section->lectures as $lecture)
                                                            <li><button type="button" class="border-0 btn lecture-link"
                                                                    data-video-url="{{ $lecture->video }}">
                                                                    {{ $lecture->name }}
                                                                </button></li>
                                                        @endforeach

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <nav>
                    <div class="nav nav-tabs mb-3">
                        <button class="nav-link active border-white border-bottom-0" type="button" role="tab"
                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about"
                            aria-selected="true">Description</button>
                        <button class="nav-link border-white border-bottom-0" type="button" role="tab"
                            id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission"
                            aria-controls="nav-mission" aria-selected="false"> Answer & Question <span
                                class=" btn btn-sm btn-success rounted shadow-sm">{{ count($questions) }}</span>

                        </button>
                    </div>
                </nav>
                <div class="tab-content mb-5">
                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                        <p>
                            {{ $course->description }}
                        </p>
                    </div>
                    <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">

                        @if (count($questions) != 0)
                            @foreach ($questions as $question)
                                <div class="d-flex">
                                    <img src="{{ asset($question->profile ? 'profilePhoto/' . $question->profile : 'defaultProfile/profile.png') }}"
                                        class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;">
                                    <div class="">
                                        <p class="" style="font-size: 14px;">
                                            {{ $question->question }}
                                        </p>
                                        <div class="d-flex justify-content-between">
                                            <h5>{{ $question->name }}</h5>

                                        </div>
                                        <p>{{ $question->created_at->format('Y-m-d') }}</p>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endif


                    </div>
                    <div class="tab-pane" id="nav-vision" role="tabpanel">
                        <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et
                            tempor
                            sit. Aliqu diam
                            amet diam et eos labore. 3</p>
                        <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos
                            labore.
                            Clita erat ipsum et lorem et sit</p>
                    </div>
                </div>
            </div>
            <form action="{{ route('user#question', $course->id) }}" method="post">
                @csrf
                {{-- <input type="hidden" name="productId" value=""> --}}
                <h4 class="mb-5 fw-bold">
                    Leave a question
                </h4>

                <div class="row g-1">
                    <div class="col-lg-12">
                        <div class="border-bottom rounded ">
                            <textarea name="question" id="" class="form-control border-0 shadow-sm" cols="30" rows="8"
                                placeholder="Your Question *" spellcheck="false">{{ old('question') }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-between py-3 mb-5">
                            <button type="submit" class="btn btn-outline-success">
                                Submit
                            </button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="vesitable">
                <div class="owl-carousel vegetable-carousel justify-content-center">


                    <div class="border border-primary rounded position-relative vesitable-item">
                        <div class="vesitable-img">
                            <img src="{{ asset('course/' . $course->image) }}" style="height: 250px"
                                class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute"
                            style="top: 10px; right: 10px;">{{ $course->name }}</div>
                        <div class="p-4 pb-0 rounded-bottom">
                            <h4>{{ $course->name }}</h4>
                            <p>{{ Str::words($course->description, 15, '...') }}</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold">{{ $course->price }} mmk</p>
                                <a href="#"
                                    class="btn border border-secondary rounded-pill px-3 py-1 mb-4 text-primary"><i
                                        class="fa fa-shopping-bag me-2 text-primary"></i> Add to cart</a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection

@section('js-script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const lectureLinks = document.querySelectorAll('.lecture-link');
            const videoURL = document.getElementById('videoURL');

            function getYouTubeId(url) {
                const regex =
                    /(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|\S+\/\S+\/|\S+\/\S+\/?[\S\s]*\S+)?|youtu\.be\/)([\w-]{11})/;
                const match = url.match(regex);
                return match ? match[1] : null;
            }

            lectureLinks.forEach(link => {
                link.addEventListener('click', (event) => {
                    event.preventDefault();
                    const videoUrl = link.getAttribute('data-video-url');
                    console.log(videoUrl);

                    if (videoUrl) {
                        const videoId = getYouTubeId(videoUrl);
                        const embedURL = 'https://www.youtube.com/embed/' + videoId;

                        console.log(videoId);
                        videoURL.src = embedURL;
                    }
                })
            });
        })
    </script>
@endsection
