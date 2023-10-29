@extends('cms.parent')

@section('title', 'Index Comment')

@section('main_title', 'Index Comment')

@section('sub_title', 'index comment')

@section('styles')

@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
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
                                    <th>Comment</th>
                                    <th>Article Name</th>
                                    <th>Viewer Name</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->id }}</td>
                                        <td>{{ $comment->comment }}</td>
                                        <td>{{ $comment->article->title }}</td>
                                        <td>{{ $comment->viewer->user->first_name . ' ' . $comment->viewer->user->last_name }}
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" onclick="performDestroy({{ $comment->id }} , this)"
                                                    class="btn btn-danger">Delete</button>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $comments->links() }}</div>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/comments/' + id, reference);
        }
    </script>
@endsection
