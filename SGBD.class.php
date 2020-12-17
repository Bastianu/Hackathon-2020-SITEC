<?php

/*$servername = "localhost";
$dbname = "test";
$username = "root";
$password = "";
$conn = new SGBD("mysql:host=$servername;dbname=$dbname;", $username, $password);*/

class SGBD extends PDO {
	/**
	 * Execute une requête SQL
	 * @param string $query Requête à executer
	 * @param array|null $param Parametres de la requete (null = pas de parametres)
	 * @param bool $ret Un retour est-il attendu? (True par défaut)
	 * @return array|null Retourne le resultat si $ret == true, sinon null
	 */
	public function request(string $query, ?array $param=null, bool $ret=true): ?array
    {
        if(is_null($param))
            $requete = $this->query($query);
        else {
            $requete = $this->prepare($query);
            $requete->execute($param);
        }

        if($ret)
            $ret = $requete->fetchall();
        else
            $ret = null;

        $requete->closeCursor();
        return $ret;
    }
};