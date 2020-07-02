<?php

?>
<!-- 
<html>
<head>
  <script language="javascript" type="text/javascript" src="jquery.js"></script>
</head>
<body>


<h2> Client example </h2>
<h3>Output: </h3>
<div id="output">this element will be accessed by jquery and this text replaced</div>

<script id="source" language="javascript" type="text/javascript">

$(function () 
{
  //------------------------------------------- ----------------------------
  // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
  //-----------------------------------------------------------------------
  $.ajax({                                      
    url: 'get_data.php',              //the script to call to get data          
    data: "",                        //you can insert url argumnets here to pass to api.php
                                     //for example "id=5&parent=6"
    dataType: 'json',                //data format      
    success: function(data)          //on recieve of reply
    {
      var id = data[0];              //get id
      var vname = data[1];           //get name
      //--------------------------------------------------------------------
      // 3) Update html content
      //--------------------------------------------------------------------
      $('#output').html("<b>id: </b>"+id+"<b> name: </b>"+vname); //Set output element html
      //recommend reading up on jquery selectors they are awesome 
      // http://api.jquery.com/category/selectors/
    } 
  });
}); 

</script>
</body>
</html> -->
<html> 
    <head> 
       <title>AJAX jQuery Example with PHP MySQL</title> 
       <style type="text/css">
        body{
          font-family: Verdana, Geneva, sans-serif;
        }
      .container{
          width: 50%;
          margin: 0 auto;
      } 
     
     table, tr, th, td {
        border: 1px solid #e3e3e3;
        padding: 10px;
     }
     
    </style> 

    </head> 

    <body>
     
      <div class = "container" id="records" > 

        <h3><u>AJAX jQuery Example with PHP MySQL</u></h3>

        <p><strong>Click on button to display users records from database</strong></p> 
        
        <!-- <tr id="records"></tr>  -->
        
        <p>
            <input type="button" id = "getusers" value = "Fetch Records" />
        </p>
      
    </div> 

    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
   
    <script type="text/javascript"> 

        $(function(){ 

          // $("#getusers").on('click', function(){ 

          $.ajax({ 

            method: "GET", 
            // data = $_SESSION["username"],
            url: "get_data.php",

          }).done(function( data ) { 

            var result= $.parseJSON(data); 

          //  var string='<table width="100%"><tr> <th>#</th><th>Name</th> <th>Email</th><tr>';
              var string ='';
           /* from result create a string of data and append to the div */
          
            $.each( result, function( key, value ) { 
              
              string += value['event_id']; 
                  }); 


              $("#records").html(string); 
           }); 
        // }); 
    }); 
    </script> 
    </body>
    </html>