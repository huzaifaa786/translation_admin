@extends('admin.layout')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Bug reports</h5>

        <!-- Table with stripped rows -->
        <table id="example" class="datatable" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">#</th>

                    <th scope="col">User</th>
                    <th scope="col">Picture </th>
                    <th scope="col">Bug Detail </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($bugs as $key => $bug)
                <tr>
                    <th>{{ $key + 1 }}</th>

                    <td>
                        {{ $bug->user->username }}</td>
                    <td>
                        <a href="{{ $bug->picture }}" data-lightbox="bug-images" data-title="Bug Picture">
                            <img src="{{ $bug->picture }}" width="50" height="60">
                        </a>
                    </td>
                    <td> {{ $bug->bug }}</td>
                </tr>
                </tr>
                @endforeach
            </tbody>
        </table>
        <!-- End Table with stripped rows -->

    </div>
</div>


<div class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Coupon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="deleteForm" method="Get">
                    <div class="modal-body">
                        <h4>Are you sure you want to delete?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Yes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title" id="defaultModalLabel">Edit Coupon</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                    @csrf

                    <label>Coupon</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="name" placeholder="Name" name="copen" required>
                    </div>
                    <label>Coupon percentage</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="copen_percentage" placeholder="Name"
                            name="percentage" required>
                    </div>
                    <label>Maximum</label>
                    <div class="form-group form-float">
                        <input type="text" class="form-control" id="copen_maximum" placeholder="Name" name="maximum"
                            required>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">SAVE CHANGES</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CLOSE</button>
                </div>
            </form>
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

                $('#deleteForm').attr('action', '{{ route('delete/copen', '') }}' + '/' + id);

            });
            $('tbody').on('click', '.edit-btn', function() {

                let id = this.id;



                let name = $(this).attr('name');

                let percentage = $(this).attr('percentage');

                let maximum = $(this).attr('maximum');






                $('#name').val(name);
                $('#copen_percentage').val(percentage);
                $('#copen_maximum').val(maximum);



                $('#updateForm').attr('action', '{{ route('edit-copen', '') }}' + '/' + id);

            });





        })
</script>
@endsection
