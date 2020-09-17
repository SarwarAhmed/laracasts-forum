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
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        
                        <div class="form-group">
                            <label for="body">Description</label>
                            <textarea name="body" id="body" class="form-control" rows="6"></textarea>
                        </div>

                        <button type="submit" class="mt-2 btn btn-outline-primary">Publish</button>
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
