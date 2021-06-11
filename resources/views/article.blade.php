@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row tm-row">
            <div class="col-lg-8 tm-post-col">
                <div class="tm-post-full">
                    <div class="mb-4">
                        <h2 class="pt-2 tm-color-primary tm-post-title">{{$article->title}}</h2>
                        <div class="col-12">
                            <hr class="tm-hr-primary tm-mb-55">
                            <img
                                src="/{{$article->image}}"
                                alt="Image" class="img-fluid" style="width: 500px;">
                        </div>
                        <p class="tm-mb-40">{{$article->created_at}}, опубликовано
                            пользователем {{$article->user->name}}</p>
                        <p>
                        {{$article->description}}
                        <p>
                            {{$article->text}}
                        </p>
                        <span class="d-block text-left tm-color-primary">
                            @foreach($article->headings as $heading)
                                #{{$heading->name}}
                            @endforeach
                        </span>
                        <span
                            class="d-block text-right tm-color-primary">{{Counter::showAndCount('article', $article->id)}}</span>
                    </div>

                    <!-- Comments -->

                    <div id="comment_list">
                        <h2 class="tm-color-primary tm-post-title">Комментарии</h2>
                        @foreach ($article->comments as $comment)
                            <hr class="tm-hr-primary tm-mb-45">
                            <div class="tm-comment tm-mb-45" id="end_form">
                                <figure class="tm-comment-figure">
                                    <figcaption
                                        class="tm-color-primary text-center">{{$comment->user->name}}</figcaption>
                                </figure>
                                <div>
                                    <p>
                                        {{$comment->text}}
                                    </p>
                                    <div class="d-flex justify-content-between" style="margin-top: 60px;width: 470px;">
                                        <a href="#" class="tm-color-primary">Ответить</a>
                                        <a href="#" class="tm-color-primary"
                                           style="float: right;margin-left: 20%;">{{$comment->created_at}}</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @guest
                            <a href="{{ route('login') }}">{{ __('Войдите, чтобы оставить комментарий') }}</a>
                        @endguest
                        @auth
                            <div class="alert alert-success d-none" id="msg_div">
                                <span id="res_message"></span>
                            </div>
                            <form action="javascript:void(0)" method="post" id="comment_form" role="form">
                                @csrf
                                <input type="hidden" name="article_id" id="article_id" value="{{$article->id}}">
                                <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                                <div class="mb-4">
                                    <label for="text" class="tm-color-primary tm-post-title mb-4">Ваш
                                        комментарий</label>
                                    <textarea class="form-control" name="text" id="text" rows="6"></textarea>
                                </div>
                                <div class="text-right">
                                    <button type="submit"
                                            class="btn btn-success"
                                            id="create_comment_button">Отправить
                                    </button>
                                </div>
                            </form>
                        @endauth
                    </div>
                    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
                    <script>
                        $(document).ready(function () {
                            $('#comment_form').validate({
                                rules: {
                                    article_id: {
                                        required: true
                                    },
                                    user_id: {
                                        required: true
                                    },
                                    text: {
                                        required: true,
                                        rangelength: [5, 200]
                                    }
                                },
                                submitHandler: function () {
                                    var article_id = $('#article_id').val();
                                    var user_id = $('#user_id').val();
                                    var text = $('#text').val();
                                    $.ajaxSetup({
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        }
                                    });
                                    $('#comment_form').html('Отправка..');
                                    $.ajax({
                                        url: "{{ route('comment.store') }}",
                                        method: "POST",
                                        dataType: 'json',
                                        cache: false,
                                        data: {
                                            _token: $("#csrf").val(),
                                            type: 1,
                                            article_id: article_id,
                                            user_id: user_id,
                                            text: text
                                        },
                                        success: function (response) {
                                            $('#create_comment_button').html('Отправить');
                                            $('#res_message').show();
                                            $('#res_message').html(response.msg);

                                            document.getElementById('comment_form').reset();
                                            $('#comment_list').load(' #comment_list', {}, function () {});
                                            setTimeout(function () {
                                                $('#res_message').hide();
                                            }, 5000);
                                        }
                                    })
                                }
                            })
                        })
                        jQuery.extend(jQuery.validator.messages, {
                            required: "Это поле обязательно",
                            rangelength: jQuery.validator.format("Длина сообщения должна быть в пределах {0} - {1} символов.")
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
