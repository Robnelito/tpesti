<?php

include ('./../database/database.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    $partners = $db->getPartners(); // Fetch all partners
    echo json_encode($partners);
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['partnerName'], $_POST['partnerDescription'])) {
    header('Content-Type: application/json');
    $partnerName = trim($_POST['partnerName']);
    $partnerDescription = trim($_POST['partnerDescription']);

    if (!empty($partnerName)) {
        if (isset($_GET['IdPartenaires_'])) {
            $idPartner = (int) $_GET['IdPartenaires_'];
            $db->updatePartner($idPartner, $partnerName, $partnerDescription); // Update partner
        } else {
            $db->createPartner($partnerName, $partnerDescription); // Create new partner
        }

        $updatedPartners = $db->getPartners();
        echo json_encode(($updatedPartners)); // Return the last added/updated partner
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['IdPartenaires_'])) {
        $id = intval($_GET['IdPartenaires_']);

        if ($id > 0) {
            if ($db->deletePartner($id)) {
                echo json_encode(['success' => 'Le partenaire a été supprimé avec succès.']);
                exit;
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la suppression du partenaire.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID invalide.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID du partenaire non fourni.']);
        exit;
    }
}
