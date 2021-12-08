<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student CRUD</title>
    <!-- ALL CSS FILES  -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
</head>
<body>



<div class="wrap-table ">
    <a id="add_new_student_modal_btn" href="{{--{{ route('student.create') }}--}}" class="btn btn-primary btn-sm">Add New Student</a>
   {{-- <a href="--}}{{--{{ route('crud.main') }}--}}{{--" class="btn btn-primary btn-sm">Home</a><br><br>--}}
    <div class="card shadow">
        <div class="msg_delete_notification"></div>
        <div class="card-body">
            <h2>All Data</h2>
            {{--@include('validation')--}}
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Cell</th>
                    <th>Gender</th>

                    <th>Username</th>
                    <th>Photo</th>

                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="all_student_table">


                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Student Add modal --}}

<div id="add_new_student_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header ">
                <h4>Add new student</h4>

            </div>
            <div class="msg"></div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="add_student_form">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Cell</label>
                        <input type="text" name="cell" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="uname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <input class="" type="radio" value="Male" name="gender" id="Male"><label for="Male">Male</label>
                        <input class="" type="radio" value="Female" name="gender" id="Female"><label for="Female">Female</label>
                    </div>
                    <div class="form-group">
                        <label for="">Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit"  class="btn btn-primary" value="Add">
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>


{{--
single student show modal
--}}
<div id="show_student_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header ">
                <h4>Student Information</h4>

            </div>
           {{-- <div class="msg"></div>--}}
            <div class="modal-body" id="show_modal_body">

            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

{{-- Edit student modal--}}
<div id="edit_student_modal" class="modal fade">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content ">
            <div class="modal-header ">
                <h4>Edit Student Information</h4>

            </div>
            <div class="msg_update_notification"></div>
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="edit_student_form">
                    @csrf
                    @method('PUT')
                    <div id="edit_modal_body">

                    </div>

                    <div class="form-group">
                        <label for=""></label>
                        <input type="submit"  class="btn btn-primary" value="Update">
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>



<!-- JS FILES  -->
<script src="{{ asset('assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/functions.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>
</html>
