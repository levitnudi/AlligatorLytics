<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'sqlitedb.php';
   
   //create alligatior.db database if not existing
   $db = new sqliteDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
    //Opened database successfully
    
   }


//Create 3 Tables;
$sql =<<<EOF

   CREATE TABLE county_tbl (
  county_id int(11) NOT NULL,
  county_name varchar(255) NOT NULL
);

 CREATE TABLE water_table (
  county_id int(11) NOT NULL,
  status_id int(11) NOT NULL,
  status varchar(50) NOT NULL
);

CREATE TABLE weather_tbl (
  county_id int(11) NOT NULL,
  rainfall float NOT NULL,
  temperature float NOT NULL,
  humidity float NOT NULL
);


CREATE TABLE farming_info_tbl (
  message_id int(11) NOT NULL,
  message text NOT NULL
);

CREATE TABLE analytics_tbl (
  record_id int(11) NOT NULL,
  session text NOT NULL,
  service_id text NOT NULL,
  phone varchar(16) NOT NULL,
  ussd text NOT NULL
);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
     //Tables created successfully
     //now let's insert some data
     echo 'success!';
   }
   $db->close();
   





//insert records from whatever sources e.g api
$sql =<<<EOF
INSERT INTO county_tbl (county_id, county_name) VALUES
(1, 'Turkana'),
(2, 'Isiolo'),
(3, 'Wajir');

INSERT INTO farming_info_tbl (message_id, message) VALUES
(1, 'Prepare your land for maize planting as the short rains are coming'),
(2, 'harvest your farm products as long rains are coming'),
(3, 'use water sparingly in your irrigation as there is  a looming water shortage.'),
(4, 'dig trenches and burrows in your farm as flash floods are coming');


INSERT INTO water_table (county_id, status_id, status) VALUES
(1, 1, 'Medium'),
(2, 1, 'Low'),
(3, 3, 'High');

INSERT INTO weather_tbl (county_id, rainfall, temperature, humidity) VALUES
(1, 100, 70, 50),
(2, 50, 30, 30),
(3, 65, 18, 60);

EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
     //Tables created successfully
     //now let's insert some data
     echo 'success!';
   }
   $db->close();
