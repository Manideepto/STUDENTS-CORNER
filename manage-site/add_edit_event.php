<?php
session_start();
	
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: home.php");
    exit;
}

require("../libs/config.php");

$msg = '';

include("header.php");

?>

<link rel="stylesheet" type="text/css" href="CLEditor/jquery.cleditor.css" />
<!-- <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script> -->
<!-- <script type="text/javascript" src="CLEditor/jquery.cleditor.min.js"></script> -->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<!-- 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>  
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

<!-- <h1> Under construction, please contact CCC if urgent </h1> -->

<?php echo $msg; ?>
<div class="formField">      
    <form method="post" action=" " name="events">
      
        <table id="tableForm">
            <tr>
                <td class="formLeft"><span class="required">*</span>Event Title: </td>
                <td><input type="text" name="event_title" id="event_title" class="textboxes" autocomplete="off"  /> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>Description: <br>(Limit to 255 chars) </td>
                <td>
                    <textarea name="event_desc" id="event_desc"></textarea>
                </td>
            </tr>
            <tr>
                <td class="formLeft">Format: </td>
                <td>
                    <textarea name="event_format" id="event_format"></textarea>
                </td>
            </tr>
            <tr>
                <td class="formLeft">Meta Keywords: </td>
                <td><input type="text"  name="meta_keywords" id="event_keywords" class="textboxes" /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Contact Email: </td>
                <td><input type="email" name="event_email" id="event_email" class="textboxes"  autocomplete="off"  /> </td>
            </tr>

            <tr>
                <td class="formLeft">Contact Phone: </td>
                <td><input type="number" name="event_phone" id="event_phone" class="textboxes"  /> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Event Start Date-Time: </td>
                <td><input type="datetime-local" name="event_datetime" id="event_datetime" class="textboxes"/> </td>
            </tr>

            <tr>
                <td class="formLeft"><span class="required">*</span>Event End Date-Time: </td>
                <td><input type="datetime-local" name="event_datetime_end" id="event_datetime_end" class="textboxes"/> </td>
            </tr>

            <tr>
                <td class="formLeft"> Registration Link: </td>
                <td><input type="text" name="event_reglink" id="event_reglink"  class="textboxes" required> </td>
            </tr>
            <tr>
                <td class="formLeft"><span class="required">*</span>IIMA Forum Link: </td>
                <td><input type="text" name="event_forumlink" id="event_forumlink"  class="textboxes" required> </td>
            </tr>

            <tr>
                <td class="formLeft">Additional Details: </td>
                <td><input type="text" name="event_addDetails" id="event_addDetails" placeholder ="link for more rules" class="textboxes" /> </td>
            </tr>
         
            <tr>
                <td class="formLeft"><span class="required">*</span>Status : </td>
                <td>     
                    <?php if (isset($_REQUEST["edit"]) && $_REQUEST["edit"] != "") { ?>
                        <label><input type="radio" name="status" id="active_status" value="A" <?php echo ($details[0]["status"] == 'A') ? 'checked' : ''; ?>  />Active</label> &nbsp; 
                        <label><input type="radio" name="status" id="status" value="I" <?php echo ($details[0]["status"] == 'I') ? 'checked' : ''; ?>  />Inactive</label>
                    <?php } else { ?>
                        <label><input type="radio" name="status" id="active_status" value="A" checked  />Active</label> &nbsp; <label><input type="radio" name="status" value="I"  />Inactive</label>
                    <?php } ?>
                </td>
            </tr>

            <tr>
                <td class="formLeft">Privacy : </td>
                <td>     
                    <?php if (isset($_REQUEST["edit"]) && $_REQUEST["edit"] != "") { ?>
                        <label><input type="checkbox" name="privacy" id="active_privacy" value="P" <?php echo ($details[0]["privacy"] == 'P') ? 'checked' : ''; ?>  />Public</label> &nbsp; 
                    <?php } else { ?>
                        <label><input type="checkbox" name="privacy" id="active_privacy" value="P"/> Public</label> &nbsp;
                    <?php } ?>
                    (Check this option if you would like this event to be visible without signin form IIMA accounts)
                </td>     
            </tr>

            <tr>
                <td></td>
                <td> <input type="button" onclick="put_data('submit')" name="sub" value="Save" /> &nbsp;  <input type="button" name="" onclick="javascript:window.location = 'manage_events.php';" value="back to lists" /></td>
                
            </tr>       
        </table>
    </form>
