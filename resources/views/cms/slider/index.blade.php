@extends('cms.parent')

@section('title', 'Index Slider')

@section('main_title', 'Index Slider')

@section('sub_title', 'index slider')

@section('styles')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('sliders.create') }}" type="submit" class="btn btn-success">Add New Slider</a>
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
                                    <th>Image</th>
                                    <th>Slider Name</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->id }}</td>
                                        <td>
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/images/slider/' . $slider->image) }}" width="60"
                                                height="60" alt="Slider Image">
                                        </td>
                                        <td>{{ $slider->title }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('sliders.edit', $slider->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                                <button type="button" onclick="performDestroy({{ $slider->id }} , this)"
                                                    class="btn btn-danger">Delete</button>
                                                <a href="{{ route('sliders.show', $slider->id) }}" type="button"
                                                    class="btn btn-success">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $sliders->links() }}</div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/sliders/' + id, reference);
        }
    </script>
@endsection
