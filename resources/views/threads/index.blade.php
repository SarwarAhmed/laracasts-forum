@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @include('threads._list')

            <div>{{ $threads->appends(request()->input())->links() }}</div>
        </div>

        <div class="col-md-4">
            <div class="card mt-4">
                <div class="card-header">
                    Trending Threads
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach ($trending as $thread)
                            <li class="list-group-item">
                                <a href="{{ url($thread->path) }}">
                                    {{ $thread->title }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
