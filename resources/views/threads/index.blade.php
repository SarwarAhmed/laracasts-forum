@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Forum Thread</div>

                <div class="card-body">
                    @foreach ($threads as $thread)
                        <article>
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
                            
                            <div class="body">{{ $thread->body }}</div>
                        </article>

                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
