@extends('layout.common')

@include('layout.header')

@section('content')
    <h2>Write a diary</h2>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form id="post-diary-form" method="POST" action="{{url('/')}}/diary" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="diary-image" class="form-label">Diary Image</label>
            <input type="file" name="diary_image" class="form-control" id="diary-image">
        </div>
        <img id="image-preview" style="width: 300px;"></div>

        <div class="mb-3">
            <label for="diary-content" class="form-label">Diary Content</label>
            <input type="text" name="diary_content" class="form-control" id="diary-content">
        </div>

        <button type="submit" class="btn btn-default post-diary">
            <span class="material-symbols-outlined">
                done
            </span>
        </button>
    
        <a class="btn btn-default cancel" href="{{url('/')}}">
            <span class="material-symbols-outlined">
                delete
            </span>
        </a>
    </form>
@endsection

@section('page_script')
    <script>
        $(document).ready(function(){

            $('#diary-image').change(function(e){

                var file = e.target.files[0];
                var reader = new FileReader();

                if(file.type.indexOf('image') < 0){
                    alert("画像ファイルを指定してください。");
                    return false;
                }

                reader.onload = (function(file){
                    return function(e){
                        $('#image-preview').attr('src', e.target.result);
                        $('#image-preview').attr('title', file.name);
                    };
                })(file);
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection