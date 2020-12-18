<?php
    session_start();
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
                <li><a href="home.php">Home</a></li>
                <li><a href="profile.php">Mon profil</a></li>
                <li class="active"><a href="vendors.php">Vendors</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="index.php?p=logout">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
    </div>
    <br>
    <br>
  <div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
        <table id="myTable">
        </table>
    </div>

    <div class="col-sm-2">
    </div>
</div>



<script>

get_vendors();
var table = null;
var dataset = [];
function create_table(){

    $(document).ready( function () {
        table = $("#myTable")
        .DataTable({
            data: dataset,
		    columns: [
                 { title:"Vendor", data: "vendor"},
                 { title:"Suivre", data:   "active", orderable: false ,
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
}

    function get_vendors(){
        var url = "api/getvendors.php";
        $.ajax({
            url: url,
            dataType: "json",
            crossDomain: true,
            method: "GET",

            headers: "{ accept: 'application/json', Access-Control-Allow-Origin: '*'}",

            success: function(response) {  
                var vendors = [];
                response.forEach(v => {
                    vendors.push({vendor: v, active: true})
                })
                dataset = vendors;
                console.log(dataset);
                create_table();
                //$("#myTable").DataTable().ajax.reload();
            },
            error: function (xhr, status) {
                var output = "Une erreur est survenue lors de la requête de cet élément"; 
                $('#cve_infos').replaceWith(output);
            }
            
        })
    }


</script>
</body>

</html>