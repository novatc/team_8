<?php

$user = 'root';
$pw = null;
$dsn = 'sqlite:DUMMYdatabase.db';
$db = new PDO( $dsn, $user, $pw );

$sql = 'INSERT INTO user (name) VALUES (:feldwert);';
$kommando = $db->prepare( $sql );

$wert = 'Wert12';
$kommando->bindParam( ':feldwert', $wert );
$kommando->execute();
echo 'Daten eingetragen.';

$wert = 'Wert13';
$kommando->bindParam( ':feldwert', $wert );
$kommando->execute();
echo 'Daten eingetragen.';

$sql = 'SELECT id, name FROM user WHERE id > ?;';
$kommando = $db->prepare( $sql );
$wert = 8;
$kommando->execute( array( $wert ) );
echo '<ul>';
while ( $zeile = $kommando->fetchObject() ) {

    echo '<li>' . htmlspecialchars( $zeile->id ) .
        ': ' . htmlspecialchars( $zeile->name ) . '</li>';
}
echo '</ul>';
?>