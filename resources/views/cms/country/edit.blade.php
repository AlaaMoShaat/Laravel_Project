@extends('cms.parent')

@section('title', 'Edit Country')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Edit Country')
@section('sub_title', 'edit country')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Data Country</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Country Name</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $countries->name }}" placeholder="Enter Country Name">
                </div>
                <div class="form-group">
                  <label for="code">Country Code</label>
                  <input type="text" class="form-control" id="code" name="code" value="{{ $countries->code }}" placeholder="Enter Country Code">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="botton" onclick="performUpdate({{ $countries->id }})" class="btn btn-primary">Update</button>
                <a href="{{ Route('countries.index') }}" class="btn btn-info">Back to Index</a>
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
        formData.append('name', document.getElementById('name').value);
        formData.append('code', document.getElementById('code').value);
        storeRoute('/cms/admin/countries_update/'+id, formData);
    }
</script>
@endsection
