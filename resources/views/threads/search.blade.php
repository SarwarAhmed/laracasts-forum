@extends('layouts.app')

@section('content')
    <div class="container">
        <ais-index
            app-id="{{ config('scout.algolia.id') }}"
            api-key="{{ config('scout.algolia.key') }}"
            index-name="threads"
            query="{{ request('q') }}"
        >
            <div class="row">
                <div class="col-md-8">
                    <ais-results>
                        <template slot-scope="{ result }">
                            <li class="list-group">
                                <a :href="result.path" class="list-group-item">
                                    <ais-highlight :result="result" attribute-name="title"></ais-highlight>
                                </a>
                            </li>
                        </template>
                    </ais-results>
                </div>

                <div class="col-md-4">

                    <div class="card mt-4">
                        <div class="card-header">
                            Search
                        </div>

                        <div class="card-body">
                            <ais-search-box>
                                <ais-input placeholder="Find products..." :autofocus="true" class="form-control"></ais-input>
                            </ais-search-box>
                        </div>
                    </div>

                    <div class="card mt-4">
                        <div class="card-header">
                            Filter by Channel
                        </div>

                        <div class="card-body">
                            <ais-refinement-list attribute-name="channel.name"></ais-refinement-list>
                        </div>
                    </div>

                    @if (count($trending))
                        <div class="card mt-4">
                            <div class="card-header">
                                Trending Threads
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($trending as $thread)
                                        <li class="list-group-item">
                                            <a href="{{ url($thread->path) }}">
                                                {{ $thread->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </ais-index>
    </div>
@endsection
