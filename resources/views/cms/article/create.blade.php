@extends('cms.parent')

@section('title', 'Create Article')

@section('main_title', 'Create Article')

@section('sub_title', 'create article')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Article</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Article Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Name of Article">
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <input type="text" class="form-control" id="short_description"
                                        name="short_description" placeholder="Enter Short Description">
                                </div>
                                <div class="form-group">
                                    <label for="full_description">Full Description</label>
                                    <textarea class="form-control" style="resize: none;" id="full_description" name="full_description" rows="4"
                                        placeholder="Enter Full Description" cols="50"> </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter Image of Article">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="author_id" id="author_id" value="{{ $id }}"
                                        class="form-control form-control-solid" hidden />
                                </div>
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <select class="form-control select2" name="category_id" id="category_id"
                                        style="width: 100%;">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
                                <a href="{{ route('indexArticle', $id) }}" type="submit" class="btn btn-danger">Back
                                    To Index</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('scripts')
    <script>
        function performStore() {
            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('short_description', document.getElementById('short_description').value);
            formData.append('full_description', document.getElementById('full_description').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('author_id', document.getElementById('author_id').value);
            formData.append('category_id', document.getElementById('category_id').value);
            store('/cms/admin/articles', formData);
        }
    </script>
@endsection
