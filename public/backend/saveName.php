<?php
header('Access-Control-Allow-Origin: http://localhost:8080');
header("Access-Control-Allow-Headers: content-type");

// -------------- ERROR HANDLING --------------
if (empty($_POST['name'])) {
  exit(json_encode(['status' => 'error', 'message' => 'Le nom est manquant']));
}

// -------------- DATA IN DB (SIMULATION) --------------

// -------------- RESPONSE --------------

echo json_encode(['status' => 'success']);