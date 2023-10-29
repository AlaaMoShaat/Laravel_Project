@extends('cms.parent')

@section('title', 'Edit Author')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Edit Author')
@section('sub_title', 'edit author')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit New Author</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="row">
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="firstname">Author First Name</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname"
                                        value="{{ $authors->user->firstname }}" placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Author Last Name</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname"
                                        value="{{ $authors->user->lastname }}" placeholder="Enter Last Name">
                                </div>
                            </div>

                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $authors->email }}" placeholder="Enter Email">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                    value="{{ $authors->firstname }}"   placeholder="Enter Password">
                                </div> --}}
                            </div>
                        </div>

                        <div class="row">
                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        value="{{ $authors->user->mobile }}" placeholder="Enter Mobile Number">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date Of Birth</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        value="{{ $authors->user->date }}" placeholder="Enter Your Date Of Birth">
                                </div>
                            </div>


                            <div class="card-body col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control select2" id="gender" name="gender"
                                        style="width: 100%;">
                                        <option selected>{{ $authors->user->gender }}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control select2" id="status" name="status"
                                        style="width: 100%;">
                                        <option selected>{{ $authors->user->status }}</option>
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
                                            <option @if ($city->id == $authors->user->city_id) selected @endif
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
                            <button type="botton" onclick="performUpdate({{ $authors->id }})"
                                class="btn btn-primary">Update</button>
                            <a href="{{ Route('authors.index') }}" class="btn btn-info">Back to Index</a>

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

        storeRoute('/cms/admin/authors_update/' + id, formData);
    }
</script>

@endsection
