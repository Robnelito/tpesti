<?php

include('./../database/database.php');
$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    header('Content-Type: application/json');
    if (isset($_GET['IdTache'])) {
        $idTache = intval($_GET['IdTache']);
        $task = $db->getTaskById($idTache);
        echo json_encode($task);
    } else {
        $tasks = $db->getTasks();
        echo json_encode($tasks);
    }
    return;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Nom'], $_POST['Mun'], $_POST['IdProjet'])) {
    header('Content-Type: application/json');
    $name = trim($_POST['Nom']);
    $mun = intval($_POST['Mun']);
    $startDate = $_POST['Debut'] ? $_POST['Debut'] : "";
    $endDate = $_POST['Fin'] ? $_POST['Fin'] : "";
    $projectId = intval($_POST['IdProjet']);

    if (!empty($name) && $projectId > 0) {
        if (isset($_GET['IdTache'])) {
            $idTache = intval($_GET['IdTache']);
            $db->updateTask($idTache, $name, $mun, $startDate, $endDate);
        } else {
            $db->createTask($name, $mun, $startDate, $endDate, $projectId);
        }

        $updatedTasks = $db->getTaskById($idTache);
        echo json_encode(($updatedTasks));
        exit;
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Tous les champs sont obligatoires.']);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    if (isset($_GET['IdTache'])) {
        $id = intval($_GET['IdTache']);

        if ($id > 0) {
            if ($db->deleteTask($id)) {
                echo json_encode(['success' => 'La tâche a été supprimée avec succès.']);
                exit;
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Erreur lors de la suppression de la tâche.']);
                exit;
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'ID invalide.']);
            exit;
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID de la tâche non fourni.']);
        exit;
    }
}
