@extends('layouts.master')

@section('content')
    @include('includes.message-block')
    <section class="row new-post">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>What do you have to say?</h3></header>
                <form action="{{ route('post.create') }}" method="post">
                    <div class="form-group">
                        <textarea name="body" id="new-post" rows="5" cols="20" placeholder="Enter your post"></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Create Post</button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </form>
        </div>
    </section>
    <section class="row posts">
        <div class="col-md-6 col-md-offset-3">
            <header><h3>Waht other people say...</h3></header>
            @foreach($posts as $post)
            <article class="post" data-postid="{{ $post->id }}">
                <p>{{ $post->body }}</p>
                <div class="info">
                    Posted by {{ $post->user->first_name }} on {{ $post->created_at }}
                </div>
                <div class="interaction">
                    <a href="#">Like</a> |
                    <a href="#">Dislike</a>
                    @if(Auth::user() == $post->user)
                        |
                    <a href="#" class="edit">Edit</a> |
                    <a href="{{ route('post.delete', ['post_id' => $post->id]) }}">Delete</a>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
    </section>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="form-group">
                            <label>Edit the Post</label>
                            <textarea name="post-body" id="post-body" class="form-control" rows="5"></textarea>
                        </div>
                        <input type="">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary modal-save" >Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <script>
        var token = '{{ Session::token() }}';
        var url = '{{ route('edit') }}';
    </script>
@endsection