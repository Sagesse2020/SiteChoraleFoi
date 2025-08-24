<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrateur</title>

    <!-- Lien CDN Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
       <!-- Font Awesome en local -->
    <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css') }}">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        }

        body {
            background: linear-gradient(rgba(8, 199, 212, 0.5)),
                        url('https://images.unsplash.com/photo-1579048098170-ffb569cc1028') no-repeat center center/cover;
            height: 100vh;
            color: black;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 40px;
            background-color:blue;
        }

        nav .logo {
            font-size: 24px;
            font-weight: bold;
            color: #fff;
        }

        nav ul {
            display: flex;
            list-style: none;
            gap: 8px;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            transition: color 0.3s;
        }
        nav ul li a i {
        margin-right: 8px;
        }


        nav ul li a:hover {
            color: blue;
        }

        .hero {
            text-align: center;
            padding-top: 100px;
            padding-left: 30px;
            padding-right: 30px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
            animation: fadeInDown 1s ease-in-out;
        }

        .hero p {
            font-size: 20px;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.6;
            animation: fadeInUp 1.5s ease-in-out;
        }

        .hero img {
            margin-top: 20px;
            max-width: 90%;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgb(8, 245, 146);
            animation: zoomIn 2s ease-in-out;
        }

        footer {
            background-color: rgb(10, 34, 9);
            text-align: center;
            padding: 20px;
            color: white;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            margin: 0 10px;
            font-size: 24px;
            transition: transform 0.3s;
        }

        .social-icons a:hover {
            transform: scale(1.2);
        }

        .fa-facebook { color: #1877F2; }
        .fa-tiktok { color: #010101; }
        .fa-whatsapp { color: #25D366; }
        .fa-youtube { color: #FF0000; }
        .fa-shield-alt { color: #FF9900; }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }
            to {
                transform: scale(1);
                opacity: 1;
            }
        }

    </style>
</head>
<body>
    <nav>
        <div class="logo"></div>
        <img src="{{ asset('') }}" alt="" class="logo">
        <ul>
    <li><a href="{{ route('welcome') }}"><i class="fas fa-home"></i> Accueil</a></li>
    <li><a href="{{ route('app_accueilGroupe') }}"><i class="fas fa-users"></i> Groupes</a></li>
    <li><a href="{{ route('app_accueilChoriste') }}"><i class="fas fa-microphone"></i> Choristes</a></li>
    <li><a href="{{ route('app_accueilEvenement') }}"><i class="fas fa-calendar-alt"></i> Événements</a></li>
    <li><a href="{{ route('app_accueilGalerie') }}"><i class="fas fa-images"></i> Galeries</a></li>
    <li><a href="{{ route('app_accueilPublicite') }}"><i class="fas fa-bullhorn"></i> Publicités</a></li>
    <li><a href="{{ route('app_accueilPublication') }}"><i class="fas fa-newspaper"></i> Publications</a></li>
    <li><a href="{{ route('users') }}"><i class="fas fa-user-plus"></i> Créer un utilisateur</a></li>
    <li><a href="{{ route('profil') }}"><i class="fas fa-user"></i> Profil</a></li>
    <li><a href="{{ route('statistiques.create') }}"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
         </ul>
    </nav>

    <section class="hero">
        <h1>Bienvenue cher administrateur</h1>
        <p>
            Cette page personnel est conçu pour l'administration du site
        </p>
        <img src="{{ asset('moi.jpg') }}" alt="Chorale Foi Parfaite" class="">
    </section>

    <footer>
        <p>Suivez-nous sur les réseaux :</p>
        <div class="social-icons">
      <a href="https://www.facebook.com/share/16riUmXBqu/"><i class="fab fa-facebook"></i></a>
      <a href="https://www.tiktok.com/@choralefoiparfait">
      <i class="fab fa-tiktok"></i>
      </a>
      <a href="https://wa.me/242065393899"><i class="fab fa-whatsapp"></i></a>
      <a href="https://youtube.com/@choralefoiparfaite?si=og8TeBjZG2nDLH6o" target="_blank"><i class="fab fa-youtube"></i></a>
       </div>
        <p>Elysée Sagesse LOUFOUTOU GPA.</p>
        <p>&copy; 2025 Chorale Foi Parfaite. Tous droits réservés.</p>
    </footer>
</body>
</html>
