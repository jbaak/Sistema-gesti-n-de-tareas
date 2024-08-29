<?php
class User
{

    public function getByUserame($username)
    {
        $db = DB::getInstance();

        // Sentencia preparada para prevenir inyección SQL
        $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');

        // Vinculamos el parámetro :username
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        $user = $stmt->fetch();

        // Retornamos instancia de user o null si no existe
        if ($user) {
            return $user;
        } else {
            return null;
        }
    }

    public function save($username, $password) {
        $db = DB::getInstance();

        $stmt = $db->prepare('INSERT INTO users(username, password) VALUES( :username, :password)');

        //le aplicamos un hash a la contraseña
        $password = password_hash($password, PASSWORD_DEFAULT);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password );

        if ($stmt->execute()) {
            return  $db->lastInsertId();
        }
        return null;
    }
}