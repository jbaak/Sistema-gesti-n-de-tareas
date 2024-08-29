<?php
class Task
{
    public  function getTaskByIdUser($idUser)
    {
        $db = DB::getInstance();
        $stmt = $db->prepare('SELECT * FROM tasks where id_user=:idUser');
        $stmt->bindParam(':idUser', $idUser);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public  function getById($id)
    {
        $db = DB::getInstance();

        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('SELECT * FROM tasks WHERE id = :id');

        // Vinculamos el parámetro :id
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $task = $stmt->fetch();

        // Retornamos instancia de $task o null si no existe
        if ($task) {
            return $task;
        } else {
            return null;
        }
    }

    public function save($title, $description, $status, $idUser) {
        $db = DB::getInstance();

        $stmt = $db->prepare('INSERT INTO tasks(title, description, status, id_user) VALUES( :title, :description, :status, :idUser)');

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description );
        $stmt->bindParam(':status', $status );
        $stmt->bindParam(':idUser', $idUser);

        if ($stmt->execute()) {
            return  $db->lastInsertId();
        }
        return null;

    }

    public function update($id, $data) {
        $db = DB::getInstance();

        $stmt = $db->prepare('UPDATE tasks SET title=:title, description = :description, status=:status WHERE id=:id');

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':description', $data['description'] );
        $stmt->bindParam(':status', $data['status'] );
        $stmt->bindParam(':id', $id );
        $stmt->execute();
    }

    public function delete($id) {
        $db = DB::getInstance();
        $stmt = $db->prepare("DELETE from tasks WHERE id=:id");
        $stmt->bindParam(':id', $id );
        $stmt->execute();
    }
}