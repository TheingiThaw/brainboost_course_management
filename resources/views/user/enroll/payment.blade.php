@extends('user.layouts.master')

@section('title', 'BrainBoost User Payment')

@section('content')
    <div class="container " style="margin-top: 50px">
        <div class="row">
            <div class="card col-12 shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <h5 class="mb-4">Payment methods</h5>

                            @if (count($payments) != 0)
                                @foreach ($payments as $payment)
                                    <div class="">
                                        <b>
                                            {{ $payment->type }}
                                        </b> ( Name :
                                        {{ $payment->name }}
                                        )
                                    </div>

                                    Account :
                                    {{ $payment->account_number }}

                                    <hr>
                                @endforeach
                            @endif

                        </div>
                        <div class="col">
                            <div class="card shadow-sm">
                                <div class="card-header">
                                    Payment Info
                                </div>
                                <div class="card-body">
                                    <div class="">
                                        <form action="{{ route('user#enrol') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <input type="text" name="name" id="" readonly
                                                        value="{{ Auth::user()->name ?? Auth::user()->nickname }}"
                                                        class="form-control" placeholder="User Name...">
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="phone" id=""
                                                        value="{{ Auth::user()->phone }}"
                                                        class="form-control @error('phone')
                                                            is-invalid
                                                        @enderror"
                                                        placeholder="09xxxxxxxx">
                                                    @error('phone')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="address" id=""
                                                        value="{{ Auth::user()->address }}"
                                                        class="form-control @error('address')
                                                            is-invalid
                                                        @enderror"
                                                        placeholder="Address...">
                                                    @error('address')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col">
                                                    <select name="paymentType" id=""
                                                        class=" form-select @error('paymentType')
                                                            is-invalid
                                                        @enderror">
                                                        <option value="">Choose Payment methods...</option>
                                                        @foreach ($payments as $payment)
                                                            <option value="{{ $payment->id }}">{{ $payment->type }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('paymentType')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="col">
                                                    <input type="file" name="payslipImage" id=""
                                                        class="form-control @error('payslipImage')
                                                            is-invalid
                                                        @enderror">
                                                    @error('payslipImage')
                                                        <small class="invalid-feedback">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-4">
                                                <div class="col">
                                                    <input type="hidden" name="enrolCode"
                                                        value="{{ $tempOrders[0]->enrol_code }}">
                                                    Order Code : <span
                                                        class="text-success fw-bold">{{ $tempOrders[0]->enrol_code }}</span>
                                                </div>
                                                <div class="col">
                                                    <input type="hidden" name="totalAmount"
                                                        value="{{ $tempOrders[0]->total_amt }}">
                                                    Total amt : <span class=" fw-bold">{{ $tempOrders[0]->total_amt }}
                                                        mmk</span>
                                                </div>
                                            </div>

                                            <div class="row mt-4 mx-2">
                                                <button type="submit" class="btn btn-outline-success w-100"><i
                                                        class="fa-solid fa-cart-shopping me-3"></i> Order
                                                    Now...</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
