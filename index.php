<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 14/01/2019
 * Time: 10:06
 */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "colyseum";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
} else {
// Selectionner la base à utiliser
    $conn->select_db($dbname);

}


function afficherNom()
{
    global $conn;
    $sql = "SELECT * FROM clients";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo $row['firstName'] . " " . $row['lastName'] . "<br>";
    }
    echo "<br>";
}

afficherNom();

function spectacle()
{
    global $conn;
    $sql = "SELECT * FROM showtypes";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo $row['type'] . "<br>";
    }
    echo "<br>";
}

spectacle();

function afficheVingtNom()
{

    global $conn;
    $sql = "SELECT * FROM clients order by id asc limit 20";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo $row['firstName'] . " " . $row['lastName'] . "<br>";

    }
    echo "<br>";
}

afficheVingtNom();

function carteFidelité()
{
    global $conn;
    $sql = "SELECT * FROM clients, cards where clients.cardNumber = cards.cardNumber and cards.cardTypesId = 1";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        if ($row['card'] == 1) {
            echo $row['firstName'] . " " . $row['lastName'] . "<br>";
        }
    }
    echo "<br>";
}

carteFidelité();

function nomParM()
{
    global $conn;
    $sql = "SELECT * FROM clients where lastName like 'm%' order by lastName";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "Nom: " . $row['lastName'] . "<br>" . "Prénom: " . $row['firstName'] . "<br>";
    }
    echo "<br>";
}

nomParM();

function afficheSpectacle()
{
    global $conn;
    $sql = "SELECT * FROM shows order by title";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        echo "spectacle: " . $row['title'] . "<br>" . "artiste: " . $row['performer'] . "<br>" . "date: " . $row['date'] . "<br>" . "heure :" . $row['startTime'] . "<br>";
    }

}

afficheSpectacle();

function last()
{
    global $conn;
    $sql = "SELECT * FROM clients left join cards on (cards.cardNumber = clients.cardNumber) where 1";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {

        if ($row['cardTypesId'] == 1) {

            $ana = "oui";
            $anae = $row['cardNumber'];

        } else {

            $ana = "non";
            $anae = "";
        };

        echo "nom:" . $row['firstName'] . " " . "prénom: " . $row['lastName'] . "date de naissance: " . $row['birthDate'] . "<br>" . $ana . "<br>"."numéro de carte: ". $anae."<br>";

    };

}

last();
