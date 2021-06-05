@foreach ($modeles as $modele)
    <option value="{{ $modele->id }}">{{ $modele->nom_modele }}</option>
@endforeach
@error('modele_id')
    <button class="btn-danger">{{ $message }}</button>
@enderror
