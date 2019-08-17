<?php

namespace App\Models;

use PDO;
use App\Models\Article;

abstract class Model
{
    protected $pdo;

    protected function setPdo()
    {
        if (!$this->pdo) {
            // $dsn = 'mysql:dbname=miniblog;host=localhost;charset=utf8';
            // $user = 'root';
            // $password = '';
            
            $this->pdo = new PDO(DSN, USER, PASSWORD);
        }

        return $this->pdo;
    }

    protected function getAll($table)
    {
        $pdo = $this->setPdo();

        $sql = 'SELECT * FROM ' . $table;

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $data = $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    protected function getLast($table, $limit)
    {
        $pdo = $this->setPdo();

        $sql = "SELECT * FROM $table ORDER BY $table.id DESC LIMIT :limit"; 

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $data = $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    protected function getOneById($table, $id)
    {
        $pdo = $this->setPdo();

        $sql = "SELECT * FROM $table WHERE $table.id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $data = $stmt->fetchAll(PDO::FETCH_CLASS);
    }

    protected function editOneById($table, $id, $dataToEdit)
    {
        $pdo = $this->setPdo();

        $keys = array_keys($dataToEdit);
        $keysIntermerdiate = array_keys($dataToEdit);
        $lastKey = array_pop($keysIntermerdiate);

        $sql = "UPDATE $table SET ";

        $i = 0;
        foreach ($dataToEdit as $key => $value) {
            $i++;
            if ($key !== $lastKey) {
                $sql .= "$key = :value$i, ";

            } else  {
                $sql .= "$key = :value$i";

            }
        }

        $stmt = $pdo->prepare($sql);

        $k = 0;
        for ($j = 1; $j <= $i; $j++) {
            $stmt->bindValue(":value$j", $dataToEdit[$keys[$k]]);
            $k++;
        }

        $stmt->execute();
    }

    protected function createOne($table, $dataToCreate)
    {
        $pdo = $this->setPdo();

        $keys = array_keys($dataToCreate);
        $nbKeys = count($keys);
        $keysIntermediate = array_keys($dataToCreate);
        $lastKey = array_pop($keysIntermediate);

        $sql = "INSERT INTO $table (";

        // ATTRIBUTES NAMES
        for ($i = 0; $i < $nbKeys; $i++)
        {
            if ($keys[$i] !== $lastKey) {
                $sql .= "$keys[$i], ";

            } else {
                $sql .= "$keys[$i]) ";

            }
        }

        // VALUES DATA
        $sql .= "VALUES (";

        for ($i = 0; $i < $nbKeys; $i++)
        {
            $j = $i + 1;
            if ($keys[$i] !== $lastKey) {
                $sql .= " :value$j,";

            } else {
                $sql .= " :value$j);";

            }
        }

        $stmt = $pdo->prepare($sql);

        $k = 1;
        foreach($dataToCreate as $value) {
            $stmt->bindValue(":value$k", $value);

            $k++;
        }

        $stmt->execute();
    }

    protected function deleteById($table, $id)
    {
        $pdo = $this->setPdo();

        $sql = "DELETE FROM $table WHERE id = :id";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    protected function dataToObject($arrayData, $object)
    {
        if (!empty($arrayData)) {
            foreach($arrayData as $data) {
                $objects[] = new Article($data);
            }

            return $objects;
        }

        return [];
    }
}
