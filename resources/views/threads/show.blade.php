@extends('layouts.app')

@section('content')
<thread-view :initial-replies-count="{{ $thread->replies_count }}" inline-template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="input-group-append justify-content-between">
                            <h5>
                                <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
                            </h5>

                            @can ('update', $thread)
                                <form action="{{ $thread->path() }}" method="POST">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        class="btn btn-sm btn-danger"
                                    >Delete Thread</button>
                                </form>
                            @endcan
                        </div>
                    </div>

                    <div class="card-body">
                        <p>{{ $thread->body }}</p>
                    </div>
                </div>

                <replies :data="{{ $thread->replies }}"
                     @added="repliesCount++"
                     @removed="repliesCount--"
                ></replies>

    {{--            <div class="pt-4">{{ $replies->links() }}</div>--}}

            </div>

            <div class="col-md-4">
                <div class="card">

                    <div class="card-body">
                        <p>
                            This thread was published
                            {{ $thread->created_at->diffForHumans() }} by
                            <a href="{{ route('profile', $thread->creator)}}">{{ $thread->creator->name }}</a>,
                            and currently has
                            <span v-text="repliesCount"></span>
                            {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</thread-view>
@endsection
