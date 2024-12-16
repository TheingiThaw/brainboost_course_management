@extends('admin.layouts.master')

@section('title', 'BrainBoost Questions')

@section('content')
    <div class="container-fluid">
        <div class=" d-flex justify-content-between my-2">
            <div class="">
                <button class=" btn btn-secondary rounded shadow-sm"> <i class="fa-solid fa-database"></i>
                    Review Count ({{ count($reviews) }} ) </button>
                <a href="" class=" btn btn-outline-primary  rounded shadow-sm">All Reviews</a>
            </div>
            <div class="">
                <form action="{{ route('review#list') }}" method="get">
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
                            <th>No.</th>
                            <th>Image</th>
                            <th>User Name</th>
                            <th>Course Name</th>
                            <th>Comment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($reviews) != 0)
                            @foreach ($reviews as $index => $review)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ asset($review->profile ? 'profilePhoto/' . $review->profile : 'defaultProfile/profile.png') }}"
                                            alt="" class="img-fluid" style="width:50px; height:50px"></td>
                                    <td>{{ $review->user_name }}</td>
                                    <td>{{ $review->course_name }}</td>
                                    <td>{{ $review->commment }}</td>
                                    <td>
                                        <a href="{{ route('courses#detail', $review->id) }}"
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
