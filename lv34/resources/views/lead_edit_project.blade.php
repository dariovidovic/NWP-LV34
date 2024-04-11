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
<h1>Leader Edit Project</h1>
<a href="{{ route('projects.fetch') }}" class="btn btn-secondary mt-2">Go Back to My Projects</a>
<form method="POST" action="{{ route('leadUpdate.project', ['projectId' => $project->id]) }}">
    @csrf
    @method('PUT') 

    <div class="form-group">
        <label for="naziv_projekta">Naziv Projekta:</label>
        <input type="text" name="naziv_projekta" id="naziv_projekta" class="form-control" value="{{ $project->naziv_projekta }}">
    </div>

    <div class="form-group">
        <label for="opis_projekta">Opis Projekta:</label>
        <textarea name="opis_projekta" id="opis_projekta" class="form-control">{{ $project->opis_projekta }}</textarea>
    </div>

    <div class="form-group">
        <label for="cijena_projekta">Cijena Projekta:</label>
        <input type="text" name="cijena_projekta" id="cijena_projekta" class="form-control" value="{{ $project->cijena_projekta }}">
    </div>

    <div class="form-group">
        <label for="obavljeni_poslovi">Obavljeni Poslovi:</label>
        <input type="text" name="obavljeni_poslovi" id="obavljeni_poslovi" class="form-control" value="{{ $project->obavljeni_poslovi }}">
    </div>

    <div class="form-group">
        <label for="datum_pocetka">Datum Početka:</label>
        <input type="date" name="datum_pocetka" id="datum_pocetka" class="form-control" value="{{ $project->datum_pocetka }}">
    </div>

    <div class="form-group">
        <label for="datum_zavrsetka">Datum Završetka:</label>
        <input type="date" name="datum_zavrsetka" id="datum_zavrsetka" class="form-control" value="{{ $project->datum_zavrsetka }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
</form>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif