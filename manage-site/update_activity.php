<?php

require("../libs/config.php");


$sql = "SELECT org_id FROM mp_main ORDER BY org_id";

try {
        $stmt = $DB->prepare($sql);
        $stmt->execute();
        $results = $stmt->fetchAll();

        foreach ($results as $row):
            
            $org =  $row["org_id"];
            $activity_count = 0;     

            $sql = "select count(*) as total from mp_events where status ='A' and org_id= '". $org . "'" ;
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            $events =  $data[0]["total"];

            $sql = "select count(*) as total from mp_blogs where status ='A' and org_id= '". $org . "'" ;
            $stmt = $DB->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            $blogs =  $data[0]["total"];

            $activity_count = $events + $blogs;


            $sql = "UPDATE mp_main  SET  `activity` = :act  WHERE `org_id` = :oid ";
     
                try {
                    $stmt = $DB->prepare($sql);
                    $stmt->bindValue(":act", $activity_count);
                    $stmt->bindValue(":oid", $org);
                
                    $stmt->execute();
                    if ($stmt->rowCount() > 0) {
                        // echo "Page update successfully";
                    }  else if ($stmt->rowCount() == 0) {
                        // echo "No changes affected";
                    } else {
                        echo "Failed to update page";
                    }

                } catch (Exception $ex) {
                    echo errorMessage($ex->getMessage());
                }


            // echo $activity_count;


        endforeach;


    } catch (Exception $ex) {
        echo errorMessage($ex->getMessage());
    }    
    // echo "test";

    // echo json_encode($results);
    

?>
