<?php

function getConnection()
{
  include_once 'bdd.php';
  
  // Connexion a la base de donnees
  try {
    	$dbh = new PDO('mysql:host='.$sql['server'].';dbname='.$sql['database'], $sql['login'], $sql['pass']);
    	return $dbh;
  }
  catch (PDOException $e) {
  		echo '<p class="error">L\'erreur a ete signalee aux administrateurs. <br> <br>Merci de reesayer ulterieurement. <br><br> Erreur BDD0101</p>';
    	exit;
  }
}

function execSql (PDO $connection, string $sql): array
{
    $req = $pdo->prepare($sql);
    $req->execute();
    $res = $req->fetchAll();
    $req->closeCursor();
    return res;
}
