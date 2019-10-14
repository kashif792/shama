<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-14 07:58:50 --> Severity: error --> Exception: syntax error, unexpected ')', expecting ',' or ';' C:\wamp64\www\shama\application\controllers\Principal_controller.php 5347
ERROR - 2019-10-14 07:59:00 --> Severity: error --> Exception: syntax error, unexpected ')', expecting ',' or ';' C:\wamp64\www\shama\application\controllers\Principal_controller.php 5347
ERROR - 2019-10-14 08:08:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 21 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							,d.type
							,d.exam_date
						    , semester.semester_name
						    , subjects.subject_name
						    , sessions.datefrom
						    , sessions.dateto
					FROM
					   datesheet as d
					    INNER JOIN classes 
					        ON (d.class_id = classes.id)
					    INNER JOIN semester 
					        ON (semester.id = d.semester_id)
					    INNER JOIN subjects 
					        ON (subjects.id = d.subject_id)
					    INNER JOIN sessions 
					        ON (d.session_id = sessions.id) WHERE d.school_id =
