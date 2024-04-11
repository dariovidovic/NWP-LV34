<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project Form</title>
</head>
<body>
    <h1>Create New Project</h1>
    
    <form method="POST" action="{{ route('projects.store') }}">
        @csrf
        <div class="form-group">
            <label for="naziv_projekta">Naziv projekta:</label>
            <input type="text" id="naziv_projekta" name="naziv_projekta" required>
        </div>
        <div class="form-group">
            <label for="opis_projekta">Opis projekta:</label>
            <input type="text" id="opis_projekta" name="opis_projekta" required>
        </div>
        <div>
            <label for="cijena_projekta">Cijena projekta:</label>
            <input type="number" step="0.01" id="cijena_projekta" name="cijena_projekta" required>
        </div>
        <div>
            <label for="obavljeni_poslovi">Obavljeni poslovi:</label>
            <input type="text" id="obavljeni_poslovi" name="obavljeni_poslovi" required>
        </div>
        <div>
            <label for="datum_pocetka">Datum početka:</label>
            <input type="date" id="datum_pocetka" name="datum_pocetka" required>
        </div>
        <div>
            <label for="datum_zavrsetka">Datum završetka:</label>
            <input type="date" id="datum_zavrsetka" name="datum_zavrsetka" required>
        </div>
        <button type="submit">Save</button>
        <a href="{{ route('home') }}" class="btn btn-primary mt-2">Home</a>
    </form>
</body>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
</html>