@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($threads as $thread)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="input-group-append justify-content-between">
                            <h4 class="mr-auto">
                                <a href="{{ $thread->path() }}">
                                    {{ $thread->title }}
                                </a>
                            </h4>

                            <a href="{{ $thread->path() }}" class="">
                                    {{ $thread->replies_count }}
                                    {{ Str::plural('reply', $thread->replies_count) }}
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <article>
                            <div class="body">{{ $thread->body }}</div>
                        </article>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
