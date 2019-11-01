<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-31 17:18:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND sm.status = 'a' AND se.status = 'a' GROUP by class_id' at line 5 - Invalid query: SELECT s.*,c.id as classid,c.grade as classname, sm.semester_id as semester_id FROM schedule s
				INNER JOIN classes c ON c.id = s.class_id
				INNER JOIN sessions se ON se.id = s.sessionid
				INNER JOIN semester_dates sm ON sm.session_id = se.id
				Where s.teacher_uid =  AND sm.status = 'a' AND se.status = 'a' GROUP by class_id
