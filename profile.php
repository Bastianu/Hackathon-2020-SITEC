<?php
// Starting sessions
session_start();

//initializing errors
ini_set('display_errors', '1');

/* -------------------------- Constants definitions ------------------------- */
define("ROOT", dirname(__FILE__).DIRECTORY_SEPARATOR);
define("MODEL", ROOT."model".DIRECTORY_SEPARATOR);

/* ----------------------------- Files includes ----------------------------- */
require_once ROOT."config.php";
require_once ROOT."class/SGBD.class.php";
require_once ROOT."vendor/autoload.php";

$sgbd = new SGBD(
    "mysql:host=".DB_CFG['HOST'].";dbname=".DB_CFG['DB_NAME'],
    DB_CFG['USER'],
    DB_CFG['PASSWORD']
);

$user = $sgbd->request("SELECT * FROM user WHERE email=?",array($_SESSION["user"]["email"]))[0];
//echo $user[0]["id"];  
//print_r($user);
if(isset($_POST["updateUser"])){
   
    $firstname = (isset($_POST['firstname']) && $_POST['firstname']!="") ? $_POST['firstname'] : $user["firstname"];
    $lastname = (isset($_POST['lastname']) && $_POST['lastname']!="") ? $_POST['lastname'] : $user["lastname"];
    $email = (isset($_POST['email']) && $_POST['email']!="") ? $_POST['email'] : $user["email"];

    $sgbd->request("UPDATE user SET firstname = '$firstname', lastname = '$lastname', email = '$email' WHERE email=?", array($_SESSION["user"]["email"]) );

    header("refresh:0");    
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <title>Hackathon 2020</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
<span class="border border-primary">

    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">Hackathon 2020</a>
                </div>
                <ul class="nav navbar-nav">
                <li><a href="home.php">Home</a></li>
                <li class="active"><a href="profile.php">Mon profil</a></li>
                <li><a href="vendors.php">Vendors</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-4">
            <?php
            echo "Nom : ".$user['lastname']."<br>
                  Prenom : ".$user['firstname']."<br>
                  email : ".$user['email']."<br>";

            ?>
        </div>
        <div class="col-sm-4">
            <button class="btn btn-light" onclick="showdiv('modifuser')">Modifier vos données personnelles</button> 
            <div id="modifuser" style="display:none">
            <br>
                <form action="?" method="POST">
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" placeholder="Entrez votre prénom" name="firstname">
                    </div>  
                    <div class="form-group">
                    <label for="firstname">Nom</label>
                        <input type="text" placeholder="Entrez votre nom" name="lastname">
                    </div>
                    <div class="form-group">
                    <label for="firstname">Email</label>
                        <input type="text" placeholder="Entrez votre email" name="email">
                    </div>
                    <input type="submit" class="btn btn-primary" name="updateUser">
                   
                </form>
            </div>
        </div>
        <div class="col-sm-2">
        </div>
    </div>

    <br>
    <br>
  <div class="row">
    <div class="col-sm-1">
    </div>


    <div class="col-sm-5 text-center">
        <h3>Produits suivis</h3> <br>
        
        <table id="productsTable">
        </table>
    </div>

    <div class="col-sm-5 text-center">
        <h3>Vendors suivis</h3> <br>
        
        <table id="vendorsTable">
        </table>
    </div>

    <div class="col-sm-1">
    </div>
    </span>
</div>



<script>

    function showdiv(div){
        document.getElementById(div).style.display = (document.getElementById(div).style.display=="none") ? "block" : "none";
    }

    followedProducts = [{techno: "produit", techno_ver: "1.0", vendor: "vendor", active: true}]; //requete bdd 
    followedVendors = [{vendor: "vendor", active: true}];

    var productsTable = null;
    var vendorsTable = null;
    $(document).ready( function () {
        productsTable = $("#productsTable").DataTable({
        	data: followedProducts,
		    columns: [
			        { title:"Produit", data: "techno"},
			        { title:"Version", data: "techno_ver", orderable: false },
                    { title:"Groupe", data: "vendor" },
                    { title:"Suivi", data: "active", orderable: false ,
                    render: function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<input type="checkbox" class="editor-active">';
                        }
                        return data;
                    },
                    className: "dt-body-center"
                 }
			    ],
			pageLength: 10,
			deferRender: true,
            responsive: true,
            language: {
                url: "lang/French.json"
            }
        })
    });

    $(document).ready( function () {
        vendorsTABLE = $("#vendorsTable").DataTable({
        	data: followedVendors,
		    columns: [
                    { title:"Vendor", data: "vendor"},
                    { title:"Suivi", data: "active", orderable: false ,
                    render: function ( data, type, row ) {
                        if ( type === 'display' ) {
                            return '<input type="checkbox" class="editor-active">';
                        }
                        return data;
                    },
                    className: "dt-body-center"
                    }
			    ],
			pageLength: 10,
			deferRender: true,
            responsive: true,
            language: {
                url: "lang/French.json"
            }
        })/*
        .on('click', 'tbody tr', function() {
            get_cve(table.row(this).data());
            });*/
    });



</script>
</body>

</html>