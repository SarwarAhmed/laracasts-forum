@component('profiles.activities.activity')
    @slot('heading')
        {{ $profileUser->name }} published 
        <a href="{{ $activity->subject->path() }}">{{ $activity->subject->title }}</a>
    @endslot

    @slot('body')
        <p>{{ $activity->subject->body }}</p>
    @endslot
@endcomponent
