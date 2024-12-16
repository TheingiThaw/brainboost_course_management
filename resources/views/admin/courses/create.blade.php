@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col card p-3 shadow-sm rounded">

                <form action="{{ route('course#store') }}" method="post" enctype="multipart/form-data">

                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Course Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name')
                                        is-invalid
                                    @enderror"
                                        placeholder="Enter Course Name...">
                                    @error('name')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Course Title</label>
                                    <input type="text" name="title" value="{{ old('title') }}"
                                        class="form-control @error('title')
                                        is-invalid
                                    @enderror"
                                        placeholder="Enter Course Title...">
                                    @error('title')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="courseImage">Course Image</label>
                                    <input type="file" name="image" id=""
                                        class="form-control mt-1 @error('image')
                                        is-invalid
                                    @enderror"
                                        onchange="imageOnChange(event)">
                                    @error('image')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <img class="img-profile mb-1 w-25" id="output" src="img/undraw_profile.svg">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Choose Category</label>
                                    <select name="categoryId" id=""
                                        class="form-control @error('categoryId')
                                        is-invalid
                                    @enderror">
                                        <option value="">Open this select menu</option>
                                        @foreach ($parentCategories as $parentCategory)
                                            <option value="{{ $parentCategory->id }}"
                                                @if (old('categoryId') == $parentCategory->id) selected @endif>
                                                {{ $parentCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('categoryId')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Choose Sub-Category</label>
                                    <select name="subCategoryId" id=""
                                        class="form-control @error('subCategoryId')
                                        is-invalid
                                    @enderror">
                                        <option value="">Open this select menu</option>
                                        @foreach ($subCategories as $subCategory)
                                            <option value="{{ $subCategory->id }}"
                                                @if (old('subCategoryId') == $subCategory->id) selected @endif>
                                                {{ $subCategory->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('subCategoryId')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Certificate Available</label>
                                    <select name="certificate" id=""
                                        class="form-control @error('certificate')
                                        is-invalid
                                    @enderror">
                                        <option value="">Choose...</option>
                                        <option value="1" {{ old('certificate') == '1' ? 'selected' : '' }}>Available
                                        </option>
                                        <option value="0" {{ old('certificate') == '0' ? 'selected' : '' }}>Not
                                            available</option>
                                    </select>
                                    @error('certificate')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label class="form-label">Choose Level</label>
                                    <select name="level" id=""
                                        class="form-control @error('level')
                                        is-invalid
                                    @enderror">
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="text" name="price" value="{{ old('price') }}"
                                        class="form-control @error('price')
                                        is-invalid
                                    @enderror"
                                        placeholder="">
                                    @error('price')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Duration</label>
                                    <input type="text" name="duration" value="{{ old('duration') }}"
                                        class="form-control @error('duration')
                                        is-invalid
                                    @enderror"
                                        placeholder="">
                                    @error('duration')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Instructor</label>
                                    <select name="instructorId" id=""
                                        class="form-control @error('instructorId')
                                        is-invalid
                                    @enderror">
                                        <option value="">Select Instructor</option>
                                        @foreach ($instructors as $instructor)
                                            <option value="{{ $instructor->id }}"
                                                @if (old('instructorId') == $instructor->id) selected @endif>
                                                {{ $instructor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="mb-3">
                                    <label class="form-label">Resource</label>
                                    <input type="text" name="resource" value="{{ old('resource') }}"
                                        class="form-control @error('resource')
                                        is-invalid
                                    @enderror"
                                        placeholder="">
                                    @error('resource')
                                        <small class="invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course Prerequisites</label>
                            <textarea name="prerequisites" id="" cols="30" rows="10"
                                class="form-control @error('prerequisites')
                                        is-invalid
                                    @enderror"
                                placeholder="Enter Prerequisites...">{{ old('prerequisites') }}</textarea>
                            @error('prerequisites')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Course Description</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                class="form-control @error('description')
                                        is-invalid
                                    @enderror"
                                placeholder="Enter Description...">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label class="form-label">Goals</label>
                                    <div class=" goals">
                                        <div class="d-flex">
                                            <input type="text" name="goal[]" value="" id=""
                                                class="form-control">

                                            <input type="button" value="Add More.."
                                                class="mx-3 addMore btn btn-success">

                                            @error('goal')
                                                <small class="invalid-feedback">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" name="FOC" type="checkbox" value="1"
                                        id="defaultCheck1">
                                    <label class="form-check-label" for="defaultCheck1">
                                        Free Course
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="my-3 w-25">
                            <input type="submit" value="Create Course" class=" btn btn-success w-100 rounded shadow-sm">
                        </div>
                    </div>
                </form>


            </div>

        </div>
    </div>
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.addMore', function() {
                $('.goals').append(`
                <div class="d-flex my-3">
                <input type="text" name="goal[]" value="" class="form-control">
                <input type="button" value="Add More.." class="mx-3 addMore btn btn-success">
                <input type="button" value="Delete" class="ms-2 deleteGoal btn btn-danger">
                <div>
            `);
            });

            $(document).on('click', '.deleteGoal', function() {
                $(this).closest('.d-flex').remove();
            })
        });
    </script>
@endsection
