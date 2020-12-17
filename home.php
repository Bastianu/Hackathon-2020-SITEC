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
$technos = $sgbd->request("SELECT * FROM technologie left join usertechnologie on  usertechnologie.id_technologie = technologie.id where usertechnologie.id_user = ?",array($_SESSION["user"]["id"]));
echo "<div id='usertechnos' style='display:none'>".json_encode($technos) ."</div>";

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
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">Hackathon 2020</a>
                </div>
                <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="profile.php">Mon profil</a></li>
                <li><a href="vendors.php">Vendors</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="cve.php">CVE</a></li>
                <li><a href="">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <br>
  <div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
        <h2> Vos technologies </h2>
        <br>
    <br>
        <table id="myTable">
        </table>
    </div>

    <div class="col-sm-2">
    </div>


 </div class="row">

    <div id="cve_infos">
        
    </div>
</div>



<script>

var usertechnos = [];
var a = JSON.parse(document.getElementById("usertechnos").innerHTML);

//cve et importance vulnérabilité à récupérer 
a.forEach(techno => {
    usertechnos.push({techno: techno["technoname"], techno_ver: techno["version"], cve:"<button class='btn btn-link' onclick=''>CVE-2020-14394</button>", level:"low" })
})
console.log(usertechnos)

var table = null;
    $(document).ready( function () {
        table = $("#myTable").DataTable({
        	data: usertechnos,
		    columns: [
			        { title:"Technologie", data: "techno"},
			        { title:"Version", data: "techno_ver", orderable: false },
                    { title:"Vulnérabilité", data: "cve" },
                    { title:"Impact", data: "level" }

                    
			        //{ title:"Actions", data: "action", className: "text-center", orderable: false }
			    ],
			pageLength: 25,
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

/*
    function get_cve(data){
        var cve = data["cve"];
        var url = "https://api/cve?code="+cve+".php";
        $.ajax({
            url: url,
            dataType: "json",
            crossDomain: true,
            method: "GET",

            headers: "{ accept: 'application/json', Access-Control-Allow-Origin: '*'}",

            success: function(response) {          
                var output = "<div><h2>@code_cve</h2>"+"<br> description : @esc_cve <br> solutions : @solution_cve </div>"; 
                $('#cve_infos').replaceWith(output);
            },
            error: function (xhr, status) {
                var output = "Une erreur est survenue lors de la requête de cet élément"; 
                $('#cve_infos').replaceWith(output);
            }
            
        })
    }
*/

</script>
</body>

</html>