<h1>My Projects</h1>
<a href="{{ route('home') }}" class="btn btn-primary mt-2">Home</a>
@if (count($projects) > 0)
    <ul>
        @foreach ($projects as $project)
            <li>
                <p>{{ $project->naziv_projekta }}</p>
                <p>{{ $project->opis_projekta }}</p>
                <p>{{ $project->cijena_projekta }}</p>
                <p>{{ $project->obavljeni_poslovi }}</p>
                <p>{{ $project->datum_pocetka }}</p>
                <p>{{ $project->datum_zavrsetka }}</p> 
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
    <p>You don't have any assigned projects yet.</p>
@endif
