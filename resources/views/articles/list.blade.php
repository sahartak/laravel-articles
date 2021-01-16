@extends('layouts.app')

<div class="main-wrapper">
    <section class="blog-list px-3 py-5 p-md-5">
        <div class="container">
            @foreach($articles as $article)
                @include('articles._article')
            @endforeach
            <br>
                {{ $articles->links() }}
        </div>
    </section>
</div><!--//main-wrapper-->
