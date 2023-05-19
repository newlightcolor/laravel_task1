@extends('layout.common')
 
@section('header')
    @include('layout.header')
@endsection

@section('content')

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <input type="hidden" id="select_page" value="{{$page_nation['select_page']}}">
    
    <div class="diary-container">

        @foreach ($diaries as $diary)
        <div class="card card-diary card-content">
            <div class="diary-image">
                @if($diary->image_url)
                    <img src="{{$diary->image_url}}" class="card-img-top">
                @elseif($diary->local_small_image_path)
                    <img src="{{url('/')}}/{{$diary->local_small_image_path}}" class="card-img-top" alt="{{$diary->image_name}}">
                @else
                    <img src="{{url('/')}}/storage/images/diary_images/default/no_image.png" class="card-img-top" alt="no_image">
                @endif
            </div>
            <div class="card-body">
                <div class="diary-comment">
                    <div class="diary-comment-wrapper">
                        <p>{{$diary->content}}</p>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="diary-created-at">
                        Date: {{$diary->created_at}} 
                    </div>
                    <div class="diary-action-menu">
                        <span class="material-symbols-outlined edit-diary" data-id="{{$diary->id}}">edit</span>
                        <span class="material-symbols-outlined show-diary-detail" data-id="{{$diary->id}}">visibility</span>
                        <span class="material-symbols-outlined delete-diary" data-id="{{$diary->id}}">delete</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    
        <div class="card card-diary card-add-diary add-diary">
            <span class="material-symbols-outlined">
                post_add
            </span>
        </div>
    </div>

    @include('common.page_nation_bar', $page_nation)
    @include('common.add_diary_button')

@endsection


@section('page_script')
    <script>
        $(document).ready(function(){

            //日記詳細
            $('.show-diary-detail').off('click');
            $('.show-diary-detail').on('click', function(){

                let url = '{{url("/")}}/diary/detail/'+$(this).data('id');

                $.ajax({
                    type: "GET",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    }
                }).done(function( data ) {
                    $('#modal-diary-detail').remove();
                    $('body').append(data.modal);
                });
            });

            //日記追加
            $('.add-diary').off('click');
            $('.add-diary').on('click', function(){
                location.href = "diary/create"
            });

            //日記削除
            $('.delete-diary').off('click');
            $('.delete-diary').on('click', function(){

                let url = '{{url("/")}}/diary/'+$(this).data('id');

                $.ajax({
                    type: "DELETE",
                    url: url,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                }).done(function( data ) {
                    select_page = $("#select_page").val();
                    location.href = '{{url("/")}}?&select_page='+select_page;
                });
            });

            //日記編集
            $('.edit-diary').off('click');
            $('.edit-diary').on('click', function(){
                let url = '{{url("/")}}/diary/edit?id='+$(this).data('id');
                location.href = url;
            });

            //日記追加カードの表示切り替え
            toggle_add_diary_card();
            function toggle_add_diary_card(){
                if($('.card-content').length <= 0){
                    $('.card-add-diary').show();
                }else{
                    $('.card-add-diary').hide();
                }
            }
        })
    </script>
@endsection