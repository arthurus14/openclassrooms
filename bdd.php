<h2>tri les films où "Smith" a joué</h2>
<?php 
ini_set('display_errors', 1);
$bdd = new PDO('mysql:host=localhost;dbname=filmCnam;charset=utf8','root','root');

$nom ="Smith";

//inner join

$film = $bdd->query('SELECT *
	FROM acteur  INNER JOIN aTourneDans ON acteur.numActeur = aTourneDans.numActeur 
	INNER JOIN film ON film.numFilm = aTourneDans.numFilm  
	WHERE acteur.nom = "'.$nom.'"
');

foreach($film as $acteur){

	echo $acteur['nomFilm']. " ".$acteur['budget']. " ".$acteur['nom']." </br>";



}
?>
<hr>
<h2>Tri les acteurs ayant joués dans "les évadés d'Alcatraz"</h2>

<?php 
ini_set('display_errors', 1);
$bdd = new PDO('mysql:host=localhost;dbname=filmCnam;charset=utf8','root','root');

$film ="les évadés d'Alcatraz";

//inner join

$film = $bdd->query('SELECT *
	FROM acteur  INNER JOIN aTourneDans ON acteur.numActeur = aTourneDans.numActeur 
	INNER JOIN film ON film.numFilm = aTourneDans.numFilm  
	WHERE film.nomFilm = "'.$film.'"
');

foreach($film as $acteur){

	echo $acteur['nomFilm']. " acteur: ".$acteur['nom']." </br>";



}
?>

<hr>
<h2>modifie un nom mal orthographié</h2>
<?php 
ini_set('display_errors', 1);


$nomModif ="SMITH";
$bdd = new PDO('mysql:host=localhost;dbname=filmCnam;charset=utf8','root','root');
			
			$requete=$bdd->prepare('UPDATE acteur SET nom=:nom WHERE nom = "Smith"');

			$requete->execute(array('nom'=>$nomModif));

	echo "modification effectuée";
?>
<hr> 
<h2>Tri les dépense "Hôtel" > à 100 €</h2>
<?php
//select avec conditions 
ini_set('display_errors', 1);
$bdd = new PDO('mysql:host=localhost;dbname=frais;charset=utf8','root','root');


//inner join

$frais = $bdd->query('SELECT *
	FROM salarie  INNER JOIN depense ON salarie.codeSalarie = depense.codeDepense 
	WHERE depense.natureDep = "Hôtel" AND depense.montantDep > 100
	
');

foreach($frais as $salarie){

	echo $salarie['nom']. " </br>";



}
?>
<hr> 
<h2>Affiche les dépenses de tous les salariés</h2>
<?php
//Liste des dépenses
ini_set('display_errors', 1);
$bdd = new PDO('mysql:host=localhost;dbname=frais;charset=utf8','root','root');


//inner join

$frais = $bdd->query('SELECT *
	FROM salarie  INNER JOIN depense ON salarie.codeSalarie = depense.codeDepense 
	
	
');

foreach($frais as $salarie){

	echo $salarie['nom']. "<br/> " .$salarie['natureDep']. " " .$salarie['montantDep'].
	" € " .$salarie['dateDepense']. " " .$salarie['TVADep']. 


	 " € </br>
	 TOTAL TTC: " .($salarie['montantDep'] + $salarie['TVADep'])." €<br/>";



}
?>