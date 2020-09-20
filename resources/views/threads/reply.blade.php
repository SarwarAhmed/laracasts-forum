<br>
<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
        <div class="card-header">
            <div class="input-group-append justify-content-between">
                <h5>
                    <a href="{{ route('profile', $reply->owner)}}">{{ $reply->owner->name }}</a> 
                    said {{ $reply->created_at->diffForHumans() }}
                </h5>

                <div>
                    <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                        @csrf

                        <button class="btn btn-secondary btn-sm"
                            type="submit"
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
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-sm btn-primary mr-2" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>

            <div v-else v-text="body">
                <p>{{ $reply->body }}</p>
            </div>
        </div>

        @can ('update', $reply)
            <div class="card-footer input-group-append">
                <button class="btn btn-sm btn-outline-secondary mr-3" @click="editing = true">Edit</button>
                
                <form method="POST" action="/replies/{{ $reply->id }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        @endcan
    </div>
</reply>