<?php

class MembreManager extends DatabaseConnection
{
    public function getMembers()
    {
        $sql = "SELECT * FROM membre";
        return $this->executeQuery($sql);
    }

    public function getMemberById($idMembre)
    {
        $sql = "SELECT * FROM membre WHERE IdMembre = :idMembre";
        $params = [':idMembre' => $idMembre];
        return $this->executeQuery($sql, $params);
    }

    public function createMember($prenom, $nom, $specialiteId)
    {
        $sql = "INSERT INTO membre (Prenom, Nom, IdSpecialite) VALUES (:prenom, :nom, :specialiteId)";
        $params = [
            ':prenom' => $prenom,
            ':nom' => $nom,
            ':specialiteId' => $specialiteId,
        ];
        return $this->executeNonQuery($sql, $params);
    }

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

    public function deleteMember($idMembre)
    {
        $sql = "DELETE FROM membre WHERE IdMembre = :idMembre";
        $params = [':idMembre' => $idMembre];
        return $this->executeNonQuery($sql, $params);
    }
}
