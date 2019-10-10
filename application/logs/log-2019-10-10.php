<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-10 12:06:19 --> Unable to connect to the database
ERROR - 2019-10-10 17:23:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'Order by iv.id ASC' at line 1 - Invalid query: SELECT iv.id,iv.screenname FROM invantageuser iv INNER JOIN user_locations ul ON ul.user_id = iv.id INNER JOIN user_roles ur ON ur.user_id = iv.id WHERE ur.role_id = 4 AND ul.school_id =  Order by iv.id ASC
