@extends('cms.parent')

@section('title', 'Edit Slider')

@section('main_title', 'Edit Slider')

@section('sub_title', 'edit slider')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Slider</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Slider Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $sliders->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="image">Choose Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        value="{{ $sliders->image }}">
                                </div>
                                <div class="form-group">
                                    <label for="discription">Description of Slider</label>
                                    <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4" cols="50"> {{ $sliders->description }} </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="performUpdate({{ $sliders->id }})"
                                    class="btn btn-primary">Update</button>
                                <a href="{{ route('sliders.index') }}" type="submit" class="btn btn-danger">Go Back</a>
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
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('description', document.getElementById('description').value);
            storeRoute('/cms/admin/sliders_update/' + id, formData);
        }
    </script>
@endsection
