<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <script 
        src="<?php echo base_url() ?>/assets/library/jquery/external/jquery/jquery.js"
    >
    </script>
    <script 
        src="<?php echo base_url() ?>/assets/library/jquery/jquery-ui.js"
    >
    </script>
    <script 
        src="<?php echo base_url() ?>/assets/library/bootstrap/js/bootstrap.bundle.js"
    >
    </script>

    <link 
        rel="stylesheet" 
        href="<?php echo base_url() ?>/assets/library/bootstrap/css/bootstrap.css"
        >
    </link>
	<meta charset="utf-8">
	<title>Welcome to Movie Viewer</title>

	<style type="text/css">
        html, body {
            height: 100% !important;
            /* background-color: #37A2D4; */
        }
        .container{
            height: 100% !important;
        }
        .btn-container {   
            height: 100%  !important;
            /* border-right: solid 2px #999; */
            padding-top: 20px;
            /* background-color: #37A2D4; */
            margin-left: 30px
        }
        .buttons {
            width: 200px;
            border: solid 1px #000;
            /* background-color: #F0D5C0 !important; */
        }
        .details-container{
            /* background-color: #21619A; */
        }
        .table{
            color: #21619A !important;
        }
	</style>
    
</head>
<body>

<div class="h-100">
    <div class="row h-100">
        <div class="h-100 col-md-2 btn-container"></div>
        <div class="col-md-9 details-container h-100"></div>
    </div>
</div>

</body>

<script>
    var buttons = Array("Matrix", "Matrix Reloaded", "Matrix Revolution");

    var tableHeaders = Array(
        "Title",
        "Year",
        "IMDB",
        "Type",
        "Poster"
    );
    $(document).ready(function(){
        generateButtons();
        generateTable();
    });
    
    function generateButtons() 
    {

        var btn = "";
        var cnt = 1;
        $.each(buttons, function (x, y) {
            btn += "<button type='button' id='"+ cnt +"' class='buttons btn btn-primary'>";
            btn += buttons[x];
            btn += "</button>";
            btn += "<br/><br/>";
            cnt++;
             
        });
        $(".btn-container").append(btn);
    }

    function generateTable() 
    {
        var tbl = "";
        tbl +="<table class='table'>";
        tbl +="<thead>";
        tbl +="<tr>";
        $.each(tableHeaders, function (x, y) {
            tbl +="<th>"+tableHeaders[x] + "</th>";    
        })
        tbl +="</tr>";
        tbl +="</thead>";
        tbl +="<tbody id='result-body'>";
        tbl +="</tbody>";
        tbl +=" </table>";

        $(".details-container").append(tbl);
                    
    }
    $(document).on('click', '.buttons', function() {
        $("#result-body").html("");
        $(this).each(function () {
            var request = "request?button=" + $(this).attr("id");
            $.get(request, function(data) {
                var dt = $.parseJSON(data);
                var res = dt.data;
                var html = "";
                
                if (res.Response) {
                  
                    var search = res.Search;
                    
                    $.each(search, function(i, val) {
                        html +="<tr>";
                        html +="<td>" + search[i].Title + "</td>";
                        html +="<td>" + search[i].Year + "</td>";
                        html +="<td>" + search[i].imdbID + "</td>";
                        html +="<td>" + search[i].Type + "</td>";
                        html +="<td><img src='" + search[i].Poster + "' height='200'/></td>";
                        html +="</tr>";
                    });

                    $("#result-body").html(html);
                }
                
            });
        });
    });
</script>
</html>