@extends('cms.parent')

@section('title', 'Change Password')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Change Password')
@section('sub_title', 'change password')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Create New City</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>

                        <div class="row">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="current_password">Enter Current Password</label>
                                    <input type="password" class="form-control" id="current_password"
                                        name="current_password" placeholder="Enter Current Password">
                                </div>
                                <div class="form-group">
                                    <label for="password">Enter New Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter New Password">
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Enter Confirm Password</label>
                                    <input type="password" class="form-control" name="password_confirmation"
                                        id="password_confirmation" placeholder="Enter Confirm Password">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="botton" onclick="performUpdate()" class="btn btn-primary">Change
                                Password</button>
                            {{-- <a href="{{ Route('cities.index') }}" class="btn btn-info">Back to Index</a> --}}

                        </div>
                    </form>
                </div>
                <!-- /.card -->



            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

@endsection


@section('scripts')

<script>
    function performUpdate() {
        let formData = new FormData();
        formData.append('current_password', document.getElementById('current_password').value);
        formData.append('password', document.getElementById('password').value);
        formData.append('password_confirmation', document.getElementById('password_confirmation').value);

        store('/cms/admin/update/password', formData);
    }
</script>

@endsection
