<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Accueil</title>

    <style>
    .event-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}
.event-card {
    border: 1px solid #ccc;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    background: white;
}
.event-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}
.event-info {
    padding: 1rem;
}
.event-info h3 {
    margin-top: 0;
}
.btn {
    display: inline-block;
    background-color: #0078D4;
    color: white;
    padding: 0.5rem 1rem;
    text-decoration: none;
    border-radius: 6px;
}
    </style>
</head>
<body>
   <div class="event-grid">
  @foreach($evenements as $event)
  <div class="event-card">
    <img src="{{ asset('sagesse.png'.$event->image) }}" alt="{{ $event->titre }}">
    <div class="event-info">
       <h3>{{ $event->titre }}</h3>
  <p><strong>Date :</strong> {{ \Carbon\Carbon::parse($event->date)->format('d/m/Y') }}</p>
  <p><strong>Lieu :</strong> {{ $event->lieu }}</p>
  <p><strong>Type :</strong> {{ $event->type }}</p>
  <p>{{ Str::limit($event->description, 100) }}</p> <!-- résumé description -->
  <a href="{{ route('evenements.index', $event->id) }}" class="btn">Voir Détails</a>
    </div>
  </div>
  @endforeach
</div>
    <footer>
        <p>&copy; {{ date('Y') }} Chorale Foi Parfaite. Tous droits réservés.</p>
    </footer>
</body>
</html>
