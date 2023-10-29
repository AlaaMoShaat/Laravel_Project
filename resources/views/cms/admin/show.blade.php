@extends('cms.parent')

@section('title', 'Show City')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Show City')
@section('sub_title', 'show city')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Show Data City</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">City Name</label>
                  <input type="text" class="form-control" disabled id="name" name="name" value="{{ $cities->name }}" placeholder="Enter City Name">
                </div>
                <div class="form-group">
                  <label for="street">City Street</label>
                  <input type="text" class="form-control" disabled id="street" name="street" value="{{ $cities->street }}" placeholder="Enter City Street">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
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

@endsection
