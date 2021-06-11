@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <main class="container">
            <form action="{{ route('user.upload')}}" class="mb-5 tm-comment-form" id="upload_article" method="post" enctype="multipart/form-data">
                @csrf
                <div class="container">
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Заголовок статьи</h2>
                        <input type="text" name="title">
                    </div>
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Краткое описание</h2>
                        <input type="text" name="description">
                    </div>
                    <input type="hidden" name="user_id" value="{{Auth::id()}}">
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Текст статьи</h2>
                        <textarea class="form-control" name="text"></textarea>
                    </div>
                    <div class="col-md-12">
                        <h2 class="tm-color-primary tm-post-title mb-4">Фото</h2>
                        <input type="file" name="file">
                    </div>
                    <br/>
                    <div class="col-md-12">
                        <button class="tm-btn tm-btn-primary tm-btn-small">Отправить</button>
                    </div>
                </div>
            </form>
        </main>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#upload_article').validate({
                    rules: {
                        title: {
                            required: true,
                            rangelength: [5,10]
                        },
                        description: {
                            required: true,
                            rangelength: [10,30]
                        },
                        user_id: {
                            required: true
                        },
                        text: {
                            required: true,
                            rangelength: [20,10000]
                        },
                        file: {
                            required: true,
                            accept: "png,jpe?g,gif"
                        }
                    }
                });
            });
            jQuery.extend(jQuery.validator.messages, {
                required: "Это поле обязательно",
                rangelength: jQuery.validator.format("Длина сообщения должна быть в пределах {0} - {1} символов."),
                accept: "Неподдерживаемый формат"
            });
        </script>
    </div>
@endsection
