<?php
//import sqlitedb.php to access sqliteDB class
require 'sqlitedb.php';

// Reads the variables sent via POST from Africa's Talking gateway
$sessionId   = filter_input(INPUT_POST, 'sessionId');
$serviceCode = filter_input(INPUT_POST, 'serviceCode');
$phoneNumber = filter_input(INPUT_POST, 'phoneNumber');
$text        = filter_input(INPUT_POST, 'text');


  
   $db = new sqliteDB();
   if(!$db) {
      //echo error message 
      echo $db->lastErrorMsg();
   } else {
      //Perform sql queries once database opens successfully 
      // 
       if ( $text == "" | $text == "1*0" | $text == "2*0" | $text == "3*0"
               | $text == "1*1*0" | $text == "1*2*0" | $text == "1*3*0"
               | $text == "2*1*0" | $text == "2*2*0" | $text == "2*3*0"
               | $text == "3*1*0" | $text == "3*2*0" | $text == "3*3*0") {
     // This is the first request. Note how we start the response with CON
           
     $text = "";//resetting post to default ""      
     $response  = "CON Welcome to AlligatorLytics. Select your County\n";
       
     $sql =<<<EOF
      SELECT * from county_tbl;
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= $row['county_id']." ".$row['county_name']."\n";
   }
   
   $db->close();
      
}


/*
 * #######################################################################################################
   #######################################################################################################
 *  
 */

else if ( $text == "1" | $text == "2" | $text == "3" ) {
  // Business logic for first level response
    
  $response = "CON Choose account information you want to view \n";
  $response .= "1. Weather Updates\n";
  $response .= "2. Farming Information \n";
  $response .= "3. Water Supply \n";
  $response .= "0. Home \n";
  
 }  
 
 
 
 /*
 * #######################################################################################################
   #######################################################################################################
 *  
 */
 

 
 //Option 1 level 2 (Weather)
 else if ( $text == "1*1" ) {
   $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
     $response = "CON Weather updates! \n";
      $sql =<<<EOF
      SELECT * from weather_tbl where county_id = '1';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= "Likely to experience ".$row['rainfall']."mm of rainfall with temperatures"
              . " of ".$row['temperature']."°C and humidity of ".$row['humidity']
              ." vapor per cubic\n";
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}

//Option 2 level 2 (Weather)
 else if ( $text == "2*1" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
     $response = "CON Weather updates! \n";
      $sql =<<<EOF
      SELECT * from weather_tbl where county_id = '2';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= "Likely to experience ".$row['rainfall']."mm of rainfall with temperatures"
              . " of ".$row['temperature']."°C and humidity of ".$row['humidity']
              ." vapor per cubic\n";
   }
    $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}


//Option 3 level 3 (Weather)
 else if ( $text == "3*1" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
     $response = "CON Weather updates! \n";
      $sql =<<<EOF
      SELECT * from weather_tbl where county_id = '3';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= "Likely to experience ".$row['rainfall']."mm of rainfall with temperatures"
              . " of ".$row['temperature']."°C and humidity of ".$row['humidity']
              ." vapor per cubic\n";
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}



/*
 * #######################################################################################################
   #######################################################################################################
 *  
 */


//Option 2 level 2 (Farming)
 else if ( $text == "1*2" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
     $response = "CON Farming advice! \n";
      $sql =<<<EOF
      SELECT * from farming_info_tbl where message_id = '1';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= $row['message']."\n";
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}


//Option 2 level 2 (Farming)
 else if ( $text == "2*2" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
      $response = "CON Farming advice! \n";
      $sql =<<<EOF
      SELECT * from farming_info_tbl where message_id = '2';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= $row['message']."\n";
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}

//Option 2 level 3 (Farming)
 else if ( $text == "3*2" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
      $response = "CON Farming advice! \n";
      $sql =<<<EOF
      SELECT * from farming_info_tbl where message_id = '3';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
      $response .= $row['message']."\n";
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}


/*
 * #######################################################################################################
   #######################################################################################################
 *  
 */



//Option 1 Level 2 (Water Level)
 else if ( $text == "1*3" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
      $response = "CON Water availability! \n";
      $sql =<<<EOF
      SELECT * from water_table where county_id = '1';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {    
       $response .= "You are likely to experience relatively lower water table in this area. You are advised to "
               . "use water moderately for future convenience\n";
      }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}


 else if ( $text == "2*3" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
     $response = "CON Water availability! \n";
      $sql =<<<EOF
      SELECT * from water_table where county_id = '2';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {   
       $response .= "You are likely to experience low water table in this area. You are advised to "
               . "conserve water for future convenience\n";     
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}



 else if ( $text == "3*3" ) {
  $db = new sqliteDB();
     // This is a second level response where the user selected 1 in the first instance     
     // This is a terminal request. Note how we start the response with END
     $response = "CON Water availability! \n";
      $sql =<<<EOF
      SELECT * from water_table where county_id = '3';
EOF;
   //fetch list of county names and county ids from db 
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ) {
       
       $response .= "You are most likely to experience higher water table in this area. You are advised to "
               . "observe proper water management to avoid flooding\n";        
   }
   $response .= "Satisfied by this info?\n";
   $response .= "4. Yes \n";
   $response .= "5. No \n";
   $response .= "0. Home \n";
   $db->close();
}
 

 /*
 * #######################################################################################################
   #######################################################################################################
 *  
 */

//Feedback system
 if (strpos($text, '4') !== false || strpos($text, '5') !== false) {
  //insert statistic records
//     $db = new sqliteDB();
//$sql =<<<EOF
//        
//INSERT INTO analytics_tbl (phone, service_id, session, ussd) VALUES
//($phoneNumber, $serviceCode, $sessionId, $text);
//
//EOF;
//
//   $ret = $db->exec($sql);
//   if(!$ret){
//       $response = "END Oops! something went wrong. Please try again later";
//      //echo $db->lastErrorMsg();
//   } else {
//     //records created successfully
//   $response = "END Thank! your response has been received";
//   }
//   $db->close();
    $response = "END Thank you! \nYour response has been received";
   
 }


// Print the response onto the page so that our gateway can read it
header('Content-type: text/plain');
echo $response;
// DONE!!!*
$db->close();  
   }