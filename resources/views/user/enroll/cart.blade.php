@extends('user.layouts.master')

@section('title', 'BrainBoost User Cart')

@section('content')
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <a href="{{ route('user#enrol#list') }}" class="btn btn-dark my-5" style="width:100px">Enroll
                    List</a>
            </div>
            <div class="table-responsive">
                <table class="table" id="courseTable">
                    <thead>
                        <tr>
                            <th scope="col">Course</th>
                            <th scope="col">Course Details</th>
                            <th scope="col">Price</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($enrolments) != 0)
                            @foreach ($enrolments as $enrolment)
                                <tr>
                                    <th scope="row">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('course/' . $enrolment->image) }}"
                                                class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;"
                                                alt="">
                                        </div>
                                    </th>
                                    <td>
                                        <p class="mb-0 mt-4">{{ $enrolment->name }}</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 price">{{ $enrolment->price }}mmk</p>
                                    </td>
                                    <td>
                                        <p class="mb-0 mt-4 total">{{ $enrolment->price }}mmk</p>
                                    </td>
                                    <td>
                                        <input type="hidden" class="cartId" value="{{ $enrolment->cart_id }}">
                                        <input type="hidden" class="courseId" value="{{ $enrolment->id }}">
                                        <input type="hidden" class="userId" value="{{ request()->user()->id }}">
                                        <button class="btn btn-md rounded-circle bg-light border mt-4 btn-remove">
                                            <i class="fa fa-times text-danger"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="text-center">There is no enrolments</td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>

            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0" id="subtotal"></p>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4 " id="finalTotal"></p>
                        </div>
                        <button id="btn-checkout"
                            class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {
            $('.btn-remove').click(function() {
                let parentNode = $(this).closest('tr');
                let cartId = parentNode.find('.cartId').val();
                let courseId = parentNode.find('.courseId').val();

                $.ajax({
                    type: 'GET',
                    data: {
                        cartId,
                        courseId
                    },
                    dataType: 'json',
                    url: '/user/course/delete',
                    success: function(res) {
                        res.status == 'success' ? location.reload() : ''
                    }
                })
            })

            let totalPrice = 0;
            $('#courseTable tbody tr').each(function(index, row) {
                totalPrice += Number($(row).find('.total').text().replace('mmk', ''));
            })

            $(this).find('#subtotal').text(totalPrice + ' mmk');
            let finalTotal = totalPrice;
            $(this).find('#finalTotal').text(finalTotal + ' mmk');

            $('#btn-checkout').click(function() {
                let enrolList = [];
                enrolCode = 'EC-' + Math.floor(Math.random() * 1000000);

                $('#courseTable tbody tr').each(function(index, row) {
                    enrolList.push({
                        'course_id': $(row).find('.courseId').val(),
                        'user_id': $(row).find('.userId').val(),
                        'total_amt': finalTotal,
                        'enrol_code': enrolCode,
                    });
                })


                $.ajax({
                    type: 'GET',
                    data: {
                        'tempOrder': JSON.stringify(enrolList)
                    },
                    url: '/user/tempStorage',
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.href = '/user/enrolPage' : ''
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error:', status, error);
                        console.log('Response Text:', xhr
                            .responseText);
                    }
                })


            })
        })
    </script>
@endsection
