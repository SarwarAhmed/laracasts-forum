@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="input-group-append justify-content-between">
                        <h5>{{ $thread->title }}</h5>

                        @auth()
                            <form action="{{ $thread->path() }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" 
                                    class="btn btn-sm btn-danger"
                                >Delete Thread</button>
                            </form>
                        @endauth
                    </div>
                </div>

                <div class="card-body">
                    <p>{{ $thread->body }}</p>
                </div>
            </div>

            @foreach ($replies as $reply)
                @include('threads.reply')
            @endforeach

            <div class="pt-4">{{ $replies->links() }}</div>

            @auth
                <form method="POST" 
                    action="{{ $thread->path() . '/replies' }}"
                    class="pt-4"
                >
                    @csrf

                    <div class="form">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    </div>

                    <button type="submit" class="mt-2 btn btn-outline-primary">Post</button>
                </form>
            @else 
                <p class="text-center pt-2">Please <a href="{{ route('login') }}">Sign in</a> to participate to this discussion.</p>
            @endauth
        </div>

        <div class="col-md-4">
            <div class="card">

                <div class="card-body">
                    <p>
                        This thread was published 
                        {{ $thread->created_at->diffForHumans() }} by
                        <a href="{{ route('profile', $thread->creator)}}">{{ $thread->creator->name }}</a>, 
                        and currently has 
                        {{ $thread->replies_count }} 
                        {{ Str::plural('comment', $thread->replies_count) }}.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
