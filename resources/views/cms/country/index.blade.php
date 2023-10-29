@extends('cms.parent')

@section('title', 'Index Country')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Index Country')
@section('sub_title', 'index country')


<section class="content">
    <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @can('Create Country')
                            <a href="{{ Route('countries.create') }}" class="btn btn-success">Add New Country</a>
                        @endcan
                        <div class="card-tools">
                            {{-- <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div> --}}
                        </div>
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Country Name</th>
                                    <th>Code</th>
                                    <th>Number Of Cities</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($countries as $country)
                                    <tr>
                                        <td>{{ $country->id }}</td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->code }}</td>
                                        <td><span class="badge bg-info">({{ $country->cities_count }})</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ Route('countries.edit', $country->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                                <button type="button"
                                                    onclick="performDestroy({{ $country->id }}, this)"
                                                    class="btn btn-danger">Delete</button>
                                                <a href="{{ Route('countries.show', $country->id) }}" type="button"
                                                    class="btn btn-success">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $countries->links() }}</div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.row -->

    </div><!-- /.container-fluid -->
</section>

@endsection


@section('scripts')
<script>
    function performDestroy(id, reference) {
        confirmDestroy('/cms/admin/countries/' + id, reference);
    }
</script>
@endsection
