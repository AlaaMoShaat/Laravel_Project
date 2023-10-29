@extends('cms.parent')

@section('title', 'Index Speciality')

@section('main_title', 'Index Speciality')

@section('sub_title', 'index speciality')

@section('styles')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('specialities.create') }}" type="submit" class="btn btn-success">Add New
                            Speciality</a>
                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Speciality Name</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specialities as $speciality)
                                    <tr>
                                        <td>{{ $speciality->id }}</td>
                                        <td>{{ $speciality->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('specialities.edit', $speciality->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                                <button type="button"
                                                    onclick="performDestroy({{ $speciality->id }} , this)"
                                                    class="btn btn-danger">Delete</button>
                                                <a href="{{ route('specialities.show', $speciality->id) }}" type="button"
                                                    class="btn btn-success">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $specialities->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/specialities/' + id, reference);
        }
    </script>
@endsection
