<?php

include ('./../database/database.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    if (isset($_GET['IdMembre'])) {
        $idMembre = intval($_GET['IdMembre']);
        $member = $db->getMembers(); // Ajouter une méthode pour récupérer un membre spécifique
        echo json_encode($member);
    } else {
        $members = $db->getMembers();
        echo json_encode($members);
    }
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['prenom'], $_POST['nom'], $_POST['specialiteId'])) {
    header('Content-Type: application/json');
    $prenom = trim($_POST['prenom']);
    $nom = trim($_POST['nom']);
    $specialiteId = intval($_POST['specialiteId']);

    if (!empty($prenom) && !empty($nom) && $specialiteId > 0) {
        if (isset($_GET['IdMembre'])) {
            $idMembre = intval($_GET['IdMembre']);
            $db->editMember($idMembre, $prenom, $nom, $specialiteId); // Ajouter la méthode `editMember`
        } else {
            $db->createMember($prenom, $nom, $specialiteId);
        }

        $updatedMembers = $db->getMembers();
        echo json_encode(($updatedMembers));
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['IdMembre'])) {
        $id = intval($_GET['IdMembre']);

        if ($id > 0) {
            if ($db->deleteMember($id)) { // Ajouter une méthode pour supprimer un membre spécifique
                echo json_encode(['success' => 'Le membre a été supprimé avec succès.']);
                exit;
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la suppression du membre.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID invalide.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID du membre non fourni.']);
        exit;
    }
}
