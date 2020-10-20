{{-- Editing the question.--}}
<div class="card" v-if="editing">
    <div class="card-header">
        <div class="input-group-append justify-content-between">

            <input type="text" class="form-control" v-model="form.title">

        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <textarea class="form-control" rows="10" v-model="form.body"></textarea>
        </div>
    </div>

    <div class="card-footer input-group-append">
        <div>
            <button class="btn btn-sm btn-outline-secondary" @click="editing = true" v-show="! editing">Edit</button>
            <button class="btn btn-sm btn-primary mr-2" @click="update">Update</button>
            <button class="btn btn-sm btn-link" @click="resetForm">Cancel</button>
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
                <img src="{{ $thread->creator->avatar_path }}"
                     alt="{{ $thread->creator->name }}"
                     width="25"
                     height="25"
                     class="mr-2"
                >
                <span v-text="title"></span>
            </h5>

        </div>
    </div>

    <div class="card-body">
        <p v-text="body"></p>
    </div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-sm btn-outline-secondary" @click="editing = true">Edit</button>
    </div>
</div>
