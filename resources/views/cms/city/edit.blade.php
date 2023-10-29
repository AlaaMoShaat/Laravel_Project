@extends('cms.parent')

@section('title', 'Edit City')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Edit City')
@section('sub_title', 'edit city')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data City</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="row">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Country Name</label>
                                    <select class="form-control select2" id="country_id" name="country_id"
                                        style="width: 100%;">
                                        @foreach ($countries as $country)
                                            <option @if ($country->id == $cities->country_id) selected @endif
                                                value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">City Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $cities->name }}" placeholder="Enter City Name">
                                </div>
                                <div class="form-group">
                                    <label for="street">City Street</label>
                                    <input type="text" class="form-control" id="street" name="street"
                                        value="{{ $cities->street }}" placeholder="Enter City Code">
                                </div>
                            </div>
                            <!-- /.card-body -->


                        </div>
                        <div class="card-footer">
                            <button type="botton" onclick="performUpdate({{ $cities->id }})"
                                class="btn btn-primary">Update</button>
                            <a href="{{ Route('cities.index') }}" class="btn btn-info">Back to Index</a>
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
        formData.append('country_id', document.getElementById('country_id').value);
        formData.append('name', document.getElementById('name').value);
        formData.append('street', document.getElementById('street').value);
        storeRoute('/cms/admin/cities_update/' + id, formData);
    }
</script>
@endsection
