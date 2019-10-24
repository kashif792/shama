<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-23 08:09:08 --> Severity: error --> Exception: syntax error, unexpected ',' C:\wamp64\www\shama\application\controllers\Principal_controller.php 2687
ERROR - 2019-10-23 13:20:27 --> Query error: Column 'mon_status' cannot be null - Invalid query: INSERT INTO `schedule` (`last_update`, `subject_id`, `class_id`, `section_id`, `teacher_uid`, `mon_status`, `mon_start_time`, `mon_end_time`, `tue_status`, `tue_start_time`, `tue_end_time`, `wed_status`, `wed_start_time`, `wed_end_time`, `thu_status`, `thu_start_time`, `thu_end_time`, `fri_status`, `fri_start_time`, `fri_end_time`, `sat_status`, `sat_start_time`, `sat_end_time`, `sun_status`, `sun_start_time`, `sun_end_time`, `semsterid`, `sessionid`) VALUES ('2019-10-23', '979', '82', '78', '350', NULL, '08:20', '14:20', NULL, '08:20', '14:20', NULL, '09:20', '15:20', 'Inactive', '00:00', '00:00', 'Inactive', '00:00', '00:00', 'Inactive', '00:00', '00:00', 'Inactive', '00:00', '00:00', '1', '42')
ERROR - 2019-10-23 15:05:27 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\wamp64\www\shama\application\views\principal\exam_timetable.php 88
ERROR - 2019-10-23 15:05:42 --> Severity: error --> Exception: syntax error, unexpected '=' C:\wamp64\www\shama\application\views\principal\exam_timetable.php 88
ERROR - 2019-10-23 15:37:14 --> Severity: error --> Exception: syntax error, unexpected '}', expecting ',' or ';' C:\wamp64\www\shama\application\views\principal\exam_timetable.php 404
ERROR - 2019-10-23 11:54:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.semester_id  =  AND
					        
					        d.school_id' at line 22 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
							,d.start_date
							,d.end_date
						    ,classes.grade
							, semester.semester_name
						    , d.exam_type
						    , sessions.datefrom
						    , sessions.dateto
							FROM
						   	datesheets as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    WHERE
					        d.session_id  =  AND
					        d.semester_id  =  AND
					        
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-23 12:11:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.semester_id  =  AND
					        
					        d.school_id' at line 22 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
							,d.start_date
							,d.end_date
						    ,classes.grade
							, semester.semester_name
						    , d.exam_type
						    , sessions.datefrom
						    , sessions.dateto
							FROM
						   	datesheets as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    WHERE
					        d.session_id  =  AND
					        d.semester_id  =  AND
					        
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-23 12:12:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.semester_id  =  AND
					        
					        d.school_id' at line 22 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
							,d.start_date
							,d.end_date
						    ,classes.grade
							, semester.semester_name
						    , d.exam_type
						    , sessions.datefrom
						    , sessions.dateto
							FROM
						   	datesheets as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    WHERE
					        d.session_id  =  AND
					        d.semester_id  =  AND
					        
					        d.school_id =1 ORDER BY d.created_at desc
