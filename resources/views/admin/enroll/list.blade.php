@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class=" d-flex justify-content-between my-2">
            <div class=""></div>
            <div class="">
                <form action="{{ route('enrol#list') }}" method="get">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="searchKey" value="{{ old('searchKey') }}" class=" form-control"
                            placeholder="Enter Search Key...">
                        <button type="submit" class=" btn bg-dark text-white"> <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <table classorder="table table-hover shadow-sm ">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="text-center">Date</th>
                            <th class="text-center">Enrol Code</th>
                            <th class="text-center">User Name</th>
                            <th class="text-center">Action</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        @if (count($paymentData) != 0)
                            @foreach ($paymentData as $item)
                                <tr class="">

                                    <td class="col-2 text-center">{{ $item->created_at->format('j-F-Y') }}</td>
                                    <td class="col-3 text-center"><a href="{{ route('enrol#detail', $item->enrol_code) }}"
                                            class="enrolCode">{{ $item->enrol_code }}</a>
                                    </td>
                                    <td class="col-3 text-center">{{ $item->user_name }}</td>
                                    <td class="col-2 text-center">
                                        <select name="status" class="form-select px-2 statusDropdown border-0">
                                            <option value="0" @if ($item->status == 0) selected @endif>Pending
                                            </option>
                                            <option value="1" @if ($item->status == 1) selected @endif>
                                                Success</option>
                                            <option value="2" @if ($item->status == 2) selected @endif>Reject
                                            </option>
                                        </select>

                                    </td>
                                    <td class="col-2 text-center">
                                        @switch($item->status)
                                            @case(1)
                                                <i class="fa-solid fa-check text-success"></i>
                                            @break

                                            @case(2)
                                                <i class="fa-regular text-danger fa-circle-xmark"></i>
                                            @break

                                            @default
                                                <i class="fa-solid fa-spinner text-secondary"></i>
                                        @endswitch

                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5">There is no data</td>
                            </tr>
                        @endif



                    </tbody>
                </table>


            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script>
        $(document).ready(function() {
            $('.statusDropdown').on('change', function() {
                let enrolCode = $(this).closest('tr').find('.enrolCode').text();
                let status = $(this).val();

                $data = {
                    'enrol_code': enrolCode,
                    'status': status
                }

                $.ajax({
                    type: 'GET',
                    data: $data,
                    url: '/admin/enrol/status/onchange',
                    dataType: 'json',
                    success: function(res) {
                        res.status == 'success' ? location.reload() : ''
                    }
                })
            })
        })
    </script>
@endsection
