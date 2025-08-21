<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Événements à venir</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f2f5;
            padding: 20px;
            color: #333;
        }
        .event-section {
            max-width: 700px;
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        .event-card {
            display: flex;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.1);
            margin-bottom: 25px;
            overflow: hidden;
        }
        .event-card img {
            width: 200px;
            height: 150px;
            object-fit: cover;
        }
        .event-info {
            padding: 15px 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .event-info h3 {
            margin: 0 0 10px 0;
            color: #0056b3;
        }
        .event-info p {
            margin: 4px 0;
            font-size: 0.9rem;
            color: #555;
        }
        .event-info button {
            margin-top: 15px;
            align-self: flex-start;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 16px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .event-info button:hover {
            background-color: #0056b3;
        }
        /* Responsive */
        @media(max-width: 600px){
            .event-card {
                flex-direction: column;
            }
            .event-card img {
                width: 100%;
                height: 180px;
            }
            .event-info button {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <section class="event-section">
        <h2>Événements à venir</h2>

        @forelse ($evenements as $event)
            <div class="event-card">
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->titre }}">
                <div class="event-info">
                    <h3>{{ $event->titre }}</h3>
                    <p>Date : {{ \Carbon\Carbon::parse($event->date)->format('d F Y') }}</p>
                    <p>Lieu : {{ $event->lieu }}</p>
                    <form method="POST" action="{{ route('evenements.inscription', $event->id) }}">
                        @csrf
                        <button type="submit">S'inscrire</button>
                    </form>
                </div>
            </div>
        @empty
            <p style="text-align:center; font-style: italic; color: #666;">Aucun événement à venir pour le moment.</p>
        @endforelse
    </section>
</body>
</html>
