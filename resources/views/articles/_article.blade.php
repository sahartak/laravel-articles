<div class="item mb-5">
    <div class="media">
        <img class="mr-3 img-fluid post-thumb d-none d-md-flex" src="{{$article->img}}" alt="image">
        <div class="media-body">
            <h3 class="title mb-1"><a href="{{route('articlePage', ['slug' => $article->slug])}}">{{$article->title}}</a></h3>
            <div class="meta mb-1"><span class="date">Published {{\Illuminate\Support\Carbon::parse($article->created_at)->diffForHumans()}}</span>
                <span class="time"><strong>Views: </strong>{{$article->views}}</span>
                <span class="comment"><strong>Comments: </strong>{{$article->commentsCount()}}</span>
                <span class="comment"><strong>Tags: </strong>{{implode(', ', $article->tagNames())}}</span>
            <div class="intro">{{$article->short_description}}</div>
            <a class="more-link" href="{{route('articlePage', ['slug' => $article->slug])}}">Read more &rarr;</a>
        </div><!--//media-body-->
    </div><!--//media-->
</div><!--//item-->
