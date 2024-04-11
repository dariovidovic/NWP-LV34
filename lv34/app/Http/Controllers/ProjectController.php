<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function create() {
        return view('create_project_form');
    }

    public function index() {
        return view('my_projects');
    }

    /*-----Funkcija za pohranu projekta-----*/
    public function store(Request $request) {

        /*-----Validacija podataka koje korisnik unosi u formu-----*/
        $validatedData = $request->validate([
            'naziv_projekta' => 'required',
            'opis_projekta' => 'required',
            'cijena_projekta' => 'required|numeric',
            'obavljeni_poslovi' => 'required',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'required|date|after_or_equal:datum_pocetka',
        ]);

        if (Auth::check()) {
            $userId = Auth::id();
        } 
        
        $project = new Project();
        $project->naziv_projekta = $validatedData['naziv_projekta'];
        $project->opis_projekta = $validatedData['opis_projekta'];
        $project->cijena_projekta = $validatedData['cijena_projekta'];
        $project->obavljeni_poslovi = $validatedData['obavljeni_poslovi'];
        $project->datum_pocetka = $validatedData['datum_pocetka'];
        $project->datum_zavrsetka = $validatedData['datum_zavrsetka'];
        $project->voditelj_id = $userId;

        $project->save();
        return redirect()->back()->with('success', 'Projekt je uspješno pohranjen!');
     
    }

    public function fetch() {
        $userId = Auth::id();
        $projects = Project::where('voditelj_id', $userId)->get();
        $users = User::where('id','!=', $userId)->get();
        
        return view('my_projects', compact('projects','users'));
        
    }

    

}
