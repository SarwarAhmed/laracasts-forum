@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form method="POSt" action="/threads">
                        @csrf

                        <div class="form-group">
                            <label for="channel_id">Choose a Channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control">

                                <option value="" selected disabled>Choose One..</option>

                                @foreach ($channels as $channel)
                                    <option 
                                        value="{{ $channel->id }}" 
                                        {{ old('channel_id') == $channel->id ? 'selected' : '' }}
                                    >
                                        {{ $channel->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}">
                        </div>
                        
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" id="body" class="form-control" rows="6">{{ old('body') }}</textarea>
                        </div>

                        <button type="submit" class="mt-2 btn btn-outline-primary">Publish</button>

                        @if ($errors->any())
                            <div class="alert alert-danger mt-2">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
