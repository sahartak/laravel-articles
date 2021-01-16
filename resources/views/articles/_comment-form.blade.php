<form method="post"  id="comment_form">
    {{ csrf_field() }}
    <div class="card border-primary rounded-0 padding30">
        <div class="card-header p-0">
            <div class="bg-info text-white text-center py-2">
                <h3> Add comment</h3>
            </div>
        </div>
        <div class="card-body p-3">
            <input type="hidden" name="article_id" value="{{$article->id}}">
            <!--Body-->
            <div class="form-group">
                <div class="input-group mb-2">
                    <input type="text" class="form-control" name="subject" placeholder="Subject*" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group mb-2">
                    <textarea name="body" class="form-control" placeholder="Body*" required></textarea>
                </div>
            </div>

            <div class="text-center">
                <input type="submit" class="btn btn-info btn-block rounded-0 py-2">
            </div>
        </div>

    </div>
</form>

<div id="comment_info"></div>
