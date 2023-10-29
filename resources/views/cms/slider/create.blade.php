@extends('cms.parent')

@section('title', 'Create Slider')

@section('main_title', 'Create Slider')

@section('sub_title', 'create slider')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Slider</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Slider Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        placeholder="Enter Name of Slider">
                                </div>
                                <div class="form-group">
                                    <label for="image">Choose Image</label>
                                    <input type="file" class="form-control" id="image" name="image"
                                        placeholder="Enter Image of Slider">
                                </div>
                                <div class="form-group">
                                    <label for="discription">Description of Slider</label>
                                    <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4"
                                        placeholder="Enter Description of Slider " cols="50"> </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="button" onclick="performStore()" class="btn btn-primary">Store</button>
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
        function performStore() {
            let formData = new FormData();
            formData.append('title', document.getElementById('title').value);
            formData.append('image', document.getElementById('image').files[0]);
            formData.append('description', document.getElementById('description').value);
            store('/cms/admin/sliders', formData);
        }
    </script>
@endsection
