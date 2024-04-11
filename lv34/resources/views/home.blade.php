@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
            <a href="{{ route('projects.create') }}" class="btn btn-primary mt-2">Create Project</a>
            <a href="{{ route('projects.fetch') }}" class="btn btn-primary mt-2">My Projects</a>
            <a href="{{ route('projects.search') }}" class="btn btn-primary mt-2">Working projects</a>
        </div>
    </div>
</div>
@endsection
