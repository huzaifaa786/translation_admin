@extends('admin.layout')

@section('content')
<div >
    <form id="myForm" action="{{url('admin/vendor/salesall')}}" method="GET">
        <input type="hidden" name="id" class="form-control">
        <div class="row">
            <div class="col">
                <label for="inputEmail4" class="form-label">Vendor Name</label>
                <select id="inputState" class="form-select" name="period" required>
                    @foreach (App\Models\Vendor::all() as $vendor)
                    <option @if (isset($id))  @if ($id==$vendor->id)
                        selected="selected"
                        @endif
                        @endif
                        value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label for="start_date" class="form-label">Start date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="col">
                <label for="end_date" class="form-label">End date</label>
                <input type="date" name="end_date" id="end_date" class="form-control">
            </div>
            <div class="col">
                <br>
                <button type="submit" class="btn btn-primary mt-2">Filter</button>
            </div>
        </div>
    </form>
</div>
<br>
<br>
<div class="card ">
    <div class="card-body p-1">
        <h5 class="card-title">Order List</h5>

        <!-- Table with stripped rows -->
        <table id="example" class="datatable" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Order id</th>
                    <th scope="col">Vendor </th>
                    <th scope="col">Service Type </th>
                    <th scope="col">Service name </th>
                    <th scope="col">Serive Date</th>
                    <th scope="col">Service Time</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                </tr>
            </thead>
            <tbody>
            @php
                $grandTotal = 0;
            @endphp
                @foreach ($sales as $key => $order)
                @php
                    $grandTotal += $order->price
                @endphp
                <tr>
                    <th>{{ $key + 1 }}</th>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->vendor->name }}</td>
                    <td>{{ $order->servicetype }}</td>
                    <td>
                        @if($order->servicetype === 'schedule')
                            @if ($order->scheduletype === 'inPerson')
                        In Person
                    @elseif ($order->scheduletype === 'audio/video')
                        Audio/Video

                    @endif
                        @else
                            ------

                        @endif
                    </td>
                    <td>{{ $order->date }}</td>
                    <td>{{ $order->starttime }} - {{$order->endtime}}</td>
                    <td>{{ $order->price }}</td>
                    <td>
                        @if ($order->status == 0)
                        <div class="text-warning">Order Placed</div>
                        @elseif ($order->status == 1)
                        <div class="text-primary">Accepted</div>
                        @elseif ($order->status == 2)
                        <div class="text-danger">Rejected</div>
                        @else
                        <div class="text-success">Completed</div>
                        @endif
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        <span class="text-end">
            <h3 class="m-5">Total : AED {{$grandTotal}}</h3>
        </span>
        <!-- End Table with stripped rows -->

    </div>
</div>
@endsection
