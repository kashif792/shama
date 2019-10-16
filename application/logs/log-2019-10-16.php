<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-16 07:24:47 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
					        d.type= '' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-16 07:24:47 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-16 07:24:51 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
					        d.semester_id  = 11 AND
					        d.type= 'Mid' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-16 07:24:53 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
					        d.semester_id  = 11 AND
					        d.type= 'Final' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-16 07:24:54 --> Query error: Unknown column 'd.type' in 'field list' - Invalid query: SELECT
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
					        d.type= 'Final' AND
					        d.school_id =1 ORDER BY d.exam_date
ERROR - 2019-10-16 09:54:50 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`quize`, CONSTRAINT `quize_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) - Invalid query: UPDATE `quize` SET `qname` = 'Math Multiple', `classid` = '82', `sectionid` = '78', `subjectid` = '?', `quiz_term` = 'bt', `quiz_date` = '2019-10-16', `isdone` = 0, `last_update` = '2019-10-16 09:54', `datetime` = '2019-10-16 09:54', `tacher_uid` = '552', `semsterid` = '1', `school_id` = '1', `uniquecode` = ''
WHERE `id` = '29'
ERROR - 2019-10-16 09:54:51 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`quize`, CONSTRAINT `quize_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) - Invalid query: UPDATE `quize` SET `qname` = 'Math Multiple', `classid` = '82', `sectionid` = '78', `subjectid` = '?', `quiz_term` = 'bt', `quiz_date` = '2019-10-16', `isdone` = 0, `last_update` = '2019-10-16 09:54', `datetime` = '2019-10-16 09:54', `tacher_uid` = '552', `semsterid` = '1', `school_id` = '1', `uniquecode` = ''
WHERE `id` = '29'
ERROR - 2019-10-16 09:54:52 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`quize`, CONSTRAINT `quize_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) - Invalid query: UPDATE `quize` SET `qname` = 'Math Multiple', `classid` = '82', `sectionid` = '78', `subjectid` = '?', `quiz_term` = 'bt', `quiz_date` = '2019-10-16', `isdone` = 0, `last_update` = '2019-10-16 09:54', `datetime` = '2019-10-16 09:54', `tacher_uid` = '552', `semsterid` = '1', `school_id` = '1', `uniquecode` = ''
WHERE `id` = '29'
ERROR - 2019-10-16 09:54:52 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`quize`, CONSTRAINT `quize_ibfk_2` FOREIGN KEY (`subjectid`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE) - Invalid query: UPDATE `quize` SET `qname` = 'Math Multiple', `classid` = '82', `sectionid` = '78', `subjectid` = '?', `quiz_term` = 'bt', `quiz_date` = '2019-10-16', `isdone` = 0, `last_update` = '2019-10-16 09:54', `datetime` = '2019-10-16 09:54', `tacher_uid` = '552', `semsterid` = '1', `school_id` = '1', `uniquecode` = ''
WHERE `id` = '29'
