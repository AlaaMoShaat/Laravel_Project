@extends('cms.parent')

@section('title', 'Edit Admin')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Edit Admin')
@section('sub_title', 'edit admin')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit New Admin</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="row">
                            <div class="card-body col-md-6">
                                {{-- <div class="form-group">
                                    <label>Role Name</label>
                                    <select class="form-control select2" id="role_id" name="role_id"
                                        style="width: 100%;">
                                        @foreach ($roles as $role)
                                            <option @if ($role->id == $admins->user->role_id) selected @endif
                                                value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <label for="firstname">Admin First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        value="{{ $admins->user->firstname }}" placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Admin Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        value="{{ $admins->user->lastname }}" placeholder="Enter Last Name">
                                </div>
                            </div>

                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $admins->email }}" placeholder="Enter Email">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                    value="{{ $admins->firstname }}"   placeholder="Enter Password">
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        value="{{ $admins->user->mobile }}" placeholder="Enter Mobile Number">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date Of Birth</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ $admins->user->date }}" placeholder="Enter Your Date Of Birth">
                                </div>
                            </div>


                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control select2" id="gender" name="gender"
                                        style="width: 100%;">
                                        <option selected>{{ $admins->user->gender }}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control select2" id="status" name="status"
                                        style="width: 100%;">
                                        <option selected>{{ $admins->user->status }}</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label>City Name</label>
                                    <select class="form-control select2" id="city_id" name="city_id"
                                        style="width: 100%;">
                                        @foreach ($cities as $city)
                                            <option @if ($city->id == $admins->user->city_id) selected @endif
                                                value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="image">Chosse Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Chosse Image">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="botton" onclick="performUpdate({{ $admins->id }})"
                                class="btn btn-primary">Update</button>
                            <a href="{{ Route('admins.index') }}" class="btn btn-info">Back to Index</a>

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
    function performUpdate(id) {
        let formData = new FormData();
        formData.append('firstname', document.getElementById('firstname').value);
        formData.append('lastname', document.getElementById('lastname').value);
        formData.append('email', document.getElementById('email').value);
        formData.append('mobile', document.getElementById('mobile').value);
        formData.append('date', document.getElementById('date').value);
        formData.append('image', document.getElementById('image').files[0]);
        formData.append('gender', document.getElementById('gender').value);
        formData.append('status', document.getElementById('status').value);
        formData.append('city_id', document.getElementById('city_id').value);

        storeRoute('/cms/admin/admins_update/' + id, formData);
    }
</script>

@endsection
