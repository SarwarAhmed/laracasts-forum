@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @forelse ($threads as $thread)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="input-group-append justify-content-between">
                            <h4 class="mr-auto">
                                <a href="{{ $thread->path() }}">
                                    @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))

                                        <strong>
                                            {{ $thread->title }}
                                        </strong>
                                    @else
                                        {{ $thread->title }}
                                    @endif
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
            @empty
                <div class="card">
                    <p class="card-header">Threre are no relavant results at this time.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
