<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-18 05:52:43 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `subject_id`, `created_at`) VALUES ('saveDatesheetDetail', '07:15', '08:15', '2019-10-18', '979', '2019-10-18 05:52')
ERROR - 2019-10-18 06:22:50 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:23:18 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:23:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:23:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:24:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:24:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:24:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:24:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 06:57:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
				' at line 21 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
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
					        d.class_id  =  AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
					        d.exam_type  = '' AND
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-18 07:03:43 --> Unable to connect to the database
ERROR - 2019-10-18 07:55:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY exam_date' at line 1 - Invalid query: Select * from datesheet_details where datesheet_id=  ORDER BY exam_date
ERROR - 2019-10-18 09:45:53 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
				' at line 25 - Invalid query: SELECT
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
					        d.class_id  =  AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
					        d.type= '' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-18 09:50:18 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: Select * from datesheets where id= 
