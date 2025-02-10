<?php
// Mot de passe à hasher
$password = 'admin';

// Générer le hash du mot de passe
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Afficher le résultat
echo "Mot de passe hashé : " . $hashedPassword;
?>

<br>
<br>
<br>

$2y$10$l3xx4QSTwbSv5vyTs4LNXerg5T6l/SKDNJ8rxlMJmxnwTr5.PXrTK

INSERT INTO users (username, password) VALUES ('admin', '$2y$10$T9nbeeL48apwkkdSl2hZNeBg47Rl2NunWaAD92Hs35vZiwatUoC.W');



