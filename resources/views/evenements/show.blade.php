<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $evenement->titre }} - Détails</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 2rem auto; padding: 1rem; }
        img { max-width: 100%; height: auto; border-radius: 8px; }
        h1 { color: #0078D4; }
        p { line-height: 1.6; }
        .info { margin-bottom: 1rem; }
    </style>
</head>
<body>
    <h1>{{ $evenement->titre }}</h1>

    @if($evenement->image && file_exists(storage_path('app/public/'.$evenement->image)))
        <img src="{{ asset('storage/'.$evenement->image) }}" alt="{{ $evenement->titre }}">
    @else
        <p><em>Aucune image disponible</em></p>
    @endif

    <div class="info">
        <strong>Date :</strong> {{ \Carbon\Carbon::parse($evenement->date)->format('d/m/Y') }}<br>
        <strong>Lieu :</strong> {{ $evenement->lieu }}<br>
        <strong>Type :</strong> {{ $evenement->type }}
    </div>

    <div>
        <p>{{ $evenement->description }}</p>
    </div>

    <a href="{{ route('evenements.index') }}">← Retour à la liste</a>
</body>
</html>
