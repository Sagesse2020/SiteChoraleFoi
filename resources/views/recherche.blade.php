<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rechercher</title>
</head>
<body>
      <form action="{{ route('recherche') }}" method="GET" style="margin-bottom: 20px;">
    <input type="text" name="query" placeholder="Rechercher..." value="{{ request('query') }}"
           style="padding: 8px; width: 250px; border-radius: 5px; border: 1px solid #ccc;">
    <button type="submit"
            style="padding: 8px 12px; border: none; background-color: #007bff; color: white; border-radius: 5px;">
        Rechercher
    </button>
</form>
</body>
</html>
