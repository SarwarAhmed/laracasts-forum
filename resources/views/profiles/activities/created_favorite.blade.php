@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} 
        <a href="{{ $activity->subject->favorited->path() }}">favorited a reply</a> 
    @endslot

    @slot('body')
        <p>{{ $activity->subject->favorited->body }}</p>
    @endslot
@endcomponent