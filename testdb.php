<?php
$dsn  = 'pgsql:host=dpg-d2jnkhbipnbc73bdr3hg-a;port=5432;dbname=chorale_db;sslmode=require';
$user = 'chorale_db_b3ml_user';
$pass = '558VX26kDWeUS8tWC33veEc4kf0SsxtWP';

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Connexion OK !\n";
    $now = $pdo->query('select now()')->fetchColumn();
    echo "Heure serveur: $now\n";
} catch (PDOException $e) {
    echo "ERREUR PDO: " . $e->getMessage() . "\n";
}
