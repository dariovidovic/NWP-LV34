<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectMembers;
use App\Models\Project;
use Auth;


class ProjectMembersController extends Controller
{
    public function assign(Request $request)
    {
        /*-----Dohvacanje ID korisnika koji se dodaje i ID projekta na koji se dodaje-----*/
        $userId = $request->input('user_id');
        $projectId = $request->input('project_id');
        
        /*-----Provjera je li korisnik vec dodan na trenutni projekt-----*/
        $existingMember = ProjectMembers::where('projectId', $projectId)
            ->where('userId', $userId)
            ->first();

        /*-----Ukoliko je korisnik dodan na projekt, ispisuje se poruka na trenutnoj ruti-----*/
        if ($existingMember) {
            return back()->with('error', 'Korisnik već dodan projektu.');
        }

        /*-----Ukoliko korisnik nije dodan na projekt, u bazu ProjectMembers se upisuje ID korisnika i ID projekta na kojem ce raditi-----*/
        ProjectMembers::create([
            'projectId' => $projectId,
            'userId' => $userId,
        ]);

        /*-----Nakon dodavanja u bazu, vraca se na istu rutu te se ispisuje success poruka-----*/
        return back()->with('success', 'Korisnik uspješno dodan projektu.');
    }

    /*-----Kada korisnik otvori workingProjects, iz tablice ProjectMembers se pretrazuju svi projekti na kojima se on nalazi-----*/
    /*-----Pretraga se vrsi tako da se usporedi ID logiranog korisnika s userId iz tablice ProjectMembers-----*/
    /*-----Nakon sto se pronadju svi projekti na kojima se nalazi prijavljeni korisnik, vraca se view s userProjects-----*/
    public function search() {
        $userId = Auth::id();
        $projects = ProjectMembers::where('userId', $userId)->get();
        $projectIds = $projects->pluck('projectId')->toArray();
        $userProjects = Project::whereIn('id', $projectIds)->get();
        
        return view('working_projects', compact('userProjects'));
    }
}
