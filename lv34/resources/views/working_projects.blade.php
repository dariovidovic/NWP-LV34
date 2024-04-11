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
<h1>Projects that I work on</h1>
<a href="{{ route('home') }}" class="btn btn-primary mt-2">Home</a>
@if (count($userProjects) > 0)
    <ul>
        @foreach ($userProjects as $project)
            <li>
                <p>Naziv projekta: {{ $project->naziv_projekta }}</p>
                <p>Opis projekta: {{ $project->opis_projekta }}</p>
                <p>Cijena projekta: {{ $project->cijena_projekta }}</p>
                <div style="display: flex; flex-direction:colum;">
                    <p>Obavljeni poslovi: {{ $project->obavljeni_poslovi }}</p>
                    <a href="{{ route('edit.project', ['projectId' => $project->id]) }}" class="btn btn-primary">Edit</a>
                </div>
                <p>Datum pocetka: {{ $project->datum_pocetka }}</p>
                <p>Datum zavrsetka: {{ $project->datum_zavrsetka }}</p> 
                
            </li>
        @endforeach
    </ul>
@else
    <p>You don't have any assigned projects yet.</p>
@endif
