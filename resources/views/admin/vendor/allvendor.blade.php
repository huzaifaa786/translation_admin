@extends('admin.layout')

@section('content')
    <div class="card p-3">
        <div class="card-body table-responsive">
        <div class="card-body ">
            <h5 class="card-title">Vendor List</h5>

            <!-- Table with stripped rows -->
            <table id="example" class="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"> Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone #</th>
                        <th scope="col">user Name</th>
                        <th scope="col">DOB</th>
                        <th scope="col">language</th>
                        <th scope="col">passport</th>
                        <th scope="col">Certificate</th>
                        <th scope="col">cv</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($vendors as $key => $vendor)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                            <td>{{ $vendor->name }}</td>
                            <td>{{$vendor->email}}</td>
                            <td>{{$vendor->number}}</td>
                            <td>{{ $vendor->username }}</td>
                            <td>{{ $vendor->DOB }}</td>
                            <td>
                                @php
                                    $language = json_decode($vendor->language, true);
                                    if (is_array($language)) {
                                        echo implode(', ', $language);
                                    } else {
                                        echo $vendor->language;
                                    }
                                @endphp
                            </td>

                            <td>
                                {{-- {{dd($product->productimage->count())}} --}}
                                @if ($vendor->passport!= null)
                                    <a href="{{ ($vendor->passport) }} " target="blank">
                                        <img src="{{ ($vendor->passport) }} "width="50" height="60">

                                    </a>
                                @else
                                    no image avalible
                                @endif
                            </td>
                            <td>
                                {{-- {{dd($product->productimage->count())}} --}}
                                @if($vendor->certificate!= null)
                                    <a href="{{ ($vendor->certificate) }} " target="blank">
                                        <img src="{{ ($vendor->certificate) }} "width="50" height="60">

                                    </a>
                                @else
                                    no image avalible
                                @endif
                            </td>
                            <td>
                                {{-- {{dd($product->productimage->count())}} --}}
                                @if($vendor->cvImage!= null)
                                    <a href="{{ ($vendor->cvImage) }} " target="blank">
                                        <img src="{{ ($vendor->cvImage) }} "width="50" height="60">

                                    </a>
                                @else
                                    no image avalible
                                @endif
                            </td>
                            <td>
                                @if ($vendor->status == 1)
                                <a href="{{ URL('admin/disable/' . $vendor->id) }}"
                                    class="btn btn-sm btn-danger">Disable
                                </a>

                                @elseif ($vendor->status == 0)


                                <a href="{{ URL('admin/approve/' . $vendor->id) }}"
                                class="btn btn-sm btn-success">Enable</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>




@endsection




