<?php

include('./../database/database.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    if (isset($_GET['IdProjet'])) {
        $idProjet = intval($_GET['IdProjet']);
        $project = $db->getProjectById($idProjet); // Fetch specific project
        echo json_encode($project);
    } else {
        $projects = $db->getProjects(); // Fetch all projects
        echo json_encode($projects);
    }
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Nom'], $_POST['Num'], $_POST['IdSpecialite'], $_POST['IdMembre'])) {
    header('Content-Type: application/json');
    $name = trim($_POST['Nom']);
    $num = intval($_POST['Num']);
    $startDate = $_POST['Debut'] ? $_POST['Debut'] : "";
    $endDate = $_POST['Fin'] ? $_POST['Fin'] : "";
    $specialiteId = intval($_POST['IdSpecialite']);
    $memberId = intval($_POST['IdMembre']);

    if (!empty($name) && $specialiteId > 0 && $memberId > 0) {
        if (isset($_GET['IdProjet'])) {
            $idProjet = intval($_GET['IdProjet']);
            $db->updateProject($idProjet, $name, $num, $startDate, $endDate, $specialiteId, $memberId); // Update project
        } else {
            $db->createProject($name, $num, $startDate, $endDate, $specialiteId, $memberId); // Create new project
        }

        $updatedProjects = $db->getProjects();
        echo json_encode(($updatedProjects)); // Return the last added/updated project
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['IdProjet'])) {
        $id = intval($_GET['IdProjet']);

        if ($id > 0) {
            if ($db->deleteProject($id)) {
                echo json_encode(['success' => 'Le projet a été supprimé avec succès.']);
                exit;
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la suppression du projet.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID invalide.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID du projet non fourni.']);
        exit;
    }
}
