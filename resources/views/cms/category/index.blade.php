@extends('cms.parent')

@section('title', 'Index Category')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Index Category')
@section('sub_title', 'index category')


<section class="content">
    <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ Route('categories.create') }}" class="btn btn-success">Add New Category</a>
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
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    {{-- <th>Description</th> --}}
                                    <th>Status</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ $category->id }}</td>
                                        <td>{{ $category->name }}</td>
                                        {{-- <td>{{ $category->description }}</td> --}}
                                        <td>
                                            <span
                                                class="badge bg-{{ $category->status == 'active' ? 'success' : 'info' }}">
                                                {{ $category->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ Route('categories.edit', $category->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                                <button type="button"
                                                    onclick="performDestroy({{ $category->id }}, this)"
                                                    class="btn btn-danger">Delete</button>
                                                <a href="{{ Route('categories.show', $category->id) }}" type="button"
                                                    class="btn btn-success">Show</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $categories->links() }}</div>
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
        confirmDestroy('/cms/admin/categories/' + id, reference);
    }
</script>
@endsection
