<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }} - Accueil</title>

    <!-- Lien vers Font Awesome -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">

    <style>
        /* Ton CSS original inchangé */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f0f8ff 0%, #d9e8ff 100%);
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .navbar {
            background-color: #0044cc;
            padding: 0.8rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .logo-container {
            display: flex;
            align-items: center;
        }
        .logo {
            width: 70px;
            transition: transform 0.3s ease, filter 0.3s ease;
            cursor: pointer;
        }
        .logo-container:hover .logo {
            transform: scale(1.15);
            filter: brightness(1.2);
        }
        .nav-links {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .nav-links a {
            color: #fff;
            font-weight: 600;
            text-decoration: none;
            padding: 0.4rem 0.7rem;
            border-radius: 4px;
            transition: background-color 0.3s, color 0.3s;
            font-size: 0.95rem;
            user-select: none;
        }
        .nav-links a:hover {
            background-color: #003399;
            color: #00ffd6;
        }
        .nav-links a.active {
            background-color: #00ffd6;
            color: #0044cc;
            font-weight: 700;
            box-shadow: 0 0 8px #00ffd6aa;
        }
        .nav-links a i {
            margin-right: 6px;
        }
        main.content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem 1rem;
            text-align: center;
        }
        main.content h1 {
            font-size: 3rem;
            color: #0044cc;
            margin-bottom: 1rem;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }
        main.content p {
            font-size: 1.3rem;
            max-width: 600px;
            color: #222;
            line-height: 1.6;
        }
        footer {
            background-color: #001f33;
            text-align: center;
            padding: 1.5rem 1rem;
            color: #ccc;
            font-size: 0.9rem;
            user-select: none;
        }
        @media (max-width: 768px) {
            .nav-links {
                flex-direction: column;
                gap: 0.6rem;
                background-color: #0044cc;
                position: absolute;
                right: 0;
                top: 60px;
                padding: 1rem 1.5rem;
                border-radius: 0 0 0 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
                display: none;
            }
            .nav-links.active {
                display: flex;
            }
        }
    </style>
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <a href="{{ route('welcome') }}">
                <img src="{{ asset('logo.png') }}" alt="Logo Chorale Foi Parfaite" class="logo" />
            </a>
        </div>
        <nav class="nav-links">
            <a href="{{ route('welcome') }}"><i class="fas fa-home"></i>Accueil</a>
            <a href="{{ route('publicites.index') }}"><i class="fas fa-bullhorn"></i>Publicités</a>
            <a href="{{ route('publications.index') }}"><i class="fas fa-newspaper"></i>Publications</a>
            <a href="{{ route('evenements.index') }}"><i class="fas fa-calendar-alt"></i>Événements</a>
            <a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a>
            <a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
        </nav>
    </header>

    <main class="content">
        <h1>Bienvenue à la Chorale Foi Parfaite</h1>
        <p>Louons ensemble, chantons pour le Seigneur, dans l'harmonie et la foi.</p>
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} Chorale Foi Parfaite. Tous droits réservés.</p>
    </footer>
</body>
</html>
