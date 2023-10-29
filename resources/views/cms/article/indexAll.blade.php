@extends('cms.parent')

@section('title', 'Index Article')

@section('main_title', 'Index Article')

@section('sub_title', 'index article')

@section('styles')

@endsection

@section('content')
    <div class="row" style="margin: 0">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
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
                                <th>Article Name</th>
                                <th>Short Description</th>
                                <th>Author Name</th>
                                <th>Categoy</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $article)
                                <tr>
                                    <td>{{ $article->id }}</td>
                                    <td>
                                        <img class="img-circle img-bordered-sm"
                                            src="{{ asset('storage/images/article/' . $article->image) }}" width="60"
                                            height="60" alt="User Image">
                                    </td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->short_description }}</td>
                                    <td><span class="badge bg-info">({{ $article->author->user->firstname }})</span></td>
                                    <td><span class="badge bg-info">({{ $article->category->name }})</span></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" onclick="performDestroy({{ $article->id }} , this)"
                                                class="btn btn-danger">Delete</button>
                                            <a href="{{ route('articles.show', $article->id) }}" type="button"
                                                class="btn btn-success">Show</a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $articles->links() }}
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/articles/' + id, reference);
        }
    </script>
@endsection
