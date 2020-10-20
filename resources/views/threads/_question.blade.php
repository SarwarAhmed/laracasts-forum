{{-- Editing the question.--}}
<div class="card" v-if="editing">
    <div class="card-header">
        <div class="input-group-append justify-content-between">

            <input type="text" class="form-control" value="{{ $thread->title }}">

        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <textarea class="form-control" rows="10">{{ $thread->body }}</textarea>
        </div>
    </div>

    <div class="card-footer input-group-append">
        <div>
            <button class="btn btn-sm btn-outline-secondary" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn btn-sm btn-primary mr-2" @click="">Update</button>
            <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
        </div>

        @can ('update', $thread)
            <form action="{{ $thread->path() }}" method="POST" class="ml-auto">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="btn btn-sm btn-danger"
                >Delete Thread</button>
            </form>
        @endcan
    </div>
</div>

{{-- Viewing the question. --}}
<div class="card" v-else>
    <div class="card-header">
        <div class="input-group-append justify-content-between">

            <h5>
                <img src="{{ $thread->creator->avatar_path }}" alt="{{ $thread->creator->name }}" width="25" height="25" class="mr-2">
                <a href="{{ $thread->path() }}">{{ $thread->title }}</a>
            </h5>

        </div>
    </div>

    <div class="card-body">
        <p>{{ $thread->body }}</p>
    </div>

    <div class="card-footer">
        <button class="btn btn-sm btn-outline-secondary" @click="editing = true">Edit</button>
    </div>
</div>
