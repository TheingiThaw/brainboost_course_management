@extends('user.layouts.master')

@section('title', 'BrainBoost User Enrol List')

@section('content')
    <div class="container " style="margin-top: 50px">
        <div class="row">
            <table class="table table-hover shadow-sm ">
                <thead class="bg-primary text-white">
                    <tr>
                        <th>Date</th>
                        <th>Enrol Code</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>

                    @if (count($orders) != 0)
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->created_at->format('j-F-Y') }}</td>
                                <td>{{ $order->enrol_code }}</td>
                                <td>
                                    @if ($order->status == 0)
                                        <i class="fa-solid fa-spinner text-secondary"></i>
                                    @elseif ($order->status == 1)
                                        <i class="fa-solid fa-check"></i>
                                    @else
                                        <i class="fa-regular text-danger fa-circle-xmark"></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">There is no order yet</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
