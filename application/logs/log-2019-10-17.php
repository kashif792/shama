<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-17 04:41:45 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 04:53:28 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
						   	datesheets as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    
						    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        d.type= 'Mid' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-17 04:54:06 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
						   	datesheets as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    
						    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-17 04:54:29 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
						   	datesheets as d
						    INNER JOIN classes 
						        ON (d.class_id = classes.id)
						    INNER JOIN semester 
						        ON (semester.id = d.semester_id)
						    
						    INNER JOIN sessions 
						        ON (d.session_id = sessions.id)
						    
						    WHERE
					        d.class_id  = 82 AND
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-17 04:54:48 --> Query error: Unknown column 'subjects.subject_name' in 'field list' - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							, semester.semester_name
						    , subjects.subject_name
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
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-17 04:55:00 --> Query error: Unknown column 'd.exam_date' in 'order clause' - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							, semester.semester_name
						    
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
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-17 05:13:51 --> Query error: Unknown column 'Mid' in 'where clause' - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							, semester.semester_name
						    
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
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        d.exam_type  = Mid AND
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-17 05:14:25 --> Query error: Unknown column 'Mid' in 'where clause' - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							, semester.semester_name
						    
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
					        d.session_id  = 42 AND
					        d.semester_id  = 1 AND
					        d.exam_type  = Mid AND
					        d.school_id =1 ORDER BY d.created_at desc
ERROR - 2019-10-17 07:39:35 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `created_at`) VALUES ('1', '07:45', '08:00', '17 October, 2019', '2019-10-17 07:39')
ERROR - 2019-10-17 07:44:43 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `created_at`) VALUES ('1', '07:45', '08:00', '17 October, 2019', '2019-10-17 07:44')
ERROR - 2019-10-17 07:44:49 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `created_at`) VALUES ('1', '07:45', '08:00', '2019-10-17', '2019-10-17 07:44')
ERROR - 2019-10-17 07:53:10 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `subject_id`, `created_at`) VALUES ('979', '08:00', '08:15', '2019-10-17', '979', '2019-10-17 07:53')
ERROR - 2019-10-17 08:15:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 08:15:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:21:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:21:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:27:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:28:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:29:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:30:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:30:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:30:51 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:36:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
				' at line 23 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							,d.type
							
						    , semester.semester_name
						    
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
					        d.type= '' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-17 09:37:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
				' at line 23 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							,d.type
							
						    , semester.semester_name
						    
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
					        d.type= '' AND
					        d.school_id =1
ERROR - 2019-10-17 09:39:15 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
					        d.session_id  =  AND
					        d.semester_id  =  AND
				' at line 23 - Invalid query: SELECT
							d.id
							,d.start_time
							,d.end_time
						    ,classes.grade
							,d.type
							
						    , semester.semester_name
						    
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
					        d.type= '' AND
					        d.school_id =1
ERROR - 2019-10-17 09:40:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 09:40:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND
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
ERROR - 2019-10-17 10:29:33 --> Query error: Unknown column 'update_at' in 'field list' - Invalid query: UPDATE `datesheets` SET `class_id` = '85', `session_id` = '42', `school_id` = '1', `semester_id` = '11', `start_time` = '08:00', `end_time` = '08:15', `notes` = 'qwqeqweqweqqweqwe', `exam_type` = 'undefined', `update_at` = '2019-10-17 10:29'
WHERE `id` = '2'
ERROR - 2019-10-17 13:45:16 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `subject_id`, `created_at`) VALUES ('undefined', '10:00', '10:50', '2019-10-21', '982', '2019-10-17 13:45')
