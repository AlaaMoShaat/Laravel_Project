@extends('cms.parent')

@section('title', 'Show Slider')

@section('main_title', 'Show Slider')

@section('sub_title', 'show slider')

@section('styles')

@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Show Data of Slider</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Slider Name</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="{{ $sliders->title }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <div>
                                        <img src="{{ asset('storage/images/slider/' . $sliders->image) }}" width="100"
                                            height="100" alt="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="discription">Description of Slider</label>
                                    <textarea class="form-control" style="resize: none;" id="description" name="description" rows="4" cols="50"
                                        disabled> {{ $sliders->description }} </textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('sliders.index') }}" type="submit" class="btn btn-danger">Go Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

@endsection

@section('scripts')

@endsection
