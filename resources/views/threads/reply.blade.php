<br>
<div class="card">
    <div class="card-header">
        <div class="input-group-append justify-content-between">
            <h5>
                <a href="#">{{ $reply->owner->name }}</a> 
                said {{ $reply->created_at->diffForHumans() }}
            </h5>

            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    @csrf

                    <button class="btn btn-secondary btn-sm"
                        {{ $reply->isFavorited() ? 'disabled' : '' }}
                    >
                        {{ $reply->favorites_count }}
                        {{ Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="card-body">
        <p>{{ $reply->body }}</p>
    </div>
</div>