</div>

<br>
<br>

<div class="formField">
    <!-- <form name="event_calender"> -->
        <table id="tableForm" >
                Use this option to Generate a google calendar link for the event which can be copy pasted into the Email body
            <tr>
                <td class="formLeft">Event calendar Link: </td>
                <td>
                    <button id="authorize_button" style="display: none;">Authorize</button>
                    <button id="signout_button" style="display: none;">Sign Out</button>
                    <button id="generate_link_button" style="display: none;" onclick="put_data('calLink')" >Generate Calendar Link</button>
                    <input type="text" name="event_calendarLink" id="event_calendarLink" class="textboxes" />
                </td>
            </tr>

            <tr id="copy_btn_row">                
                <td></td>
                <td  style="text-align:center">
                <p> ..... </p>
                    <!-- <button name="calendar_button" id="calendar_button" style="display: block;" class="btn btn-primary" href="https://www.google.com" type="button"> Add to Calendar </button> -->
                    <a href="https://google.com" id="calendar_button" class="btn btn-info btn-lg">
                    Add to calendar
                    </a>
                    <p>....</p>
                </td>

            </tr>

            <tr>            
            <td></td>
            <td>
                <button type="button"  class="btn btn-default btn-sm" onclick="CopyToClipboard('calendar_button')">
                <span class="glyphicon glyphicon-link">  <p id="copy_btn"> Click to Select "Add to Calendar" Button </p> </span>
                </button>   
            </td>
            </tr>

        </table>
    <!-- </form> -->
</div>

<script type="text/javascript">

     function CopyToClipboard(){
        console.log("trying to copy");
        var copy_text = document.getElementById("copy_btn_row");
        var range = document.createRange();
        range.selectNode(copy_text);
        window.getSelection().addRange(range);

        // var btn_text = ' <button type="button" id="copy_btn" class="btn btn-default btn-sm" onclick="CopyToClipboard("calendar_button")">Press Ctrl+C to copy, and paste it in your email body';

        var btn_text = 'Press Ctrl+C to copy, and paste it in your email body';

        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'successful' : 'unsuccessful';
            console.log('Copying text command was ' + msg);
            document.getElementById("copy_btn").innerHTML= btn_text;

        } catch (err) {
            console.log('Oops, unable to copy');
        }

        };

</script>



    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">     
         var org_id = '<?php echo $_SESSION['Admin_org_id']; ?>';
         var page = 'admin_events';
         var event_id = '<?php echo $_GET['edit']; ?>';

       $(document).ready(function(){
           if ( event_id != '' ){
            $.ajax({
            method: "get", 
            url: "get_data.php",
            data: {org_id: org_id,
            page:page,
            event_id : event_id
            }
            }).done(function(data){
                var result= $.parseJSON(data); 
                $.each( result, function( key, value ) {
                $("#event_title").val(value['event_title']);
                $("#event_desc").val(value['event_desc']);
                $("#event_addDetails").val(value['event_addDetails']);
                $('#event_datetime').val( value['event_datetime'].replace(" ","T") ) ;
                $('#event_datetime_end').val( value['event_datetime_end'].replace(" ","T") ) ;
                $("#event_email").val(value['event_email']);
                $("#event_format").val(value['event_format']);
                $("#event_phone").val(value['event_phone']);
                $("#event_reglink").val(value['event_reglink']);
                $("#event_forumlink").val(value['event_forumlink']);
                $("#meta_keywords").val(value['meta_keywords']);
                $("#event_calendarLink").val(value['event_calendarLink']);
            
                $("#calendar_button").attr("href",value['event_calendarLink']);
                    

                if(value['status'] == 'A'){
                    $("#active_status").prop( "checked", true );
                }else{
                    $("#status").prop( "checked", true );
                }

                if(value['privacy'] == 'P'){
                    $("#active_privacy").prop( "checked", true );
                }else{
                    $("#active_privacy").prop( "checked", false );
                }


                 });
                });
        }

         });

    </script>



