<?php
// Mot de passe à hasher
$password = '66vDqB5?P3nh;=';

// Générer le hash du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Afficher le résultat
echo "Mot de passe hashé : " . $hashedPassword;
?>

<br>
<br>
<br>


INSERT INTO users (username, password) VALUES ('jules', '$2y$10$bF6pR1wi17CX/k/wnjUlTO1yN96z91NBrQysiLEEAKPgmVTzR3L9O');



ALTER TABLE competences
ADD COLUMN category VARCHAR(50) NOT NULL AFTER icon;
