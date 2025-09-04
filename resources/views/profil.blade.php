<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Profil - Élysée</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f2f4f8;
      margin: 0;
      padding: 0;
    }
    .profile-container {
      display: flex;
      min-height: 100vh;
    }
    .sidebar {
      width: 250px;
      background: linear-gradient(to bottom, #2b5876, #4e4376);
      color: white;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 30px;
    }
    .profile-card {
      position: relative;
      width: 120px;
      height: 120px;
      margin-bottom: 20px;
    }
    .avatar {
      width: 100%;
      height: 100%;
      border-radius: 50%;
      border: 3px solid white;
      object-fit: cover;
      display: block;
    }
    .btn-upload {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: rgba(0,0,0,0.6);
      color: white;
      border: none;
      padding: 8px 12px;
      font-size: 12px;
      border-radius: 20px;
      cursor: pointer;
      opacity: 0;
      transition: opacity 0.3s ease;
    }
    .profile-card:hover .btn-upload {
      opacity: 1;
    }
    .menu {
      display: flex;
      flex-direction: column;
      width: 100%;
    }
    .menu a {
      padding: 15px 20px;
      text-decoration: none;
      color: white;
      transition: background 0.3s ease;
      display: block;
    }
    .menu a:hover,
    .menu a.active {
      background-color: rgba(255, 255, 255, 0.15);
    }
    .content {
      flex: 1;
      padding: 40px;
      background-color: #fff;
      color: #333;
    }
    @media (max-width: 768px) {
      .profile-container {
        flex-direction: column;
      }
      .sidebar {
        width: 100%;
        flex-direction: row;
        justify-content: space-around;
        padding: 10px 0;
      }
      .menu {
        flex-direction: row;
        overflow-x: auto;
        width: auto;
      }
      .menu a {
        padding: 10px;
        font-size: 14px;
        white-space: nowrap;
      }
      .content {
        padding: 20px;
      }
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile-card">
        <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('images/default-avatar.png') }}"
             alt="" class="avatar" id="profilePreview">
        <form id="uploadForm" action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" id="fileInput" name="photo" accept="image/*" style="display:none;" onchange="document.getElementById('uploadForm').submit();">
        </form>
        <button type="button" class="btn-upload" onclick="document.getElementById('fileInput').click();">
          <i class="fa-solid fa-camera"></i> Changer
        </button>
      </div>
      <nav class="menu">
        <a href="{{ route('profile') }}" class="{{ Request::route()->getName() == 'profile' ? 'active' : '' }}">Modifier le Profil</a>
        <a href="{{ route('logout') }}">Déconnexion</a>
      </nav>
    </aside>

    <!-- Contenu principal -->
    <div class="content">
      <h3>Informations du compte</h3>
      <ul>
        <li><strong>Email :</strong> {{ Auth::user()->email }}</li>
        <li><strong>Rôle :</strong> {{ Auth::user()->role }}</li>
        <li><strong>Date de création :</strong> {{ Auth::user()->created_at->format('d/m/Y') }}</li>
        <li><strong>Dernière mise à jour :</strong> {{ Auth::user()->updated_at->format('d/m/Y') }}</li>
      </ul>
    </div>
  </div>

  <script>
  document.getElementById('fileInput').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (!file) return;

    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const formData = new FormData();
    formData.append('photo', file);
    formData.append('_token', token);

    fetch("{{ route('profile.photo') }}", {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // côté Laravel, retourner JSON
    .then(data => {
        if (data.success) {
            document.getElementById('profilePreview').src = data.photo_url;
        } else {
            alert('Erreur : ' + data.message);
        }
    })
    .catch(err => alert("Erreur réseau"));
});

  </script>
</body>
</html>
