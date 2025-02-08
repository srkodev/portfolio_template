<?php
// Mot de passe à hasher
$password = 'c76FcA2c)9U+%p';

// Générer le hash du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Afficher le résultat
echo "Mot de passe hashé : " . $hashedPassword;
?>



$2y$10$l3xx4QSTwbSv5vyTs4LNXerg5T6l/SKDNJ8rxlMJmxnwTr5.PXrTK

INSERT INTO users (username, password) VALUES ('alexandre', '$2y$10$l3xx4QSTwbSv5vyTs4LNXerg5T6l/SKDNJ8rxlMJmxnwTr5.PXrTK');



c76FcA2c)9U+%p