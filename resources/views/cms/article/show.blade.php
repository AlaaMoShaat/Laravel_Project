@extends('cms.parent')

@section('title', 'Show Article')

@section('main_title', 'Show Article')

@section('sub_title', 'show article')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Show Data of Article</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Article Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $articles->title }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="short_description">Short Description</label>
                                    <input type="text" class="form-control" id="short_description"
                                        name="short_description" value="{{ $articles->short_description }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="full_description">Full Description</label>
                                    <textarea class="form-control" style="resize: none;" id="full_description" name="full_description" rows="4"
                                        cols="50" disabled> {{ $articles->full_description }}  </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div>
                                        <img src="{{ asset('storage/images/article/' . $articles->image) }}" width="100"
                                            height="100" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Author Name</label>
                                    <select class="form-control select2" name="author_id" id="author_id"
                                        style="width: 100%;" disabled>
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
                                        style="width: 100%;" disabled>
                                        @foreach ($categories as $category)
                                            <option @if ($category->id == $articles->category_id) selected @endif
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('articles.index') }}" type="submit" class="btn btn-danger">Back To
                                    Index</a>
                            </div>
                    </div>
                    </form>
                </div>
    </section>

@endsection

@section('scripts')

@endsection
