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