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
        
        /*-----Validirani atributi projekta se spremaju u bazu podataka-----*/
        $project = new Project();
        $project->naziv_projekta = $validatedData['naziv_projekta'];
        $project->opis_projekta = $validatedData['opis_projekta'];
        $project->cijena_projekta = $validatedData['cijena_projekta'];
        $project->obavljeni_poslovi = $validatedData['obavljeni_poslovi'];
        $project->datum_pocetka = $validatedData['datum_pocetka'];
        $project->datum_zavrsetka = $validatedData['datum_zavrsetka'];
        $project->voditelj_id = $userId;

        $project->save();

        /*-----Nakon pohrane podataka, vraca se na istu rutu te se ispisuje success poruka-----*/
        return redirect()->back()->with('success', 'Projekt saved successfully!');
     
    }

   
    public function fetch() {
        $userId = Auth::id();
         /*-----Dohvacanje svih projekata prijavljenog korisnika na kojemu je on voditelj-----*/
        $projects = Project::where('voditelj_id', $userId)->get();
        /*-----Dohvacanje svih korisnika koji se nalaze u bazi, osim voditelja, kako bi se mogli dodati na projekt-----*/
        $users = User::where('id','!=', $userId)->get();
        
        /*-----Kada korisnik klikne na myProjects vratit ce se view te proslijediti projects i users-----*/
        return view('my_projects', compact('projects','users'));
        
    }

   
    /*-----Kada sudionik projekta klikne na Edit tipku, trazi se projekt pod tim ID-----*/
    /*-----Nakon sto se projekt nadje, vraca se view na kojemu ima mogućnost edita atributa obavljeni_poslovi-----*/
    /*-----Prosljedjuje se i $project, kako bi se prikazala trenutna vrijednost od obavljeni_poslovi projekta-----*/
    public function edit($projectId) {
        $project = Project::findOrFail($projectId);
        return view('edit_project', compact('project'));
    }

    /*-----Kada sudionik projekta napravi izmjenu, klikne edit te se promjena pohranjuje-----*/
    /*-----Projekt se trazi u bazi podataka te se izmjena azurira-----*/
    /*-----Nakon uspjesnog azuriranja, vraca se na istu rutu te se ispisuje success poruka-----*/
    public function update(Request $request, $projectId){
        $request->validate([
            'obavljeni_poslovi' => 'required',
        ]);

        $project = Project::findOrFail($projectId);
        $project->obavljeni_poslovi = $request->input('obavljeni_poslovi');
        $project->save();
        return back()->with('success', 'Project updated successfully.');
    }

    /*-----Kada voditelj projekta klikne na Edit tipku, trazi se projekt pod tim ID-----*/
    /*-----Nakon sto se projekt nadje, vraca se view na kojemu ima mogućnost edita pojedinih atributa-----*/
    /*-----Prosljedjuje se i $project, kako bi se prikazale trenutne vrijednosti projekta-----*/
    public function leadEdit($projectId) {
        $project = Project::findOrFail($projectId);
        return view('lead_edit_project', compact('project'));
    }

    /*-----Kada voditelj projekta napravi izmjene, klikne edit te se promjena pohranjuje-----*/
    /*-----Projekt se trazi u bazi podataka te se izmjene azuriraju-----*/
    /*-----Nakon uspjesnog azuriranja, vraca se na istu rutu te se ispisuje success poruka-----*/
    public function leadUpdate(Request $request, $projectId){
        $request->validate([
            'naziv_projekta' => 'required',
            'opis_projekta' => 'required',
            'cijena_projekta' => 'required|numeric',
            'obavljeni_poslovi' => 'required',
            'datum_pocetka' => 'required|date',
            'datum_zavrsetka' => 'required|date|after_or_equal:datum_pocetka',
        ]);
        
        $project = Project::findOrFail($projectId);

        $project->update($request->all());

        return back()->with('success', 'Project updated successfully.');
    }

}
