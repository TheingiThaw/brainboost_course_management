@extends('admin.layouts.master')

@section('title', 'BrainBoost Questions')

@section('content')
    <div class="container-fluid">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <button class=" btn btn-secondary rounded shadow-sm"> <i class="fa-solid fa-database"></i>
                    Question Count ({{ count($questions) }} ) </button>
                <a href="" class=" btn btn-outline-primary  rounded shadow-sm">All Questions</a>
            </div>
            <div class="">
                <form action="{{ route('questions#list') }}" method="get">
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
                    <thead class="bg-primary text-white">
                        <tr>
                            <th>Image</th>
                            <th>Course Name</th>
                            <th>Sub-Category</th>
                            <th>Question</th>
                            <th>Instructor</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($questions) != 0)
                            @foreach ($questions as $question)
                                <tr>
                                    <td> <img src="{{ asset('course/' . $question->image) }}"
                                            class=" img-thumbnail rounded shadow-sm" style="width:100px" alt="">
                                    </td>
                                    <td>{{ $question->course_name }}</td>
                                    <td>{{ $question->sub_category_name }}</td>
                                    <td>{{ $question->question }}</td>
                                    <td>
                                        {{ $question->instructor_name }}
                                    </td>
                                    <td>
                                        <a href="{{ route('section#detail', $question->course_id) }}"
                                            class="btn btn-sm btn-outline-primary"> <i class="fa-solid fa-eye"></i> </a>

                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7">
                                    <h5 class="text-muted text-center">There is no questions</h5>
                                </td>
                            </tr>
                        @endif


                    </tbody>
                </table>



            </div>
        </div>
    </div>
@endsection
