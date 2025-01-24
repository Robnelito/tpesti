<?php

include ('./../database/database.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    $specialties = $db->getSpecialties();
    echo json_encode($specialties);
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['specialiteIntitule'])) {
    header('Content-Type: application/json');
    $specialiteName = trim($_POST['specialiteIntitule']);

    if (!empty($specialiteName)) {
        if (isset($_GET['IdSpecialite'])) {
            $idSpécialité = (int) $_GET['IdSpecialite'];
            $db->editSpecialite($idSpécialité, $specialiteName);
        } else {
            $db->createSpecialite($specialiteName);
        }

        $newSpecialite = $db->getSpecialties();
        echo json_encode(($newSpecialite));
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['IdSpecialite'])) {
        $id = intval($_GET['IdSpecialite']);

        if ($id > 0) {
            if ($db->deleteSpecialite($id)) {
                echo json_encode(['success' => 'La spécialité a été supprimée avec succès.']);
                exit;
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la suppression de la spécialité.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID invalide.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID de la spécialité non fourni.']);
        exit;
    }
}