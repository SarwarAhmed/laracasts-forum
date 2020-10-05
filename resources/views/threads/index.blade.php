@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('threads._list')

            <div>{{ $threads->appends(request()->input())->links() }}</div>
        </div>
    </div>
</div>
@endsection
