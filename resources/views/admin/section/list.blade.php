@extends('admin.layouts.master')

@section('title', 'Course Detail')

@section('content')

    <div class="container-fluid">
        <div class="row py-2 bg-white rounded-3">
            <div class="col-1">
                @if ($course)
                    <img src="{{ asset($course->image ? 'course/' . $course->image : 'defaultProfile/profile.png') }}"
                        class="rounded-5 img-thumbnail" alt="">
                @else
                    <img src="{{ asset('defaultProfile/profile.png') }}" class="rounded-5 img-thumbnail" alt="">
                @endif

            </div>
            <div class="col d-flex align-items-center">
                <div>
                    <h4>{{ $course->name ?? 'N/A' }}</h4>
                    <span class="text-muted">
                        {{ $course->description ?? 'N/A' }}
                    </span>
                </div>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-center">
                <div>
                    <!-- Button trigger modal -->
                    @if (Auth::user()->role != 'instructor')
                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Add Section
                        </button>
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Section</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><i
                                            class="fa-solid fa-xmark"></i></button>
                                </div>
                                <form action="{{ route('section#create', $course->id ?? '') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="course_id" id="course_id"
                                            value="{{ $course->id ?? '' }}">
                                        <div class="mb-3">
                                            <label for="section" class="col-form-label">Course Section:</label>
                                            <input type="text" name="title" class="form-control" id="section">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="col-form-label">Course description:</label>
                                            <input type="text" name="description" class="form-control" id="description">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-success sectionCreated">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (count($sections) != 0)
        @foreach ($sections as $index => $section)
            <div class="container py-3 px-2 my-3 bg-white rounded-1 lecture">
                <div class="d-flex px-3 justify-content-between">
                    <h6>Section {{ $index + 1 }}: {{ $section->title }}</h6>
                    <div>
                        @if (Auth::user()->role != 'instructor')
                            <button type="button" class="btn btn-danger text-white"
                                onclick="confirmDelete({{ $section->id }})" value="">Delete</button>
                            <button type="button" class="btn btn-success text-white addLecture"
                                data-section-id="{{ $section->id }}">Add Lecture</button>
                        @endif
                    </div>
                </div>

                <div>
                    @if (count($section->lectures) != 0)
                        @foreach ($section->lectures as $index => $lecture)
                            <div class="d-flex my-3 justify-content-between">
                                <input type="hidden" name="sectionId" value="{{ $section->id }}" class="sectionId">
                                <input type="hidden" name="lectureId" value="{{ $lecture->id }}" class="lectureId">
                                <p>{{ $index + 1 }}. {{ $lecture->name ?? 'N/A' }}</p>
                                <div>
                                    <!-- Button trigger modal -->
                                    @if (Auth::user()->role != 'instructor')
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#lectureEdit{{ $lecture->id }}">
                                            Edit
                                        </button>
                                    @endif

                                    <!-- Modal -->
                                    <div class="modal fade" id="lectureEdit{{ $lecture->id }}" tabindex="-1"
                                        aria-labelledby="lecture edit{{ $lecture->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-2">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="lecture edit{{ $lecture->id }}">
                                                        Lecture Edit</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                                <form action="{{ route('lecture#edit', $lecture->id) }}" method="POST">
                                                    @csrf
                                                    <div>
                                                        <div class="mb-3">
                                                            <label for="lectureName" class="form-label">Lecture
                                                                Title</label>
                                                            <input type="text"
                                                                class="form-control @error('name') is-invalid @enderror"
                                                                name="name" id="lectureName"
                                                                value="{{ old('name', $lecture->name) }}"
                                                                placeholder="Enter Lecture Title">
                                                            @error('name')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror

                                                            <textarea class="form-control mt-2 @error('description') is-invalid @enderror" id="lectureContent" name="description"
                                                                placeholder="Enter Lecture Content" rows="3">{{ old('description', $lecture->description) }}</textarea>
                                                            @error('description')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <div class="mb-3">
                                                            <label for="video" class="form-label">Add Video URL</label>
                                                            <input type="text" name="url"
                                                                class="form-control @error('url') is-invalid @enderror"
                                                                id="video" placeholder="Add URL"
                                                                value="{{ old('url', $lecture->video) }}">
                                                            @error('url')
                                                                <small class="invalid-feedback">{{ $message }}</small>
                                                            @enderror
                                                        </div>

                                                        <!-- Hidden input for section_id if needed -->
                                                        <input type="hidden" name="section_id"
                                                            value="{{ $lecture->section_id }}">

                                                        <div class="mb-3 d-flex">
                                                            <button type="submit" class="btn btn-success text-white">Save
                                                                Lecture</button>
                                                            <button type="button"
                                                                class="btn mx-2 btn-dark cancelLecture text-white">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    @if (Auth::user()->role != 'instructor')
                                        <button type="button" class="btn bg-danger deleteLecture text-white"
                                            value="">Delete</button>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    @endif
