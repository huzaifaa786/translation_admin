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
                        <th scope="col">user Name</th>
                        <th scope="col">DOB</th>
                        <th scope="col">Language</th>
                        <th scope="col">passport</th>
                        <th scope="col">Certificate</th>

                        <th scope="col">Action</th>
                        <th scope="col">Action</th>


                    </tr>
                </thead>

                <tbody>

                    @foreach ($vendors as $key => $vendor)
                    @if ($vendor->status == 0)
                    <tr>
                        <th>{{ $key + 1 }}</th>
                        <td>{{ $vendor->name }}</td>
                        <td>{{ $vendor->email }}</td>
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
                                <a href="{{ asset($vendor->passport) }} " target="blank">
                                    <img src="{{ asset($vendor->passport) }} "width="50" height="60">

                                </a>
                            @else
                                no image avalible
                            @endif
                        </td>
                        <td>
                            {{-- {{dd($product->productimage->count())}} --}}
                            @if($vendor->certificate!= null)
                                <a href="{{ asset($vendor->certificate) }} " target="blank">
                                    <img src="{{ asset($vendor->certificate) }} "width="50" height="60">

                                </a>
                            @else
                                no image avalible
                            @endif
                        </td>

                        <td><a href="{{ URL('admin/approve/' . $vendor->id) }}"
                                class="btn btn-sm btn-primary">Aprove</a></td>

                        <td> <button type="button" class="btn btn-danger waves-effect m-r-20 btn-sm delete-btn"
                                id="{{ $vendor->id }}" data-bs-toggle="modal"
                                data-bs-target="#basicModal">Reject</button>
                        </td>

                    </tr>

                    @else

                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="modal fade" id="basicModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Company</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="deleteForm" method="Get">
                        <div class="modal-body">
                            <h4>Are you sure you want to Reject the request?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit"class="btn btn-success">Yes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css" />
@endsection

@section('script')
    <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>

    <script>
        $(document).ready(function() {



            $('tbody').on('click', '.delete-btn', function() {

                let id = this.id;

                $('#deleteForm').attr('action', '{{ route('reject/vendor', '') }}' + '/' + id);

            });

        })
    </script>
@endsection
