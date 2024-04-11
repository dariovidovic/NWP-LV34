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
<h1>My Projects</h1>
<a href="{{ route('home') }}" class="btn btn-primary mt-2">Home</a>
@if (count($projects) > 0)
    <ul>
        @foreach ($projects as $project)
            <li>
                <p>Naziv projekta: {{ $project->naziv_projekta }}</p>
                <p>Opis projekta: {{ $project->opis_projekta }}</p>
                <p>Cijena projekta: {{ $project->cijena_projekta }}</p>
                <p>Obavljeni poslovi: {{ $project->obavljeni_poslovi }}</p>
                <p>Datum pocetka: {{ $project->datum_pocetka }}</p>
                <p>Datum zavrsetka: {{ $project->datum_zavrsetka }}</p> 
                <a href="{{ route('leadEdit.project', ['projectId' => $project->id]) }}" class="btn btn-primary">Edit Project</a>
            </li>
            @if (count($users) > 0)
                    <h4>Dodaj clanove na projekt: </h4>
                    <ul>
                        @foreach ($users as $user)
                            <li>
                                <form action="{{ route('project_members.assign') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">{{ $user->name }}</button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                    @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                            @endif
                @else
                    <p>Trenutno nema dostupnih clanova.</p>
                @endif
        @endforeach
    </ul>
@else
    <p>You don't have any projects that you are leader on.</p>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
