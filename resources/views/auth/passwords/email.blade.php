<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <style>
        /* Styles similaires à ceux de la page de connexion */
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialisation du mot de passe</h2>
        @if (session('status'))
            <p style="color: green;">{{ session('status') }}</p>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" required>

            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <button type="submit">Envoyer le lien</button>
        </form>
    </div>
</body>
</html>
