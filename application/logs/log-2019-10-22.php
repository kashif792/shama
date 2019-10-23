<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-22 05:04:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.exam_type  = '' AND
					        d.school_id =1 ORDER BY d.' at line 25 - Invalid query: SELECT
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
					        d.class_id  = 82 AND
					        d.session_id  = 43 AND
					        d.semester_id  =  AND
					        d.exam_type  = '' AND
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-22 05:04:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.exam_type  = '' AND
					        d.school_id =1 ORDER BY d.' at line 25 - Invalid query: SELECT
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
					        d.class_id  = 82 AND
					        d.session_id  = 43 AND
					        d.semester_id  =  AND
					        d.exam_type  = '' AND
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-22 05:05:18 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        
					        d.school_id =1 ORDER BY d.created_at desc' at line 25 - Invalid query: SELECT
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
					        
					        d.session_id  = 43 AND
					        d.semester_id  =  AND
					        
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-22 06:11:13 --> Severity: error --> Exception: syntax error, unexpected ')' C:\wamp64\www\shama\application\controllers\Principal_controller.php 714
ERROR - 2019-10-22 06:12:27 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 721
ERROR - 2019-10-22 06:13:28 --> Severity: error --> Exception: Cannot use object of type stdClass as array C:\wamp64\www\shama\application\controllers\Principal_controller.php 721
ERROR - 2019-10-22 06:57:14 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.semester_id  =  AND
					        
					        d.school_id' at line 24 - Invalid query: SELECT
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
ERROR - 2019-10-22 12:08:28 --> Severity: error --> Exception: syntax error, unexpected '=>' (T_DOUBLE_ARROW), expecting ',' or ')' C:\wamp64\www\shama\application\controllers\Principal_controller.php 2545
