<?php

class SpecialiteManager extends DatabaseConnection
{
    public function getSpecialties()
    {
        $sql = "SELECT * FROM specialite";
        return $this->executeQuery($sql);
    }

    public function getSpecialtyById($idSpecialite)
    {
        $sql = "SELECT * FROM specialite WHERE IdSpecialite = :idSpecialite";
        $params = [':idSpecialite' => $idSpecialite];
        return $this->executeQuery($sql, $params);
    }

    public function createSpecialite($intitule)
    {
        $sql = "INSERT INTO specialite (Intitule) VALUES (:intitule)";
        $params = [':intitule' => $intitule];
        return $this->executeNonQuery($sql, $params);
    }

    public function editSpecialite($idSpecialite, $intitule)
    {
        $sql = "UPDATE specialite SET Intitule = :intitule WHERE IdSpecialite = :id";
        $params = [
            ':intitule' => $intitule,
            ':id' => $idSpecialite,
        ];
        return $this->executeNonQuery($sql, $params);
    }

    public function deleteSpecialite($idSpecialite)
    {
        $sql = "DELETE FROM specialite WHERE IdSpecialite = :idSpecialite";
        $params = [':idSpecialite' => $idSpecialite];
        return $this->executeNonQuery($sql, $params);
    }
}
