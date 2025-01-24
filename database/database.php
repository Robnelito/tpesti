<?php

class Database
{
    private $host = "localhost";
    private $dbName = "testEsti";
    private $username = "root";
    private $password = "";
    private $conn;

    public function __construct()
    {
        // Initialize connection on instantiation
        $this->connection();
    }

    private function connection()
    {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->dbName}",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                error_log("Database connection failed: " . $e->getMessage());
                die("Database connection error. Please try again later.");
            }
        }
    }

    public function closeConnection()
    {
        $this->conn = null;
    }

    private function executeQuery($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query execution failed: " . $e->getMessage());
            return [];
        }
    }

    private function executeNonQuery($sql, $params = [])
    {
        try {
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            error_log("Non-query execution failed: " . $e->getMessage());
            return false;
        }
    }

    // Fetch all projects
    public function getProjects()
    {
        $sql = "SELECT * FROM Projet";
        return $this->executeQuery($sql);
    }

    // Create a new project
    public function createProject($name, $num, $startDate, $endDate, $specialiteId, $memberId)
    {
        $sql = "INSERT INTO Projet (Nom, Num, Debut, Fin, IdSpecialite, IdMembre)
                VALUES (:name, :num, :startDate, :endDate, :specialiteId, :memberId)";
        $params = [
            ':name' => $name,
            ':num' => $num,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':specialiteId' => $specialiteId,
            ':memberId' => $memberId,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    public function updateProject($idProjet, $name, $num, $startDate, $endDate, $specialiteId, $memberId)
    {
        $sql = "UPDATE projet 
                SET Nom = :name, Num = :num, Debut = :startDate, Fin = :endDate, 
                    IdSpecialite = :specialiteId, IdMembre = :memberId 
                WHERE IdProjet = :idProjet";
        $params = [
            ':name' => $name,
            ':num' => $num,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':specialiteId' => $specialiteId,
            ':memberId' => $memberId,
            ':idProjet' => $idProjet,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    public function deleteProject($idProjet)
    {

        // Delete related tasks
        $this->deleteTaskRelatedToProject($idProjet);

        $sql = "DELETE FROM projet WHERE IdProjet = :idProjet";
        $params = [':idProjet' => $idProjet];
        return $this->executeNonQuery($sql, $params);
    }

    public function getProjectById($idProjet)
    {
        $sql = "SELECT * FROM projet WHERE IdProjet = :idProjet";
        $params = [':idProjet' => $idProjet];
        return $this->executeQuery($sql, $params);
    }

    // Delete all projects
    public function deleteProjectRelatedToSpecialite($idSpecialite)
    {
        $sql = "DELETE FROM projet WHERE IdSpecialite = :idSpecialite";
        $params = [
            ':idSpecialite' => $idSpecialite,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    public function deleteMemberRelatedToSpecialite($idSpecialite)
    {
        $sql = "DELETE FROM membre WHERE IdSpecialite = :idSpecialite";
        $params = [
            ':idSpecialite' => $idSpecialite,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Fetch all specialties
    public function getSpecialties()
    {
        $sql = "SELECT * FROM specialite";
        return $this->executeQuery($sql);
    }

    public function getSpecialtyById($idSpecialite)
    {
        $sql = "SELECT * FROM specialite WHERE IdSpecialite = :idSpecialite";
        $params = [
            ':idSpecialite' => $idSpecialite
        ];
        return $this->executeQuery($sql, $params);
    }

    // Create a new specialite
    public function createSpecialite($intitule)
    {
        $sql = "INSERT INTO specialite (Intitule) VALUES (:intitule)";
        $params = [':intitule' => $intitule];
        return $this->executeNonQuery($sql, $params);
    }

    // Delete specialite
    public function deleteSpecialite($idSpecialite)
    {
        // Delete related projet
        $this->deleteProjectRelatedToSpecialite($idSpecialite);
        $this->deleteMemberRelatedToSpecialite($idSpecialite);

        $sql = "DELETE FROM specialite WHERE IdSpecialite = :idSpecialite";
        $params = [':idSpecialite' => $idSpecialite];
        return $this->executeNonQuery($sql, $params);
    }

    // Edit || Update specialite
    public function editSpecialite($idSpecialite, $intitule)
    {
        $sql = "UPDATE specialite SET Intitule = :intitule WHERE IdSpecialite = :id";
        $params = [
            ':intitule' => $intitule,
            ':id' => $idSpecialite,
        ];
        return $this->executeNonQuery($sql, $params);
    }


    // Fetch all members
    public function getMembers()
    {
        $sql = "SELECT * FROM Membre";
        return $this->executeQuery($sql);
    }

    // Create a new member
    public function createMember($prenom, $nom, $specialiteId)
    {
        $sql = "INSERT INTO Membre (Prenom, Nom, IdSpecialite) VALUES (:prenom, :nom, :specialiteId)";
        $params = [
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':specialiteId' => $specialiteId,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Edit || Update a member
    public function editMember($idMembre, $prenom, $nom, $specialiteId)
    {
        $sql = "UPDATE membre 
                SET Prenom = :prenom, Nom = :nom, IdSpecialite = :specialiteId 
                WHERE IdMembre = :idMembre";
        $params = [
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':specialiteId' => $specialiteId,
            ':idMembre' => $idMembre,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Delete a member
    public function deleteMember($idMembre)
    {
        $sql = "DELETE FROM membre WHERE IdMembre = :idMembre";
        $params = [':idMembre' => $idMembre];
        return $this->executeNonQuery($sql, $params);
    }

    // Fetch a specific member by ID
    public function getMemberById($idMembre)
    {
        $sql = "SELECT * FROM membre WHERE IdMembre = :idMembre";
        $params = [':idMembre' => $idMembre];
        return $this->executeQuery($sql, $params);
    }

    // Fetch all tasks
    public function getTasks()
    {
        $sql = "SELECT * FROM tache";
        return $this->executeQuery($sql);
    }

    // Create a new task
    public function createTask($name, $mun, $startDate, $endDate, $projectId)
    {
        $sql = "INSERT INTO tache (Nom, Mun, Début, Fin, IdProjet) 
                VALUES (:name, :mun, :startDate, :endDate, :projectId)";
        $params = [
            ':name' => $name,
            ':mun' => $mun,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':projectId' => $projectId,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Update a task
    public function updateTask($idTache, $name, $mun, $startDate, $endDate)
    {
        $sql = "UPDATE tache 
                SET Nom = :name, Mun = :mun, Début = :startDate, Fin = :endDate 
                WHERE IdTache = :idTache";
        $params = [
            ':name' => $name,
            ':mun' => $mun,
            ':startDate' => $startDate,
            ':endDate' => $endDate,
            ':idTache' => $idTache,
        ];
        return $this->executeNonQuery($sql, $params);
    }


    // Delete a task
    public function deleteTask($idTache)
    {
        $sql = "DELETE FROM tache WHERE IdTache = :idTache";
        $params = [':idTache' => $idTache];
        return $this->executeNonQuery($sql, $params);
    }

    public function deleteTaskRelatedToProject($idProjet)
    {
        $sql = "DELETE FROM tache WHERE IdProjet = :idProjet";
        $params = [':idProjet' => $idProjet];
        return $this->executeNonQuery($sql, $params);
    }

    // Fetch all associations
    public function getAssociations()
    {
        $sql = "SELECT * FROM estassocie";
        return $this->executeQuery($sql);
    }

    // Fetch task by ID
    public function getTaskById($idTache)
    {
        $sql = "SELECT * FROM tache WHERE IdTache = :idTache";
        $params = [':idTache' => $idTache];
        return $this->executeQuery($sql, $params);
    }


    // Create a new association
    public function createAssociation($projectId, $partnerId, $role)
    {
        $sql = "INSERT INTO estassocie (IdProjet, IdPartenaires_, Role) 
                VALUES (:projectId, :partnerId, :role)";
        $params = [
            ':projectId' => $projectId,
            ':partnerId' => $partnerId,
            ':role' => $role,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Delete an association
    public function deleteAssociation($projectId, $partnerId)
    {
        $sql = "DELETE FROM estassocie 
                WHERE IdProjet = :projectId AND IdPartenaires_ = :partnerId";
        $params = [
            ':projectId' => $projectId,
            ':partnerId' => $partnerId,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Fetch all participations
    public function getParticipations()
    {
        $sql = "SELECT * FROM participe";
        return $this->executeQuery($sql);
    }

    // Create a new participation
    public function createParticipation($memberId, $taskId, $function)
    {
        $sql = "INSERT INTO participe (IdMembre, IdTache, Fonction) 
                VALUES (:memberId, :taskId, :function)";
        $params = [
            ':memberId' => $memberId,
            ':taskId' => $taskId,
            ':function' => $function,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Delete a participation
    public function deleteParticipation($memberId, $taskId)
    {
        $sql = "DELETE FROM participe 
                WHERE IdMembre = :memberId AND IdTache = :taskId";
        $params = [
            ':memberId' => $memberId,
            ':taskId' => $taskId,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Fetch all partners
    public function getPartners()
    {
        $sql = "SELECT * FROM partenaire";
        return $this->executeQuery($sql);
    }

    // Create a new partner
    public function createPartner($name, $description)
    {
        $sql = "INSERT INTO partenaire (Nom, Description) VALUES (:name, :description)";
        $params = [
            ':name' => $name,
            ':description' => $description,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Update an existing partner
    public function updatePartner($id, $name, $description)
    {
        $sql = "UPDATE partenaire SET Nom = :name, Description = :description WHERE IdPartenaires_ = :id";
        $params = [
            ':id' => $id,
            ':name' => $name,
            ':description' => $description,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    // Delete a partner
    public function deletePartner($id)
    {
        $sql = "DELETE FROM partenaire WHERE IdPartenaires_ = :id";
        $params = [':id' => $id];
        return $this->executeNonQuery($sql, $params);
    }

    // Fetch a specific partner by ID
    public function getPartnerById($id)
    {
        $sql = "SELECT * FROM partenaire WHERE IdPartenaires_ = :id";
        $params = [':id' => $id];
        return $this->executeQuery($sql, $params);
    }

    // Add error logging for better debugging
    private function logError($message)
    {
        error_log($message, 3, "error_log.txt"); // Log errors to a file
    }
}
