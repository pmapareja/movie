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
        <div class="h-100 col-md-2 btn-container">
            <button  
                type="button" 
                id="1" 
                class="buttons btn btn-primary" 
            >
                Matrix
            </button>
            <br/>
            <br/>
            <button 
                type="button" 
                id="2" 
                class="buttons btn btn-primary"
            >
                Matrix Reloaded
            </button>
            <br/>
            <br/>
            <button 
                type="button" 
                id="3" 
                class="buttons btn btn-primary"
            >
                Matrix Revolution
            </button>
        </div>
        <div class="col-md-9 details-container h-100">
            <table class="table">
                <thead>
                    <tr>
                    <th >Title</th>
                    <th >Year</th>
                    <th >IMDB</th>
                    <th >Type</th>
                    <th >Poster</th>
                    </tr>
                </thead>
                <tbody id="result-body">
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>

<script>
    $(".buttons").click(function() {
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
        }) 
    })
</script>
</html>