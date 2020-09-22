@extends ('layouts.app')

@section ('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-header">
                <h1>
                    {{ $profileUser->name }}
                </h1>
            </div>

            @forelse ($activities as $date => $activity)
                <h3 class="mt-4">{{ $date }}</h3>

                @foreach ($activity as $record)
                    @if (view()->exists("profiles.activities.{$record->type}"))
                        @include ("profiles.activities.{$record->type}", ['activity' => $record])
                    @endif
                @endforeach
            @empty
                <h4 class="card-header mt-4">There is no activity yet.</h4>
            @endforelse
        </div>
    </div>
</div>
@endsection