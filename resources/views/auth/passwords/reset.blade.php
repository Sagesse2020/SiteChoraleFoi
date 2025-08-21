<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau mot de passe</title>
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

        .login-container {
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
            color: #0044cc;
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin: 0.5rem 0 0.2rem;
            color: #333333;
            font-weight: bold;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.8rem;
            margin-bottom: 1rem;
            border: 1px solid #0044cc;
            border-radius: 4px;
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 0.8rem;
            background-color: #0044cc;
            color: #ffffff;
            font-weight: bold;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #002d99;
        }

        .error {
            color: #ff0000;
            font-size: 0.9rem;
            margin-top: -0.5rem;
            margin-bottom: 1rem;
        }

        a {
            color: #0044cc;
            text-decoration: none;
        }

        a:hover {
            color: #002d99;
        }

        .form-group {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1rem;
        }

        .form-group input[type="checkbox"] {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Nouveau mot de passe</h2>

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">Adresse email</label>
            <input type="email" id="email" name="email" required>

            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <label for="password">Nouveau mot de passe</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirmer le mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror

            <button type="submit">Réinitialiser</button>
            <p> back to <a href="{{ route('login') }}">Login</a></p>
        </form>
    </div>
</body>
</html>
