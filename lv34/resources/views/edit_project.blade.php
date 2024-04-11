<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<h1>Edit Project</h1>
<a href="{{ route('projects.search') }}" class="btn btn-secondary mt-2">Go Back to Working Projects</a>
<form method="POST" action="{{ route('update.project', ['projectId' => $project->id]) }}">
    @csrf
    @method('PUT') 

    <div class="form-group">
        <label for="obavljeni_poslovi">Obavljeni Poslovi:</label>
        <input type="text" name="obavljeni_poslovi" id="obavljeni_poslovi" class="form-control" value="{{ $project->obavljeni_poslovi }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif