<?php
/*
 * @author Shahrukh Khan
 * @website http://www.thesoftwareguy.in
 * @facebook https://www.facebook.com/Thesoftwareguy7
 * @twitter https://twitter.com/thesoftwareguy7
 * @googleplus https://plus.google.com/+thesoftwareguyIn
 */

session_start();
	
	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
		header("location: home.php");
		exit;
	}

require("../libs/config.php");


$org_id = db_prepare_input($_POST["org_id"]);
$page = db_prepare_input($_POST["page"]);


if ($page =='events'){
    $event_id = intval(db_prepare_input($_POST["event_id"]));
    $event_title = db_prepare_input($_POST["event_title"]);
    $event_desc = db_prepare_input($_POST["event_desc"]);
    $event_addDetails = db_prepare_input($_POST["event_addDetails"]);
    $event_datetime = db_prepare_input($_POST["event_datetime"]);
    $event_datetime_end = db_prepare_input($_POST["event_datetime_end"]);
    $event_email = db_prepare_input($_POST["event_email"]);
    $event_format = db_prepare_input($_POST["event_format"]);
    $event_phone = db_prepare_input($_POST["event_phone"]);
    $event_reglink = db_prepare_input($_POST["event_reglink"]);
    $event_forumlink = db_prepare_input($_POST["event_forumlink"]);
    $event_calendarLink = db_prepare_input($_POST["event_calendarLink"]);
    $meta_keywords = db_prepare_input($_POST["meta_keywords"]);
    $status = db_prepare_input($_POST["status"]);
    $privacy = db_prepare_input($_POST["privacy"]);

    $status = ($status <> "") ? $status : "I";
    $privacy = ($privacy <> "") ? $privacy : "R";


    if ($event_title <> "" && $event_desc <>"" && $event_email<>"" && $status <> "" && $event_forumlink <>"" ) {
        if ($event_id <> "") {

            $sql = "UPDATE mp_events SET `event_addDetails` =  :eAD, "
                    . " `event_title` =  :eT,"
                    . " `meta_keywords` = :mkey, "
                    . " `event_desc` = :eD,"
                    . " `status` =  :status,"
                    . " `event_phone` =  :eP,"
                    . " `event_email` =  :eE,"
                    . " `event_format` =  :eF,"
                    . " `event_datetime` =  :eDt,"
                    . " `event_datetime_end` =  :eDt_end,"
                    . " `event_reglink` =  :eL,"
                    . " `event_forumlink` =  :eforumL,"
                    . " `event_calendarLink` =  :ecalendarL,"
                    . " `org_id` =  :oid,"
                    . " `privacy` =  :privacy"
                    . " WHERE `event_id` = :eid";
            
            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":eAD", $event_addDetails);
                $stmt->bindValue(":eT", $event_title);
                $stmt->bindValue(":mkey", $meta_keywords);
                $stmt->bindValue(":eD", $event_desc);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":eP", $event_phone);
                $stmt->bindValue(":eE", $event_email);
                $stmt->bindValue(":eF", $event_format);
                $stmt->bindValue(":eDt", $event_datetime);
                $stmt->bindValue(":eDt_end", $event_datetime_end);
                $stmt->bindValue(":eL", $event_reglink);
                $stmt->bindValue(":eforumL", $event_forumlink);
                $stmt->bindValue(":ecalendarL", $event_calendarLink);
                $stmt->bindValue(":eid", $event_id);
                $stmt->bindValue(":oid", $org_id);
                $stmt->bindValue(":privacy", $privacy);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo "event update successfully";
                }  else if ($stmt->rowCount() == 0) {
                    echo "No changes affected";
                } else {
                echo "Failed to update events";
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
            
        } else {
            $sql = "INSERT INTO mp_events (`org_id`, `event_addDetails` ,`event_title`, `meta_keywords`, `event_desc`,`status`,`event_phone`,`event_email`,`event_format`,`event_datetime`,`event_datetime_end`,`event_reglink`,`event_forumlink`,`privacy`,`event_calendarLink`) VALUES 
                (:oid, :eAD,:eT,:mkey,:eD, :status, :eP, :eE,:eF,:eDt, :eDt_end, :eL, :eforumL,:privacy, :ecalendarL)";

            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":eAD", $event_addDetails);
                $stmt->bindValue(":eT", $event_title);
                $stmt->bindValue(":mkey", $meta_keywords);
                $stmt->bindValue(":eD", $event_desc);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":eP", $event_phone);
                $stmt->bindValue(":eE", $event_email);
                $stmt->bindValue(":eF", $event_format);
                $stmt->bindValue(":eDt", $event_datetime);
                $stmt->bindValue(":eDt_end", $event_datetime_end);
                $stmt->bindValue(":eL", $event_reglink);
                $stmt->bindValue(":eforumL", $event_forumlink);
                $stmt->bindValue(":ecalendarL", $event_calendarLink);
                $stmt->bindValue(":oid", $org_id);
                $stmt->bindValue(":privacy", $privacy);

                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo "Event added successfully";
                } else if ($stmt->rowCount() == 0) {
                    echo "No changes affected";
                } else {
                    echo "Failed to add page";
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }       
        }
    } else {
        echo "Please fill in all mandatory fields";
    }
}


