@extends ('layouts.app')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                <h1>
                    {{ $profileUser->name }}
                    <small>Since {{ $profileUser->created_at->diffForHumans() }}</small>
                </h1>
            </div>

            @foreach ($threads as $thread)
                <div class="card mt-4">
                    <div class="card-header">
                        <div class="input-group-append justify-content-between">
                            <span>
                                <a href="#">{{ $thread->creator->name }}</a> posted: 
                                {{ $thread->title }}
                            </span>

                            <span>
                                {{ $thread->created_at->diffForHumans() }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <p>{{ $thread->body }}</p>
                    </div>
                </div>
            @endforeach

            <div class="mt-4">
                {{ $threads->links() }}
            </div>
        </div>
    </div>
</div>
@endsection