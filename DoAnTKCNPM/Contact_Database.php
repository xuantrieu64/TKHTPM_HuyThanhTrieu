<?php
require_once 'Database.php';

class Contact_Database extends Database
{
    public function addContact($ho_ten, $sdt, $email, $van_de, $y_kien)
    {
        $sql = self::$connection->prepare("INSERT INTO chamsoc (`ho_ten`, `sdt`, `email`, `van_de`, `y_kien`) VALUES(?, ?, ?, ?, ?)");
        $sql->bind_param("sssss", $ho_ten, $sdt, $email, $van_de, $y_kien);
        $result = $sql->execute();
        return $result;
    }
}