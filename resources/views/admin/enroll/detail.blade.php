@extends('admin.layouts.master')

@section('title', 'User Enrol Detail')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">


        <a href="{{ route('enrol#list') }}" class=" text-black m-3"> <i class="fa-solid fa-arrow-left-long"></i> Back</a>

        <!-- DataTales Example -->


        <div class="row">
            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-header bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">Customer Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Name :</div>
                        <div class="col-7">{{ $enrols[0]->user_name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Phone :</div>
                        <div class="col-7">
                            {{ $enrols[0]->phone }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Addr :</div>
                        <div class="col-7">
                            {{ $paymentHistory->address }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Code :</div>
                        <div class="col-7" id="enrolCode">{{ $enrols[0]->enrol_code }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Order Date :</div>
                        <div class="col-7">{{ $enrols[0]->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Total Price :</div>
                        <div class="col-7">
                            {{ $paymentHistory->total_amt }} mmk<br>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card col-5 shadow-sm m-4 col">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Purchase Information</h6>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-5">Contact Phone :</div>
                        <div class="col-7">{{ $paymentHistory->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Payment Method :</div>
                        <div class="col-7">{{ $paymentHistory->payment_method }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-5">Purchase Date :</div>
                        <div class="col-7">{{ $paymentHistory->created_at->format('j-F-Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <img style="width: 150px" src="{{ asset('paymentPhoto/' . $paymentHistory->payslip_image) }}"
                            class=" img-thumbnail">
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-primary">
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h6 class="m-0 font-weight-bold text-white">Order Board</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover shadow-sm " id="productTable">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="col-2">Image</th>
                                <th>Name</th>
                                <th>Course Price</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($enrols as $enrol)
                                <tr>
                                    <input type="hidden" class="courseId" value="{{ $enrol->course_id }}">
                                    <input type="hidden" class="userId" value="{{ $enrol->user_id }}">

                                    <td>
                                        <img src="{{ asset('course/' . $enrol->image) }}" class=" w-50 img-thumbnail">
                                    </td>
                                    <td>{{ $enrol->course_name }}</td>
                                    <td>{{ $enrol->price }} mmk</td>
                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
            </div>
            <div class="card-footer d-flex justify-content-end">
                <div class="">
                    <input type="button" id="btn-order-confirm" class="btn btn-success rounded shadow-sm" value="Confirm">
                    <input type="button" id="btn-order-reject" class="btn btn-danger rounded shadow-sm" value="Reject">
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {
            $enrolCode = $('#enrolCode').text();

            $('#btn-order-confirm').on('click', function() {
                $.ajax({
                    type: 'GET',
                    data: {
                        'enrolCode': $enrolCode
                    },
                    dataType: 'json',
                    url: '/admin/enrol/confirm',
                    success: function(res) {
                        res.status == 'success' ? location.href = '/admin/enrol/list' : ''
                    }
                })
            });

            $('#btn-order-reject').on('click', function() {
                $.ajax({
                    type: 'GET',
                    data: {
                        'enrolCode': $enrolCode
                    },
                    dataType: 'json',
                    url: '/admin/enrol/reject',
                    success: function(res) {
                        res.status == 'success' ? location.href = '/admin/enrol/list' : location
                            .reload()
                    }
                })
            })
        })
    </script>
@endsection
