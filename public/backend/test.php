<?php
header('Content-Type: application/json');

$dbh = new PDO($host, $user, $password);

/* --------------------------------------------------------------------------------------------- */
/*                                         GET DATA                                              */
/* --------------------------------------------------------------------------------------------- */

$stmt = $dbh->prepare("SELECT * FROM personne WHERE email = :email AND password = :password");
$stmt->execute([':email' => $_POST['email'], ':password' => $_POST['password']]);
$user = $sth->fetch(PDO::FETCH_COLUMN);

/* --------------------------------------------------------------------------------------------- */
/*                                        SEND DATA                                              */
/* --------------------------------------------------------------------------------------------- */

echo json_encode([
  'status' => 'ok',
  'content' => $user,
]);
