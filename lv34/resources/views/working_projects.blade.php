<h1>My Projects</h1>
<a href="{{ route('home') }}" class="btn btn-primary mt-2">Home</a>
@if (count($userProjects) > 0)
    <ul>
        @foreach ($userProjects as $project)
            <li>
                <p>{{ $project->naziv_projekta }}</p>
                <p>{{ $project->opis_projekta }}</p>
                <p>{{ $project->cijena_projekta }}</p>
                <p>{{ $project->obavljeni_poslovi }}</p>
                <p>{{ $project->datum_pocetka }}</p>
                <p>{{ $project->datum_zavrsetka }}</p> 
            </li>
        @endforeach
    </ul>
@else
    <p>You don't have any assigned projects yet.</p>
@endif
