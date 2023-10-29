@extends('cms.parent')

@section('title', 'Edit Article')

@section('main_title', 'Edit Article')

@section('sub_title', 'edit article')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Article</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Article Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $articles->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <input type="text" class="form-control" id="short_description"
                                        name="short_description" value="{{ $articles->short_description }}">
                                </div>
                                <div class="form-group">
                                    <label for="full_description">Full Description</label>
                                    <textarea class="form-control" style="resize: none;" id="full_description" name="full_description" rows="4"
                                        cols="50"> {{ $articles->full_description }}  </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ $articles->image }}">
                                </div>
                                <div class="form-group">
                                    <label>Author Name</label>
                                    <select class="form-control select2" name="author_id" id="author_id"
                                        style="width: 100%;">
                                        @foreach ($authors as $author)
                                            <option @if ($author->id == $articles->author_id) selected @endif
                                                value="{{ $author->id }}">
                                                {{ $author->user->firstname . ' ' . $author->user->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Category Name</label>
                                    <select class="form-control select2" name="category_id" id="category_id"
                                        style="width: 100%;">
                                        @foreach ($categories as $category)
                                            <option @if ($category->id == $articles->category_id) selected @endif
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="button" onclick="performUpdate({{ $articles->id }})"
                                    class="btn btn-primary">Update</button>
                                <a href="{{ route('articles.index') }}" type="submit" class="btn btn-danger">Go Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('scripts')
    <script>
        function performUpdate(id) {
            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('short_description', document.getElementById('short_description').value);
            formData.append('full_description', document.getElementById('full_description').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('author_id', document.getElementById('author_id').value);
            formData.append('category_id', document.getElementById('category_id').value);
            storeRoute('/cms/admin/articles_update/' + id, formData);
        }
    </script>
@endsection
