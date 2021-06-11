@extends('moderator.layouts.app_moderator')

@section('content')
    <div class="container-fluid">
        <main class="container">
            <ul class="headings-ul">
                @foreach($headings as $heading)
                    <li class="headings-li"><a class="headings-li-a" name="{{ $heading->id }}"
                                               href="{{ route('index.search',$heading->id) }}">{{$heading->name}}</a></li>
                @endforeach
            </ul>
            <div class="row row-cols-1">
                @foreach ($articles as $article)
                    <article class="col-md-12">
                        <hr class="tm-hr-primary">
                        <a href="{{ route ('article', [$article->id]) }}" class="effect-lily tm-post-link tm-pt-20">
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
                            <span class="tm-color-primary">{{Counter::show('article',$article->id)}}</span>
                            <span class="tm-color-primary">{{$article->created_at}}</span>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <span>{{count($article->comments)}} comments</span>
                            <span>опубликовано {{$article->user->name}}</span>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="row tm-row tm-mt-100 tm-mb-75">
                <div class="tm-paging-wrapper">
                    <nav class="tm-paging-nav d-inline-block">
                        <ul>
                            <li class="tm-paging-item active">
                                {{ $articles->links() }}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </main>
    </div>

@endsection
