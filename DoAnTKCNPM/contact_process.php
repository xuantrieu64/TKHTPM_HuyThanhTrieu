<?php
require_once 'Contact_Database.php';
$contact_database = new Contact_Database();

if (isset($_SERVER['REQUEST_METHOD']) == 'POST') {
    $ho_ten = $_POST['ho_ten'];
    $email = $_POST['email'];
    $van_de = $_POST['van_de'];
    $sdt = $_POST['sdt'];
    $y_kien = $_POST['y_kien'];

    $contact_database->addContact($ho_ten, $sdt, $email, $van_de, $y_kien);
    header('Location:contact.php');
}
