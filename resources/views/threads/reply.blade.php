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
                    <favorite :reply="{{ $reply }}"></favorite>
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
                <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
            </div>
        @endcan
    </div>
</reply>