@endsection

@section('js-script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {

            $(document).ready(function() {
                $('.addLecture').on('click', function() {
                    if ($(this).siblings('form').length === 0) {
                        $(this).closest('.lecture').append(`
                            <form action="" method="POST">
                                <div>
                                    <div class="mb-3">
                                        <label for="lectureName" class="form-label">Lecture Title</label>
                                        <input type="text" class="form-control" name="name" id="lectureName" placeholder="Enter Lecture Title">
                                    </div>

                                    <div class="mb-3">
                                        <label for="lectureContent" class="form-label">Lecture Content</label>
                                        <textarea class="form-control mt-2" id="lectureContent" name="description" placeholder="Enter Lecture Content" rows="3"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label for="video" class="form-label">Add Video URL</label>
                                        <input type="text" name="url" class="form-control" id="video" placeholder="Add URL">
                                    </div>

                                    <div class="mb-3 d-flex">
                                        <button type="button" class="btn btn-success saveLecture text-white">Save Lecture</button>
                                        <button type="button" class="btn mx-2 btn-dark cancelLecture text-white">Cancel</button>
                                    </div>
                                </div>
                            </form>
                    `);
                    }
                });

                $(document).on('click', '.saveLecture', function() {
                    const form = $(this).closest('form');
                    const sectionContainer = form.closest(
                        '.lecture');
                    const sectionId = sectionContainer.find('.addLecture').data('section-id');
                    const name = form.find('#lectureName').val();
                    const description = form.find('#lectureContent').val();
                    const url = form.find('#video').val();
                    const csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            '_token': csrfToken,
                            'section_id': sectionId,
                            'name': name,
                            'description': description,
                            'url': url
                        },
                        url: '/admin/course/section/create/lecture/' + sectionId,
                        success: function(response) {
                            if (response.success) {
                                form.remove();
                                location.reload();
                            } else {
                                alert('Failed to add lecture.');
                            }
                        },
                        error: function(error) {
                            alert('An error occurred. Please try again.');
                            console.error(error);
                        }
                    });
                });

                $(document).on('click', '.cancelLecture', function() {
                    $(this).closest('form').remove();
                });
            });


            $('.deleteLecture').click(function() {
                let lectureId = $(this).closest('.d-flex').find('.lectureId').val();
                let sectionId = $(this).closest('.d-flex').find('.sectionId').val();
                console.log(lectureId);

                $.ajax({
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        'section_id': sectionId
                    },
                    url: '/admin/course/section/delete/lecture/' + lectureId,
                    success: function(res) {
                        console.log(res.success ? location.reload() : 'not success')
                    },
                    error: function(xhr, status, error) {
                        console.log('error: ', error);
                    }

                })
            })

        })

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
                        text: "Your Lecture has been deleted.",
                        icon: "success"
                    });

                    setInterval(() => {
                        location.href = '/admin/course/section/delete/' + $id;
                    }, 1000);
                }
            });
        }
    </script>
@endsection
