
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fournisseurs.style.css">
    <title>Créer</title>
   <style>
     /* Général : corps de la page */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        /* Conteneur principal */
        .container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        /* Titre principal */
        h1 {
            text-align: center;
            font-size: 28px;
            color: #333;
            margin-bottom: 20px;
        }

        /* Style des champs de formulaire */
        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-size: 16px;
            font-weight: 600;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            color: #333;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        /* Effet au focus des champs */
        .form-group input:focus,
        .form-group select:focus {
            border-color: #007bff;
            background-color: #fff;
            outline: none;
        }

        /* Boutons */
        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 5px; /* Espacement entre les boutons */
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
        }

        .btn-secondary:hover {
            background-color: #e0e0e0;
        }

        /* Message de succès */
        .alert-success {
            padding: 15px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        /* Centrer les boutons dans leur conteneur */
        .form-group-buttons {
            text-align: center;
        }
   </style>

</head>
<body>
    <div class="container mt-5">
       <h1>Enregistrement du contenu de la galerie</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('galeries.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Champs pour la table Page -->
           <div>
            <label>Titre de l'image</label>
            <input type="text" name="titre" value="{{ old('titre') }}" required>
           </div>
            <br/>
            <div class="form-group">
            <select id="evenement_id" name="evenement_id" required>
           <option value=""> Sélectionnez l'évenement </option>
            @foreach($evenements as $Evenement)
           <option value="{{$Evenement->id }}">{{ $Evenement->titre }}</option>
           @endforeach
           </select>
             <br/>

            <!-- Boutons -->
             <!-- Conteneur pour centrer les boutons -->
            <div class="form-group-buttons">
                <button type="submit" class="btn-primary">Enregistrer</button>
                <button type="reset" class="btn-secondary">Réinitialiser</button>
            </div>
        </form>
    </div>

    <!-- Ajoute le JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
