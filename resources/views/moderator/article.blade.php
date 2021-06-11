@extends('moderator.layouts.app_moderator')

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
                    </div>
                </div>
            </div>
        </div>
        <form action="{{ route('moderator.moderate', $article->id)}}" class="mb-5 tm-comment-form" method="post">
            <div class="text-center">
                @csrf
                <button class="btn-secondary" name="approve" value="{{$article->id}}">Опубликовать</button>
                <button class="btn-outline-danger" name="delete" value="{{$article->id}}">Удалить</button>
            </div>
        </form>
    </div>
@endsection
