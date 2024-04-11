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
        $userId = $request->input('user_id');
        $projectId = $request->input('project_id');
        //dd($projectId, $userId);
        $existingMember = ProjectMembers::where('projectId', $projectId)
            ->where('userId', $userId)
            ->first();

        if ($existingMember) {
            return back()->with('error', 'Korisnik već dodan projektu.');
        }

        ProjectMembers::create([
            'projectId' => $projectId,
            'userId' => $userId,
        ]);

        return back()->with('success', 'Korisnik uspješno dodan projektu.');
    }

    public function remove(Request $request, $projectId, $userId)
    {

        ProjectMembers::where('projectId', $projectId)
            ->where('userId', $userId)
            ->delete();

        return back()->with('success', 'Korisnik uspješno uklonjen iz projekta.'); 
    }

    public function search() {
        $userId = Auth::id();
        $projects = ProjectMembers::where('userId', $userId)->get();
        $projectIds = $projects->pluck('projectId')->toArray();
        $userProjects = Project::whereIn('id', $projectIds)->get();
        
        return view('working_projects', compact('userProjects'));
    }
}
