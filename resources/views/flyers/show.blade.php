@extends('layout')

@section('content')

    <div class="row">
        <div class="col-md-4"></div>

        <h1>{!! $flyer->street !!}</h1>
        <h2>{!! $flyer->price !!}</h2>

        <hr>

        <div class="description">{!! nl2br($flyer->description) !!}</div>

        <div class="col-md-8 gallery">
            @foreach($flyer->photos->chunk(4) as $set)
                <div class="row">
                    @foreach($set as $photo)
                        <div class="col-md-3 gallery_image">
                            <img src="/{{ $photo->thumbnail_path }}" alt="This is an image">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>

    <hr>

    <h2>Add your photos</h2>

    <form id="addPhotosForm" action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" method="post" class="dropzone">
        {{ csrf_field() }}
    </form>
@stop

@section('scripts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

    <script>
        Dropzone.options.addPhotosForm = {
            paramName : 'photo' ,
            maxFileSize : 5,
            acceptedFiles : '.jpg, .jpeg, .png, .bmp'
        };
    </script>
@stop