@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <a href="#">{{ $thread->creator->name }}</a> posted: {{ $thread->created_at->diffForHumans() }}
                    <h5>{{ $thread->title }}</h5>
                </div>

                <div class="card-body">
                    <p>{{ $thread->body }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($thread->replies as $reply)
                @include('threads.reply')
            @endforeach
        </div>
    </div>
    
    @auth
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <form method="POST" action="{{ $thread->path() . '/replies' }}">
                    @csrf

                    <div class="form">
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5"></textarea>
                    </div>

                    <button type="submit" class="mt-2 btn btn-outline-primary">Post</button>
                </form>
            </div>
        </div>
    @else 
        <p class="text-center pt-2">Please <a href="{{ route('login') }}">Sign in</a> to participate to this discussion.</p>
    @endauth
</div>
@endsection
