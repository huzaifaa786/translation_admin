@extends('admin.layout')

@section('content')
<div class="col-6">

    <form id="myForm" action="{{url('admin/vendor/salesall')}}" method="GET">
        <input type="hidden" name="id" class="form-control">
        <label for="inputEmail4" class="form-label">Vendor Name</label>
        <select id="inputState" class="form-select" name="period" onchange="submitForm()">
            <option>choose vendor</option>
            @foreach (App\Models\Vendor::all() as $vendor)

            <option @if (isset($id))  @if ($id==$vendor->id)
                selected="selected"
                @endif
                @endif
                value="{{ $vendor->id }}">{{ $vendor->name }}</option>
            @endforeach
        </select>
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

@section('script')
<script>
    function submitForm() {
      // Get the selected company ID
      var companyId = document.getElementById("inputState").value;
  
      // Set the company ID as the value of the hidden input field
      document.getElementsByName("id")[0].value = companyId;
  
      // Submit the form
      document.getElementById("myForm").submit();
    }
</script>
@endsection