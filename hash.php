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

$2y$10$l3xx4QSTwbSv5vyTs4LNXerg5T6l/SKDNJ8rxlMJmxnwTr5.PXrTK

INSERT INTO users (username, password) VALUES ('jules', '$2y$10$BCp90WqEFyT4P24rBbJqM.VqwpD6CkCOEeRTpYNreh6MTGSysM5VC
');



