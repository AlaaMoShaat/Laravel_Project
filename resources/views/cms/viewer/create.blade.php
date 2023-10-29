@extends('cms.parent')

@section('title', 'Create Viewer')

@section('main_title', 'Create Viewer')

@section('sub_title', 'create viewer')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Viewer</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        placeholder="Enter First Name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        placeholder="Enter Last Name">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter Your Email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter Your Password">
                                </div>
                                <div class="form-group">
                                    <label>Gender</label>
                                    <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control select2" name="status" id="status" style="width: 100%;">
                                        <option value="active">Avtive</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter Your Image">
                                </div>
                                <div class="form-group">
                                    <label for="date">Date of Birth</label>
                                    <input type="date" class="form-control" id="date" name="date"
                                        placeholder="Enter Your Date">
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile"
                                        placeholder="Enter Your Mobile">
                                </div>
                                <div class="form-group">
                                    <label>City Name</label>
                                    <select class="form-control select2" name="city_id" id="city_id" style="width: 100%;">
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Speciality Name</label>
                                    <select class="form-control select2" name="speciality_id" id="speciality_id"
                                        style="width: 100%;">
                                        @foreach ($specialities as $speciality)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                                <a href="{{ route('viewers.index') }}" type="submit" class="btn btn-danger">Go Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('scripts')
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('first_name', document.getElementById('first_name').value);
            formData.append('last_name', document.getElementById('last_name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('gender', document.getElementById('gender').value);
            formData.append('password', document.getElementById('password').value);
            formData.append('status', document.getElementById('status').value);
            formData.append('mobile', document.getElementById('mobile').value);
            formData.append('date', document.getElementById('date').value);
            formData.append('city_id', document.getElementById('city_id').value);
            formData.append('speciality_id', document.getElementById('speciality_id').value);
            formData.append('image', document.getElementById('image').files[0]);
            store('/cms/admin/viewers', formData);
        }
    </script>
@endsection