<script type="text/javascript">
      // Client ID and API key from the Developer Console
      var CLIENT_ID = '468949168558-m5vvvn1qv97s372tgoiu32e4f2lr3vvr.apps.googleusercontent.com';
      var API_KEY = 'AIzaSyBwcLFZjg_UoYtf93TA4d4REdioqfg6tKs';

      // Array of API discovery doc URLs for APIs used by the quickstart
      var DISCOVERY_DOCS = ["https://www.googleapis.com/discovery/v1/apis/calendar/v3/rest"];

      // Authorization scopes required by the API; multiple scopes can be
      // included, separated by spaces.
      var SCOPES = "https://www.googleapis.com/auth/calendar";

      var authorizeButton = document.getElementById('authorize_button');
      var signoutButton = document.getElementById('signout_button');
      var genLinkButton = document.getElementById('generate_link_button');

      /**
       *  On load, called to load the auth2 library and API client library.
       */
      function handleClientLoad() {
        gapi.load('client:auth2', initClient);
      }

      /**
       *  Initializes the API client library and sets up sign-in state
       *  listeners.
       */
      function initClient() {
        gapi.client.init({
          apiKey: API_KEY,
          clientId: CLIENT_ID,
          discoveryDocs: DISCOVERY_DOCS,
          scope: SCOPES
        }).then(function () {
          // Listen for sign-in state changes.
          gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

          // Handle the initial sign-in state.
          updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
          authorizeButton.onclick = handleAuthClick;
          signoutButton.onclick = handleSignoutClick;
        }, function(error) {
          appendPre(JSON.stringify(error, null, 2));
        });
      }

      /**
       *  Called when the signed in status changes, to update the UI
       *  appropriately. After a sign-in, the API is called.
       */
      function updateSigninStatus(isSignedIn) {
        if (isSignedIn) {
          authorizeButton.style.display = 'none';
          signoutButton.style.display = 'block';
          genLinkButton.style.display = 'block';

        } else {
          authorizeButton.style.display = 'block';
          signoutButton.style.display = 'none';
          genLinkButton.style.display = 'none';
        }
      }

      /**
       *  Sign in the user upon button click.
       */
      function handleAuthClick(event) {
        gapi.auth2.getAuthInstance().signIn();
      }

      /**
       *  Sign out the user upon button click.
       */
      function handleSignoutClick(event) {
        gapi.auth2.getAuthInstance().signOut();
      }

      /**
       * Append a pre element to the body containing the given message
       * as its text node. Used to display the results of the API call.
       *
       * @param {string} message Text to be placed in pre element.
       */
      function appendPre(message) {
        var pre = document.getElementById('content');
        var textContent = document.createTextNode(message + '\n');
        pre.appendChild(textContent);
      }

    </script>


<script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
</script>

