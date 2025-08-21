<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f0f8ff;
        }

        .register-container {
            width: 100%;
            max-width: 400px;
            background-color: #ffffff;
            padding: 2rem;
            border: 1px solid #d0d7de;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        h2 {
            color: blue;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            color: #333333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid blue;
            border-radius: 4px;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 0.8rem;
            background-color: blue;
            color: #ffffff;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: blue;
        }

        .error {
            color: blue;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }

        a {
            color: blue;
            text-decoration: none;
        }

        a:hover {
            color: blue;
        }
    </style>
</head>
<body>

    <div style="max-width:500px;margin:50px auto;">
    <h2>Créer un nouvel utilisateur</h2>

    @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <form action="{{ route('users.create') }}" method="POST">
            @csrf
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <label for="role">Rôle :</label>
            <select name="role" id="role">
           <option value="user" selected>Utilisateur</option>
            <option value="admin">Administrateur</option>
            </select>
              <br>

            <button type="submit" class="btn">S'inscrire</button>

            <p><a href="/login">Déjà un compte ? Connectez-vous</a></p>
        </form>
    </div>
</body>
</html>
