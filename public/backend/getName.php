<?php
header('Access-Control-Allow-Origin: http://localhost:8080');
header('Content-Type: application/json');

// -------------- ERROR HANDLING --------------
if (empty($_GET['id'])) {
  exit(json_encode(['status' => 'error', 'message' => 'L\'id est manquant']));
}

if ($_GET['id'] < 1 || $_GET['id'] > 7) {
  exit(json_encode(['status' => 'error', 'message' => 'L\'id est invalide']));
}

// -------------- DATA IN DB (SIMULATION) --------------

$names = [1 => 'Stephan', 2 => 'Sébastien', 3=> 'Pascal', 4 => 'Rachid', 5 => 'Imad', 6 => 'Cédrick', 7 => 'Mohammed'];

// -------------- RESPONSE --------------

echo json_encode(['status' => 'success', 'message' => $names[$_GET['id']]]);