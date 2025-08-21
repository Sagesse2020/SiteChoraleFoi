<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon profil - {{ config('app.name') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .avatar {
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mettre à jour mon profil</h1>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('profile-update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Nom -->
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>

            <!-- Ancien mot de passe -->
            <div class="form-group">
                <label for="old-password">Ancien mot de passe</label>
                <input type="password" id="old-password" name="old-password" class="form-control" required>
            </div>

            <!-- Nouveau mot de passe -->
            <div class="form-group">
                <label for="new-password">Nouveau mot de passe (facultatif)</label>
                <input type="password" id="new-password" name="new-password" class="form-control">
            </div>

            <!-- Confirmation -->
            <div class="form-group">
                <label for="new-password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" id="new-password_confirmation" name="new-password_confirmation" class="form-control">
            </div>

            <!-- Photo -->
            <div class="form-group">
                <label>Photo actuelle :</label><br>
                <img id="profilePreview"
                     src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('default-avatar.png') }}"
                     alt="Profil" class="avatar" style="width:80px;height:80px;border-radius:50%;">
                <input type="file" name="photo" id="photoInput" accept="image/*" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary w-100">Mettre à jour</button>
            </div>
        </form>
    </div>

    <!-- Script pour prévisualisation immédiate -->
    <script>
        document.getElementById('photoInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profilePreview').setAttribute('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>
