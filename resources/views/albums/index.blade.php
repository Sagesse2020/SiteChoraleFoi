<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Albums Photos</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
                Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
            background: #f5f5f7;
            margin: 0;
            padding: 20px;
            color: #1c1c1e;
        }
        h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 25px;
            color: #0a84ff;
            text-align: center;
            user-select: none;
        }
        .album {
            background: white;
            border-radius: 14px;
            padding: 15px 15px 20px 15px;
            margin-bottom: 30px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.12);
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .album-header {
            margin-bottom: 15px;
            border-bottom: 1px solid #e5e5ea;
            padding-bottom: 8px;
        }
        .album-header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #007aff;
        }
        .album-header small {
            color: #8e8e93;
            font-size: 0.85rem;
            user-select: none;
        }

        /* Image principale de l'événement */
        .event-image {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin: 10px 0 15px 0;
            box-shadow: 0 1px 4px rgba(0,0,0,0.1);
        }

        /* Grid type galerie téléphone */
        .photos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 10px;
        }
        .photo-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 4px rgba(0,0,0,0.12);
            cursor: pointer;
            transition: transform 0.15s ease-in-out;
            display: flex;
            flex-direction: column;
            user-select: none;
        }
        .photo-card:hover {
            transform: scale(1.07);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .photo-card img {
            width: 100%;
            height: 100px;
            object-fit: cover;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
            flex-shrink: 0;
        }
        .photo-caption {
            padding: 6px 8px;
            font-size: 0.8rem;
            color: #3a3a3c;
            text-align: center;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 30px;
        }
        .empty-album {
            font-style: italic;
            color: #999;
            text-align: center;
            padding: 20px 0;
            user-select: none;
        }

        /* Responsive pour petits écrans */
        @media (max-width: 480px) {
            .photos {
                grid-template-columns: repeat(2, 1fr);
                gap: 8px;
            }
            .photo-card img {
                height: 90px;
            }
        }
        @media (max-width: 320px) {
            .photos {
                grid-template-columns: 1fr;
                gap: 6px;
            }
            .photo-card img {
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <h1>Albums-Événements</h1>

    @forelse ($evenements as $event)
        <div class="album">
            <div class="album-header">
                <h2>{{ $event->titre }}</h2>
                <small>{{ \Carbon\Carbon::parse($event->date)->format('d M Y') }}</small>
            </div>

            @if($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->titre }}" class="event-image" />
            @endif

            @if($event->galeries->count())
                <div class="photos">
                    @foreach($event->galeries as $photo)
                        <div class="photo-card" tabindex="0" role="button" aria-label="Photo: {{ $photo->titre }}">
                            <img src="{{ asset('storage/' . $photo->url) }}" alt="{{ $photo->titre }}" />
                            <div class="photo-caption">{{ $photo->titre }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-album">Aucune photo dans cet album.</div>
            @endif
        </div>
    @empty
        <p style="text-align:center; color:#555; font-style: italic;">Aucun événement trouvé.</p>
    @endforelse
</body>
</html>
