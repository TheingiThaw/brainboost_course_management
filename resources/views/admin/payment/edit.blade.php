@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid w-50">
        <div class="card">
            <div class="card-body shadow">
                <form action="{{ route('payment#update', $payment->id) }}" method="post" class="p-3 rounded">
                    @csrf
                    <label for="paymentName" class="mt-3">Payment Name</label>
                    <input type="text" name="paymentName" value="{{ old('paymentName', $payment->account_name) }}"
                        class=" form-control @error('paymentName')
                        is-invalid
                    @enderror "
                        placeholder="Payment Name...">
                    @error('paymentName')
                        <small class="text-danger">{{ $message }}</small><br>
                    @enderror

                    <label for="accountNumber" class="mt-3">Account Number</label>
                    <input type="text" name="accountNumber" value="{{ old('accountNumber', $payment->account_number) }}"
                        class=" form-control @error('accountNumber')
                        is-invalid
                    @enderror "
                        placeholder="Account Number...">
                    @error('accountNumber')
                        <small class="text-danger">{{ $message }}</small><br>
                    @enderror

                    <label for="type" class="mt-3">Payment Type</label>
                    <input type="text" name="type" value="{{ old('type', $payment->type) }}"
                        class=" form-control @error('type')
                        is-invalid
                    @enderror "
                        placeholder="Payment Type...">
                    @error('type')
                        <small class="text-danger">{{ $message }}</small><br>
                    @enderror

                    <input type="submit" value="Update" class="btn btn-outline-primary mt-3">
                </form>
            </div>
        </div>
    </div>
@endsection