<script src="https://apis.google.com/js/platform.js"></script>

    <script type="text/javascript"> 
        function put_data(operation){

        var org_id = '<?php echo $_SESSION['Admin_org_id']; ?>';
        var page = 'events';
        var event_id = '<?php echo $_GET['edit']; ?>';

        var iframe1 = document.getElementById("cke_1_contents").getElementsByTagName("iframe")[0];
        var iframe2 = document.getElementById("cke_2_contents").getElementsByTagName("iframe")[0];

        var event_title = document.getElementById("event_title").value;
        // var event_desc = document.getElementById("event_desc").value;
        var event_desc = iframe1.contentWindow.document.getElementsByTagName("body")[0].innerHTML;

        var event_addDetails = document.getElementById("event_addDetails").value;
        var event_datetime = document.getElementById("event_datetime").value;
        var event_datetime_end = document.getElementById("event_datetime_end").value;
        var event_email = document.getElementById("event_email").value;
        // var event_format = document.getElementById("event_format").value;
        var event_format = iframe2.contentWindow.document.getElementsByTagName("body")[0].innerHTML;
        
        var event_phone = document.getElementById("event_phone").value;
        var event_reglink = document.getElementById("event_reglink").value;
        var event_forumlink = document.getElementById("event_forumlink").value;
        var event_keywords = document.getElementById("event_keywords").value;
        var event_calendarLink = document.getElementById("event_calendarLink").value;
  
        // alert("test alet");

        if (document.getElementById("active_status").checked){
                 var event_status = 'A';
             }else{
                 var event_status = 'I';
             }
       
        if (document.getElementById("active_privacy").checked){
            var privacy_status = 'P';
        }else{
            var privacy_status = 'R';
        }

        // event_calenderLink == '' || event_calenderLink == undefined
        function Event_Added_alert(){
            console.log("alerting");
            alert("Calender Event Added. Please check you calendar");
            put_data('submit');
        }

        function createEvent(){
            console.log("inside create event funciton");
                if (true) {
                    console.log("inside create event funciton, after check");

                    var event = { 
                    'summary': event_title,
                    'location': '',
                    'description': event_desc,
                    'start': {
                        'dateTime': event_datetime,
                        'timeZone': 'Asia/Kolkata'
                    },
                    'end': {
                        'dateTime': event_datetime_end,
                        'timeZone': 'Asia/Kolkata'
                    },
                    'reminders': {
                        'useDefault': false,
                        'overrides': [
                        {'method': 'email', 'minutes': 24 * 60},
                        {'method': 'popup', 'minutes': 10}
                        ]
                    },
                    'attendees': [
                         {'email': 'iimahd.ernet.in_v78lucntsihg0lhm1e5odm3ppo@group.calendar.google.com'}
                        ],
                    'visibility':'public'
                    
                    };

                    var request = gapi.client.calendar.events.insert({
                        // console.log(event)
                        'calendarId': 'primary',
                        'resource': event,
                    });
                    
                    request.execute(function(event) {
                        console.log('Event created: ' + event.htmlLink);

                        $("#event_calendarLink").val(event.htmlLink);
                        event_calendarLink = String(event.htmlLink);
                       
                        $("#calendar_button").attr("href",event_calendarLink);
            
                        // Event_Added_alert();
                        if (event.htmlLink == undefined){
                            alert("Some Issue. Calendar Not added");
                        }else{
                            console.log("addting alert");
                        Event_Added_alert();
                            }

                    });    
                }
            }
        
        
        function submitForm(){
            console.log("inside submit form");
        $.ajax({
        type: "POST",
        url: "put_data.php",
        data: {
            page : page,
            org_id : org_id,
            event_id : event_id,
            event_title : event_title,
            event_desc : event_desc,
            event_addDetails : event_addDetails,
            event_datetime : event_datetime,
            event_datetime_end : event_datetime_end,
            event_email : event_email,
            event_format : event_format,
            event_phone : event_phone,
            event_reglink : event_reglink,
            event_forumlink : event_forumlink,
            event_calendarLink: event_calendarLink,
            meta_keywords : event_keywords,
            status : event_status,
            privacy : privacy_status
        },
        cache: false,
        success: function(html) {
                alert(html);
                }
        });

        }

        if (event_title == '' || event_desc == ''|| event_datetime == '' || event_datetime_end == '') {
        alert("Please Fill All Fields");
        } else {

            if (operation =='submit'){
                console.log("calling create submit function");
                submitForm();
            }
            if (operation =='calLink'){
                console.log("calling create event function");
                createEvent();
                }
                
        }

        return false;

        }


       
        
        
    
    </script>


<script type="text/javascript">
    CKEDITOR.replace( 'event_desc' );
    CKEDITOR.replace( 'event_format' ); 
</script>


<?php
include("footer.php");
?>
