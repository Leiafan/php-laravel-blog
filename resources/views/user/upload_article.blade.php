@extends('layouts.app')

@section('content')
    <div class="container">
        <main class="container">
            <div class="alert alert-success d-none" id="msg_div">
                <span id="res_message"></span>
            </div>
            <form action="{{ route('user.upload') }}" method="post" id="upload_form" role="form" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Заголовок статьи</h2>
                        <input type="text" name="title" id="title">
                    </div>
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Краткое описание</h2>
                        <input type="text" name="description" id="description">
                    </div>
                    <input type="hidden" name="user_id" id="user_id" value="{{Auth::id()}}">
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Текст статьи</h2>
                        <textarea class="form-control" name="text" id="text"></textarea>
                    </div>
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Фото</h2>
                        <input type="file" name="file" id="file">
                    </div>
                    <br/>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success" id="create_article_button">Отправить</button>
                    </div>
                </div>
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#upload_form').validate({
                    rules: {
                        title: {
                            required: true,
                            rangelength: [1, 10]
                        },
                        description: {
                            required: true,
                            rangelength: [1, 30]
                        },
                        user_id: {
                            required: true
                        },
                        text: {
                            required: true,
                            rangelength: [2, 10000]
                        },
                        file: {
                            required: true,
                            accept: "png,jpe?g,gif"
                        }
                    },
                    {{--submitHandler: function () {--}}
                    {{--    var title = $('#title').val();--}}
                    {{--    var description = $('#description').val();--}}
                    {{--    var user_id = $('#user_id').val();--}}
                    {{--    var text = $('#text').val();--}}
                    {{--    var file = $('#file').val();--}}
                    {{--    $.ajaxSetup({--}}
                    {{--        headers: {--}}
                    {{--            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
                    {{--        }--}}
                    {{--    });--}}
                    {{--    $('#upload_form').html('Отправка..');--}}
                    {{--    $.ajax({--}}
                    {{--        url: "{{ route('user.upload') }}",--}}
                    {{--        method: "POST",--}}
                    {{--        cache: false,--}}
                    {{--        data: {--}}
                    {{--            _token: $("#csrf").val(),--}}
                    {{--            type: 1,--}}
                    {{--            title: title,--}}
                    {{--            description: description,--}}
                    {{--            user_id: user_id,--}}
                    {{--            text: text,--}}
                    {{--            file: file--}}
                    {{--        },--}}
                    {{--        success: function (response) {--}}
                    {{--            $('#upload_form').html('Статья отправлена на рассмотрение');--}}
                    {{--            $('#res_message').show();--}}
                    {{--            console.log(response);--}}

                    {{--            document.getElementById('upload_form').reset();--}}
                    {{--            $('#upload_form').load(' #upload_form', {}, function () {--}}
                    {{--            });--}}
                    {{--            setTimeout(function () {--}}
                    {{--                $('#res_message').hide();--}}
                    {{--            }, 5000);--}}
                    {{--        }--}}
                        })
            })
            jQuery.extend(jQuery.validator.messages, {
                required: "Это поле обязательно",
                rangelength: jQuery.validator.format("Длина сообщения должна быть в пределах {0} - {1} символов."),
                accept: "Неподдерживаемый формат"
            })
        </script>
    </div>
@endsection
