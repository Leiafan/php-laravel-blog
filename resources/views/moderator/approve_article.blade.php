@extends('moderator.layouts.app_moderator')

@section('content')
    <div class="container">
        <div class="row row-cols-1">
            @foreach ($articles as $article)
                <article class="col-md-12">
                    <hr class="tm-hr-primary">
                    <a href="{{ route ('moderator.article', [$article->id]) }}" class="effect-lily tm-post-link tm-pt-20">
                        <div class="tm-post-link-inner">
                            <img src="/{{$article->image}}"
                                 alt="Image" class="img-fluid" style="width: 500px;">
                        </div>
                        <h2 class="tm-pt-30 tm-color-primary tm-post-title">{{$article->title}}</h2>
                    </a>
                    <p class="tm-pt-30">
                        {{$article->description}}
                    </p>
                    <div class="d-flex justify-content-between tm-pt-45">
                        <span class="tm-color-primary">{{$article->created_at}}</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <span>{{count($article->comments)}} comments</span>
                        <span>by {{$article->user->name}}</span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
@endsection
