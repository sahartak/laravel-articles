@extends('layouts.app')

<div class="main-wrapper">

    <article class="blog-post px-3 py-5 p-md-5">
        <div class="container">
            <div class="blog-post-header">
                <h2 class="title mb-2">{{$article->title}}</h2>
                <div class="meta mb-3">
                    <div class="meta mb-1"><span class="date">Published {{\Illuminate\Support\Carbon::parse($article->created_at)->diffForHumans()}}</span>
                        <span class="comment"><strong>Comments: </strong>{{$article->commentsCount()}}</span>
                        <span class="comment"><strong>Tags: </strong>{{implode(', ', $article->tagNames())}}</span>
                </div>
            </div>
                <form method="post"  id="likeForm" class="col-md-4">
                    {{ csrf_field() }}
                    <input type="hidden" name="article_id" value="{{$article->id}}">
                    <button class="btn btn-success" id="like">Likes <span id="likesCount">{{$article->likes}}</span></button>
                </form>
                <form method="post"  id="viewForm"  class="col-md-4">
                    {{ csrf_field() }}
                    <input type="hidden" name="article_id" value="{{$article->id}}">
                    <p id="view">Views <span id="viewsCount">{{$article->views}}</span></p>
                </form>
            <div class="blog-post-body">
                <figure class="blog-banner">
                    <img class="img-fluid" src="{{$article->bg_img}}" alt="image">
                </figure>
                {{$article->description}}
            </div><!--//blog-comments-section-->

        </div><!--//container-->
    </article>

    @include('articles._comment-form')

</div><!--//main-wrapper-->
