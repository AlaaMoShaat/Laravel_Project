@extends('cms.parent')

@section('title', 'Show Country')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Show Country')
@section('sub_title', 'show country')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Show Data Country</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form>
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Country Name</label>
                  <input type="text" class="form-control" disabled id="name" name="name" value="{{ $countries->name }}" placeholder="Enter Country Name">
                </div>
                <div class="form-group">
                  <label for="code">Country Code</label>
                  <input type="text" class="form-control" disabled id="code" name="code" value="{{ $countries->code }}" placeholder="Enter Country Code">
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
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

@endsection
