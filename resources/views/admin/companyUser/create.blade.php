@extends('admin.layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Add Company Account</h5>

            <!-- Vertical Form -->
            <form class="row g-3" method="POST" action="{{ route('storeCompanyUser') }}" enctype="multipart/form-data">
                @csrf
               
                <div class="col-6">
                    <label for="inputEmail4" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="Copen" required>
                </div>
                
                <div class="col-6">
                    <label for="inputEmail4" class="form-label">Profile</label>
                    <input type="file" name="profilepic" class="form-control" id="Copen" required>
                </div>
                <div class="col-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="text" name="email" class="form-control" id="percentage" required>
                </div>
                <div class="col-6">
                    <label for="inputEmail4" class="form-label"> Password</label>
                    <input type="password" name="password" class="form-control" id="maximum" required>
                </div>
                <div class="col-6">
                    <label for="inputEmail4" class="form-label"> Number</label>
                    <input type="number" name="phone" class="form-control" id="maximum" required>
                </div>
              

                <div class="d-flex  justify-content-end">
                    <button type="reset" class="btn btn-secondary m-1">Cancel</button>
                    <button type="submit" class="btn btn-primary m-1">Submit</button>

                </div>
            </form><!-- Vertical Form -->

        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Company users List</h5>

            <!-- Table with stripped rows -->
            <table id="example" class="datatable" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                     
                        <th scope="col">Profile</th>
                        <th scope="col">username </th>
                        <th scope="col">email </th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($companyusers as $key => $user)
                        <tr>
                            <th>{{ $key + 1 }}</th>
                        
                            <td>
                                <img src="{{ ($user->profilepic) }} " width="50" height="60">
                            <td>
                                {{ $user->username }}</td>
                            
                               <td> {{ $user->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table with stripped rows -->

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
