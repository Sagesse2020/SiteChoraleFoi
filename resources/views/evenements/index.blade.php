<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }} - Événements</title>

    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        background-color: #f8f9fa;
        color: #333;
    }

    h1 {
        text-align: center;
        font-size: 2.5rem;
        color: #0056b3;
        margin-top: 1rem;
    }

    .event-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.8rem;
        padding: 2rem;
        max-width: 1400px;
        margin: auto;
    }

    .event-card {
        border-radius: 14px;
        overflow: hidden;
        background: white;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .event-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .event-card img {
        width: 100%;
        height: 220px;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.4s ease;
    }

    .event-card img:hover {
        transform: scale(1.07);
    }

    .event-info {
        padding: 1rem 1.2rem;
    }

    .event-info h3 {
        margin: 0;
        font-size: 1.3rem;
        color: #0056b3;
    }

    .event-info p {
        color: #666;
        font-size: 0.95rem;
        margin: 0.5rem 0 1rem;
    }

    .btn {
        display: inline-block;
        background-color: #0078D4;
        color: white;
        padding: 0.6rem 1.2rem;
        text-decoration: none;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #005fa3;
    }

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        padding-top: 60px;
        left: 0; top: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.85);
        overflow: auto;
    }

    .modal-content {
        margin: auto;
        display: block;
        max-width: 90%;
        max-height: 80vh;
        border-radius: 10px;
        box-shadow: 0 0 25px rgba(0,0,0,0.4);
    }

    .modal-caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #f1f1f1;
        padding: 10px 0;
        font-size: 1.1rem;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 35px;
        color: #fff;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.3s;
    }

    .modal-close:hover {
        color: #bbb;
    }
    </style>
</head>
<body>

    <h1>🎶 Nos Événements</h1>

    <div class="event-grid">
        @foreach($evenements as $event)
        <div class="event-card">
            <img
                src="{{ asset('storage/' . $event->image) }}"
                alt="{{ $event->titre }}"
                class="event-image"
                data-src="{{ asset('storage/' . $event->image) }}"
                data-title="{{ $event->titre }}"
            >
            <div class="event-info">
                <h3>{{ $event->titre }}</h3>
                <p>{{ Str::limit($event->description, 100) }}</p>
                <a href="{{ route('evenements.show', $event->id) }}" class="btn">Voir Détails</a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Modal pour afficher l'image en grand -->
    <div id="imageModal" class="modal">
        <span class="modal-close">&times;</span>
        <img class="modal-content" id="modalImg" />
        <div class="modal-caption" id="caption"></div>
    </div>

    <script>
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImg');
    const captionText = document.getElementById('caption');
    const closeBtn = document.getElementsByClassName('modal-close')[0];

    document.querySelectorAll('.event-image').forEach(img => {
        img.addEventListener('click', () => {
            modal.style.display = "block";
            modalImg.src = img.getAttribute('data-src');
            captionText.textContent = img.getAttribute('data-title');
        });
    });

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    modal.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
    </script>
     <!-- Pagination -->
    <div class="pagination">
        {{ $evenements->links() }}
    </div>
</body>
</html>
