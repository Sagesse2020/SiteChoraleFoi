<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques - Chorale</title>
    <style>
        /* Reset minimal */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }

        body {
            background-color: #f4f6f8;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
            font-size: 2.5rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background-color: #fff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #34495e;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        h3 {
            color: #34495e;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 10px;
            font-size: 1.1rem;
        }

        ul {
            list-style: none;
            margin-bottom: 20px;
        }

        ul li {
            background-color: #ecf0f1;
            margin-bottom: 8px;
            padding: 10px 15px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            transition: background-color 0.3s;
        }

        ul li:hover {
            background-color: #d0e6f7;
        }

        .section {
            margin-bottom: 30px;
        }

        @media(max-width: 600px){
            body { padding: 10px; }
            .container { padding: 15px; }
            h1 { font-size: 2rem; }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Les statistiques des visisteurs et des utilisateurs connecté - Chorale</h1>
        <div class="section">
            <h2>Visiteurs</h2>
            <p>Total des visites : <strong>{{ $totalVisits }}</strong></p>
            <p>Visiteurs uniques : <strong>{{ $uniqueVisitors }}</strong></p>

            <h3>Pages les plus visitées :</h3>
            <ul>
                @foreach($visitsByPage as $visit)
                    <li>
                        <span>{{ $visit->page_visited }}</span>
                        <span>{{ $visit->total }} visites</span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="section">
            <h2>Connexions utilisateurs récentes</h2>
            <ul>
                @foreach($logins as $login)
                    <li>
                        <span>{{ $login->user->name }}</span>
                        <span>Connecté le {{ $login->logged_in_at }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>