if ($page =='members'){

    $mem_id = db_prepare_input($_POST["mem_id"]);
    $name = db_prepare_input($_POST["name"]);
    $mem_bio = db_prepare_input($_POST["mem_bio"]);
    $email = db_prepare_input($_POST["email"]);
    $phone = db_prepare_input($_POST["phone"]);
    $status = db_prepare_input($_POST["status"]);
    $meta_keywords = db_prepare_input($_POST["meta_keywords"]);

     $status = ($status <> "") ? $status : "I";


    if ($name <> "" && $status <> "" ) {
        if ($mem_id <> "") {
           $sql = "UPDATE mp_members SET  `name` =  :mn, "
                    . " `mem_bio` =  :mbio,"
                    . "meta_keywords = :mkey, "
                    . " `email` = :me,"
                    . " `status` =  :status,"
                    . " `phone` =  :mp,"
                    . " `org_id` =  :oid"
                    . " WHERE `mem_id` = :mid";
             
            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":mn", $name);
                $stmt->bindValue(":mbio", $mem_bio);
                $stmt->bindValue(":mkey", $meta_keywords);
                $stmt->bindValue(":me", $email);
                $stmt->bindValue(":mp", $phone);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":mid", $mem_id);
                $stmt->bindValue(":oid", $org_id);
               
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                    echo "Page update successfully";
                }  else if ($stmt->rowCount() == 0) {
                    echo "No changes affected";
                } else {
                    echo "Failed to update page";
                }

             

            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }
            
        } else {
            $sql = "INSERT INTO  mp_members  (`org_id`,`name`, `mem_bio`, `meta_keywords`, `email`, `status`,`phone`) VALUES 
				(:oid, :mn, :mbio, :mkey, :me, :status, :mp )";

            try {
                $stmt = $DB->prepare($sql);
                $stmt->bindValue(":mn", $name);
                $stmt->bindValue(":mbio", $mem_bio);
                $stmt->bindValue(":mkey", $meta_keywords);
                $stmt->bindValue(":me", $email);
                $stmt->bindValue(":mp", $phone);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":oid", $org_id);

               
                $stmt->execute();
                if ($stmt->rowCount() > 0) {
                   echo "Page added successfully";
                } else if ($stmt->rowCount() == 0) {
                    echo "No changes affected";
                } else {
                    echo "Failed to add page";
                }
            } catch (Exception $ex) {
                echo errorMessage($ex->getMessage());
            }

          
        }
    } else {
        echo "Please fill in all mandatory fields";
    }


}


?>
