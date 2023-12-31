@extends('cms.parent')

@section('title', 'Index Author')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Index Author')
@section('sub_title', 'index author')


<section class="content">
    <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @can('Create Author')
                            <a href="{{ Route('authors.create') }}" class="btn btn-success">Add New Author</a>
                        @endcan
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
                                    <th>Image</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>City</th>
                                    <th>Articles</th>
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($authors as $author)
                                    <tr>
                                        <td>{{ $author->id }}</td>
                                        <td>
                                            <img width="50px" height="50px" class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/images/author/' . $author->user->image) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $author->user->firstname . ' ' . $author->user->lastname }}</td>
                                        {{-- <td>{{ $author->user->lastname ?? '' }}</td> --}}
                                        <td>{{ $author->email }}</td>
                                        <td>{{ $author->user->gender ?? '' }}</td>
                                        <td>{{ $author->user->status ?? '' }}</td>
                                        <td><span class="badge bg-info">({{ $author->user->city->name ?? '' }})</span>
                                        </td>
                                        <td><a href="{{ route('indexArticle', ['id' => $author->id]) }}"
                                                class="btn btn-info">({{ $author->articles_count }})
                                                article/s</a> </td>
                                        <td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ Route('authors.edit', $author->id) }}" type="button"
                                                    class="btn btn-info">Edit</a>
                                                <button type="button"
                                                    onclick="performDestroy({{ $author->id }}, this)"
                                                    class="btn btn-danger">Delete</button>
                                                {{-- <a href="{{ Route('authors.show', $author->id) }}" type="button"
                                                    class="btn btn-success">Show</a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $authors->links() }}</div>
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
        confirmDestroy('/cms/admin/authors/' + id, reference);
    }
</script>
@endsection
