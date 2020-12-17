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
                <li><a href="#">Mes infos</a></li>
                <li><a href="#">Veille technologique</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Déconnexion</a></li>
                </ul>
            </div>
        </nav>
    </div>

  <div class="row">
    <div class="col-sm-2">
    </div>

    <div class="col-sm-8">
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


var table = null;
	var dataset = [
        {techno: "php", techno_ver:"8", cve:"CVE-2020-14394", level:"low"},
        {techno: "maria_db", techno_ver:"1", cve:"CVE-2010-3333", level:"medium"}
    ];
    $(document).ready( function () {
        table = $("#myTable").DataTable({
        	data: dataset,
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
        })
        .on('click', 'tbody tr', function() {
            get_cve(table.row(this).data());
            });
    });


    function get_cve(data){
        var cve = data["cve"];
        var url = "https://cve.circl.lu/api/cve/" + cve;
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
                var output = "<div><h2>@code_cve</h2>"+"<br> description : @esc_cve <br> solutions : @solution_cve </div>"; 
                $('#cve_infos').replaceWith(output);
            }
            
        })
    }


</script>
</body>

</html>