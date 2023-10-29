@extends('cms.parent')

@section('title', 'Edit Category')


@section('styles')

@endsection


@section('content')

@section('main_title', 'Edit Category')
@section('sub_title', 'edit categories')

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data Category</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input value="{{ $categories->name }}" type="text" class="form-control"
                                    id="name" name="name" placeholder="Enter Category Name">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select class="form-select form-select-sm" name="status" id="status"
                                    aria-label=".form-select-sm example">
                                    <option selected>{{ $categories->status }}</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">InActive</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="description">Category Description</label>
                                <textarea type="text" class="form-control" id="description" name="description"
                                    placeholder="Enter Category Description">{{ $categories->description }}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="botton" onclick="performUpdate({{ $categories->id }})"
                                class="btn btn-primary">Update</button>
                            <a href="{{ Route('categories.index') }}" class="btn btn-info">Back to Index</a>

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
<script>
    function performUpdate(id) {
        let formData = new FormData();
        formData.append('name', document.getElementById('name').value);
        formData.append('status', document.getElementById('status').value);
        formData.append('description', document.getElementById('description').value);
        storeRoute('/cms/admin/categories_update/' + id, formData);
    }
</script>
@endsection
