<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Galerie multimédia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            max-width: 1400px;
            margin: 40px auto;
        }
        h1 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 30px;
            color: #007bff;
        }
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 15px;
        }
        .gallery-card {
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .gallery-card:hover {
            transform: scale(1.03);
        }
        .gallery-card img,
        .gallery-card video {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .card-body {
            padding: 10px;
        }
        .card-body h4 {
            margin: 0 0 5px;
            font-size: 1rem;
            color: #333;
        }
        .card-body p {
            margin: 3px 0;
            font-size: 0.85rem;
            color: #666;
        }
        .empty-message {
            text-align: center;
            font-size: 1.2em;
            color: #d9534f;
            margin-top: 50px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Galerie multimédia</h1>

    @if($galeries->isEmpty())
        <p class="empty-message">Aucun contenu disponible.</p>
    @else
        <div class="gallery-grid">
           @foreach($galeries as $galerie)
    <div class="gallery-card">
        @if($galerie->evenement->video)
            <video controls>
                <source src="{{ asset('storage/' . $galerie->evenement->video) }}" type="video/mp4">
                Votre navigateur ne supporte pas la vidéo.
            </video>
        @elseif($galerie->evenement->image)
            <img src="{{ asset('storage/' . $galerie->evenement->image) }}" alt="{{ $galerie->evenement->titre }}">
        @endif

        <div class="card-body">
            <h4>{{ $galerie->evenement->titre }}</h4>
            <p><strong>Date :</strong> {{ $galerie->evenement->date ?? 'Non spécifiée' }}</p>
        </div>
    </div>
@endforeach
        </div>
    @endif
</div>
</body>
</html>
