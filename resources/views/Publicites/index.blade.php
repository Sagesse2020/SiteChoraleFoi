<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des publicités</title>
    <style>
         /* Général : corps de la page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        /* Conteneur principal */
        .container {
            width: 80%;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Titre principal */
        h1 {
            text-align: center;
            font-size: 2.2em;
            margin-bottom: 20px;
            color: #007bff;
        }

        /* Style du message "Aucun client disponible" */
        p {
            text-align: center;
            font-size: 1.2em;
            color: #d9534f;
        }

        /* Table de clients */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-size: 1em;
        }

        table td {
            background-color: #f9f9f9;
            font-size: 1em;
        }

        table tr:nth-child(even) td {
            background-color: #f1f1f1;
        }

        /* Améliorer la visibilité des bordures lors du survol */
        table tr:hover td {
            background-color: #e9ecef;
        }

        /* Style de la pagination ou du bouton d'ajout, si nécessaire */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 10px 15px;
            margin: 0 5px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
     <h1>Liste des Publicités</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    <ul>
        @foreach($publicites as $pub)
            <li>
                <h3>{{ $pub->titre }}</h3>
                <p>{{ $pub->contenu }}</p>
                @if($pub->image)
                    <img src="{{ asset('storage/'.$pub->image) }}" alt="Image" width="200">
                @endif
            </li>
             <br>
                 @if(auth()->user()->role === 'admin')
            <a href="{{ route('publicites.edit', $pub) }}">✏️ Modifier</a>
            <form action="{{ route('publicites.destroy', $pub) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Supprimer cette publicité ?')">🗑 Supprimer</button>
            </form>
        @endif
        @endforeach
    </ul>
</body>
</html>
