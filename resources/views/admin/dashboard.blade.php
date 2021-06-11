@extends('admin.layouts.app_admin')

@section('content')
    <div class="container">
        <div class="col-sm-6">
            <div class="jumbotron">
                <form action="{{ route('admin.heading')}}" id="upload_heading" method="post">
                    @csrf
                    <div class="mb-4">
                        <input class="form-control" name="name">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-block btn-secondary">Создать категорию</button>
                    </div>
                </form>
            </div>
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
            <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
            <script>
                $(document).ready(function () {
                    $('#upload_heading').validate({
                        rules: {
                            name: {
                                required: true
                            }
                        }
                    });
                });
                jQuery.extend(jQuery.validator.messages, {
                    required: "Это поле обязательно"
                });
            </script>
        </div>
    </div>
    </div>
@endsection
