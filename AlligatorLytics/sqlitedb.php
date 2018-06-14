<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 //SQLite DB Helper class
   class sqliteDB extends SQLite3 {
      function __construct() {
         $this->open('alligator.db');
      }
   }
   
  