<head> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/css/bootstrap-select.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.1/js/bootstrap-select.js"></script>
</head>	

<div class="container">

<div class="col-sm-8 col-md-6">
<select class="selectpicker" data-show-subtext="true" data-live-search="true" id="mySelect" onchange="setorg_events()">
  <option value="all">ALL CLUBS</option>
  <option value="org1">org1</option>
  <option value="org2">org2</option>
  <option value="eosc">eosc</option>
  <option value="red-dot">red-dot</option>
  <option value="public-policy">public-policy</option>
  <option value="chaos">chaos</option>
  <option value="heritage">heritage</option>
  <option value="finesse">finesse</option>
  <option value="consult-club">consult-club</option>
  <option value="decibel">decibel</option>
  <option value="synergy">synergy</option>
  <option value="smile">smile</option>
  <option value="iimally">iimally</option>
  <option value="ccc">ccc</option>
  <option value="panacea">panacea</option>
  <!-- premission pending -->
  <option value="footloosefam">footloosefam</option>
  <option value="LiterarySymposiumDesk">LiterarySymposiumDesk</option>
  <option value="womenleadership">womenleadership</option>
  <option value="prayaas">prayaas</option> 
  <option value="share">share</option>
  <option value="sash">sash</option>
  <option value="excouncil">excouncil</option>
  <option value="fii">fii</option>
  <option value="optima">optima</option>
  <option value="abacus">abacus</option>
  <option value="ideos">ideos</option>
  <option value='acads'>acads</option>
  <option value='aerc'>aerc</option>
  <option value='beta'>beta</option>
  <option value='cultcomm'>cultcomm</option>
  <option value='eloquence'>eloquence</option>
  <option value='entrepreneurship-vc-club'>entrepreneurship-vc-club</option>
  <option value='equipoise'>equipoise</option>
  <option value='exchange'>exchange</option>
  <option value='fcomm'>fcomm</option>
  <option value='fsi'>fsi</option>
  <option value='fab'>fab</option>
  <option value='gmlc'>gmlc</option>
  <option value='iimacts'>iimacts</option>
  <option value='MADClub'>MADClub</option>
  <option value='mediacell'>mediacell</option>
  <option value='mentorshipcell'>mentorshipcell</option>
  <option value='messcomm'>messcomm</option>
  <option value='decibel'>decibel</option>
  <option value='Niche'>Niche</option>
  <option value='perspectives'>perspectives</option>
  <option value='prakriti'>prakriti</option>
  <option value='prodman'>prodman</option>
  <option value='rterc'>rterc</option>
  <option value='sportscomm'>sportscomm</option>
  <option value='stargazers'>stargazers</option>
  <option value='tedxiima'>tedxiima</option>
  <option value='trbs'>trbs</option>
</select>
</div>
<div class="col-sm-8 col-md-6">
<select class="selectpicker" id="myInterest" onchange="setorg_events()">
  <option value="all">All Events</option>
  <option value="interest">Interested Events</option>
  <option value="not_interested">Not Interested Events</option>
</select>
</div>
<div id="fh5co-course">

    <div class="row">

        <!-- <div class='col-md-6 animate-box'> 		 -->
                        <!-- <div class='course'>
						<a href='#' class='course-img' style='background-image: url(images/project-1.jpg);'>
						</a>
						<div class='desc'>
							<h3><a href='#'>Web Master</a></h3>
							<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamust ab aliquam dolor eius.</p>
							<span><a href='#' class='btn btn-primary btn-sm btn-course'>Take A Course</a></span>
						</div>
					</div> -->
        <!-- </div>     -->
        

        
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
   
   <script type="text/javascript"> 
       var url = '<?php echo GET_DATA_URL ?>' ;
       
 
       function setevents(){ 
        var page = 'all_events';
         $.ajax({ 
           method: "get", 
           url: url ,
           data: {
           page:page
           }

         }).done(function( data ) { 

           var result= $.parseJSON(data); 
           var string = '';
		   
          /* from result create a string of data and append to the div */
        
           $.each( result, function( key, value ) { 
          
              var status =  value['status'];
               if (status == 'A'){
                   status = "Active";
				   var date_event = "No Date decided yet";
				   if((new Date(value['event_date']))!="Invalid Date")
				   {
					   console.log(new Date(value['event_date']));
					   date_event = new Date(value['event_date']).toUTCString();
					   date_event = date_event.split(' ').slice(0, 4).join(' ');
				   }
				   
            string += "<div class='col-md-6 animate-box'>\
            <div class='course'>\
						<a href='../" +value['org_id']+"/event_details.php?event_id="+value['event_id']+"' class='course-img' style='background-image: url(../" +value['org_id']+"/"+ value['event_thumbnail'] + ");'>"+
					    "</a>\
						<div class='desc'>\
							<h3><a href='../" +value['org_id']+"'> <b>Club:  </b>"+ value['org_id'] + "</a></h3>\
							<h3><a href='../" +value['org_id']+"/event_details.php?event_id="+value['event_id']+"'>"+ value['event_title'] + "</a></h3>\
							<p>"+ value['event_desc'].substring(0,80) + "</p>\
							<p><a class='btn btn-primary btn-sm btn-course'><b>"+date_event+"<br></b></a></p>\
							</div>\
				</div>\
                </div>";
              } else{
                   status ="Inactive";
               }
                       }); 

            // //   }

                 string += '</div>\
                 </div>\
                 </div>'; 

              $("#fh5co-course").html(string); 
          }); 
   }
   
   
   function setorg_events(){ 
        var page = 'org_events';
		var org_id = document.getElementById("mySelect").value;
		var interest_sel = document.getElementById("myInterest").value;
         $.ajax({ 
           method: "get", 
           url: url ,
           data: {
           page:page,
		   org_id: org_id,
		   interest_sel: interest_sel
           }

         }).done(function( data ) { 

           var result= $.parseJSON(data); 
           var string = '';
   
          /* from result create a string of data and append to the div */
        
           $.each( result, function( key, value ) { 
          
              var status =  value['status'];
               if (status == 'A'){
                   status = "Active";
				   var date_event = "No Date decided yet";
				   if((new Date(value['event_date']))!="Invalid Date")
				   {
					   date_event = new Date(value['event_date']).toUTCString();
					   date_event = date_event.split(' ').slice(0, 4).join(' ');
				   }
            string += "<div class='col-md-6 animate-box'>\
            <div class='course'>\
						<a href='../" +value['org_id']+"/event_details.php?event_id="+value['event_id']+"' class='course-img' style='background-image: url(../" +value['org_id']+"/"+ value['event_thumbnail'] + ");'>"+
					    "</a>\
						<div class='desc'>\
							<h3><a href='../" +value['org_id']+"'> <b>Club:  </b>"+ value['org_id'] + "</a></h3>\
							<h3><a href='../" +value['org_id']+"/event_details.php?event_id="+value['event_id']+"'>"+ value['event_title'] + "</a></h3>\
							<p>"+ value['event_desc'].substring(0,80) + "</p>\
							<p><a class='btn btn-primary btn-sm btn-course'><b>"+date_event+"<br></b></a></p>\
							</div>\
				</div>\
                </div>";
              } else{
                   status ="Inactive";
               }
                       }); 

            // //   }

                 string += '</div>\
                 </div>\
                 </div>'; 

              $("#fh5co-course").html(string); 
          }); 
   }


  
  
  $.ajax({
   url:setevents()
})


   </script>


