@if(Article::where('author_id', '=', Auth::user()->id)->count() == 0)
    <div class="alert alert-info" style="margin-top: 0.5em;"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; You have not submitted any content.</div>
    @else
    @foreach ($articles = Article::where('author_id', '=', Auth::user()->id)->orderBy('created_at', 'DESC')->paginate(5) as $article)
    <a href="{{ URL::route('article', array('id' => $article->id, 'stripped_title' => $article->stripped_title)) }}"> 
            <div class="article-badge" style="background-image: url('<?php echo asset($article->getPhoto($article->cover_photo)->mid)?>');">
                <div class="article-info" style="height: auto;">
                <span class="title">{{ $article->title }}</span>
                <span class="desc">{{ $article->description }}</span>
                <span class="date"><b>Posted:</b> {{ $article->author->created_at->format('d/m/Y') }}</span>
                @if($article->status == 1)
                <span class="status"><b>Status:</b> Pending Approval</span>
                @elseif($article->status == 2)
                <span class="status"><b>Status:</b> Under Review</span> 
                @elseif($article->status == 3)
                <span class="status"><b>Status:</b> Rejected</span> 
                @elseif($article->status == 4)
                <span class="status"><b>Status:</b> Approved & Published</span>
                @endif
                @if($article->admin_comments)
                <span class="admin-comments">
                <div class="alert alert-info"><strong>Admin Comments: </strong>{{ nl2br($article->admin_comments) }}</div></span>
                @endif
                </div>
            </div>
            </a>
            @endforeach
            {{ $articles->links() }}
            @endif
<p></p>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete Article</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this article? It will be deleted permanently.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a>
                    <button type="button" class="btn btn-success">OK!</button>
                </a>
            </div>
        </div>
    </div>
</div>