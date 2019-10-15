<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-15 07:07:12 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5402
ERROR - 2019-10-15 07:07:29 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5402
ERROR - 2019-10-15 07:07:29 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5402
ERROR - 2019-10-15 07:28:55 --> Query error: Table 'shama2.semester_name' doesn't exist - Invalid query: SELECT *
FROM `semester_name`
WHERE `id` = '1'
ERROR - 2019-10-15 07:29:28 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5420
ERROR - 2019-10-15 07:29:55 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5420
ERROR - 2019-10-15 07:29:55 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5420
ERROR - 2019-10-15 07:31:44 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 5420
ERROR - 2019-10-15 07:40:47 --> Query error: Table 'shama2.school' doesn't exist - Invalid query: SELECT *
FROM `school`
WHERE `id` = '1'
ERROR - 2019-10-15 09:39:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY d.exam_date' at line 29 - Invalid query: SELECT
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
						        ON (d.session_id = sessions.id)
						    INNER JOIN semester as sem 
						        ON (d.semester_id = sem.id)
						    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        d.type= 'Mid' AND
					        d.school_id = ORDER BY d.exam_date
