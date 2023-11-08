@extends('cms.parent')

@section('title', 'Index Admin')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Index Admin')
@section('sub_title', 'index admin')


<section class="content">
    <div class="container-fluid">

        <!-- /.row -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        @can('Create Admin')
                            <a href="{{ Route('admins.create') }}" class="btn btn-success">Add New Admin</a>
                        @endcan
                        <div class="card-tools">
                            <form action="{{ Route('admins.index') }}">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
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
                                    <th>Setting</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($admins as $admin)
                                    <tr>
                                        <td>{{ $admin->id }}</td>
                                        <td>
                                            <img width="50px" height="50px" class="img-circle img-bordered-sm"
                                                src="{{ asset('storage/images/admin/' . $admin->user->image) }}"
                                                alt="">
                                        </td>
                                        <td>{{ $admin->user->firstname . ' ' . $admin->user->lastname }}</td>
                                        {{-- <td>{{ $admin->user->lastname ?? '' }}</td> --}}
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->user->gender ?? '' }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $admin->user->status == 'active' ? 'success' : 'info' }}">
                                                {{ $admin->user->status ?? '' }}
                                            </span>
                                        </td>
                                        <td><span class="badge bg-info">({{ $admin->user->city->name ?? '' }})</span>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                {{-- @can('Edit Admin')
                                                    <a href="{{ Route('admins.edit', $admin->id) }}" type="button"
                                                        class="btn btn-info">Edit</a>
                                                @endcan --}}
                                                @can('Delete Admin')
                                                    <button type="button"
                                                        onclick="performDestroy({{ $admin->id }}, this)"
                                                        class="btn btn-danger">Delete</button>
                                                @endcan
                                                {{-- <a href="{{ Route('admins.show', $admin->id) }}" type="button"
                                                    class="btn btn-success">Show</a> --}}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="m-auto">{{ $admins->links() }}</div>
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
        confirmDestroy('/cms/admin/admins/' + id, reference);
    }
</script>
@endsection
