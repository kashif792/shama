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
ERROR - 2019-10-14 19:59:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'group by subjectid' at line 1 - Invalid query: SELECT id,classid,sectionid,tacher_uid FROM `quize` WHERE subjectid = 990 AND classid = 85 AND sectionid = 78 AND semsterid = 1 AND sessionid = 42 AND tacher_uid =  group by subjectid
ERROR - 2019-10-14 15:23:37 --> Query error: Table 'shama2.semesester' doesn't exist - Invalid query: SELECT
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
					    INNER JOIN semesester 
					        ON (d.semester_id = semester.id)
					    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        d.school_id =1
ERROR - 2019-10-14 15:24:28 --> Query error: Not unique table/alias: 'semester' - Invalid query: SELECT
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
					    INNER JOIN semester 
					        ON (d.semester_id = semester.id)
					    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 11 AND
					        d.school_id =1
ERROR - 2019-10-14 15:24:30 --> Query error: Not unique table/alias: 'semester' - Invalid query: SELECT
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
					    INNER JOIN semester 
					        ON (d.semester_id = semester.id)
					    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        d.school_id =1
ERROR - 2019-10-14 15:49:43 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO) C:\wamp64\www\shama\application\controllers\Principal_controller.php 5403
