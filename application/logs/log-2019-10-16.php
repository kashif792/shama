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
ERROR - 2019-10-16 13:41:54 --> Query error: Unknown column 'q.sectionid' in 'where clause' - Invalid query: SELECT sum(q.marks) as total_sessional FROM quizzes_marks as q INNER JOIN quize as qi ON qi.id = q.quiz_id WHERE q.subject_id = 979 AND q.student_id= 551 AND q.sectionid = 78 AND q.semsterid = 1 AND q.sessionid = 42
ERROR - 2019-10-16 13:41:56 --> Query error: Unknown column 'q.sectionid' in 'where clause' - Invalid query: SELECT sum(q.marks) as total_sessional FROM quizzes_marks as q INNER JOIN quize as qi ON qi.id = q.quiz_id WHERE q.subject_id = 979 AND q.student_id= 705 AND q.sectionid = 78 AND q.semsterid = 1 AND q.sessionid = 42
ERROR - 2019-10-16 13:42:07 --> Query error: Unknown column 'q.sectionid' in 'where clause' - Invalid query: SELECT sum(q.marks) as total_sessional FROM quizzes_marks as q INNER JOIN quize as qi ON qi.id = q.quiz_id WHERE q.subject_id = 979 AND q.student_id= 722 AND q.sectionid = 78 AND q.semsterid = 1 AND q.sessionid = 42
ERROR - 2019-10-16 14:29:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid =
ERROR - 2019-10-16 14:38:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid =
ERROR - 2019-10-16 14:40:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid =
ERROR - 2019-10-16 14:41:14 --> Query error: Unknown column 'NaN' in 'where clause' - Invalid query: SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid = NaN
ERROR - 2019-10-16 14:41:14 --> Query error: Unknown column 'NaN' in 'where clause' - Invalid query: Select s.* from subjects s INNER JOIN schedule sc On sc.subject_id = s.id where sc.class_id = NaN AND sc.teacher_uid =327 AND s.session_id = 42 AND s.semsterid = 1
ERROR - 2019-10-16 14:44:21 --> Query error: Unknown column 'NaN' in 'where clause' - Invalid query: SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid = NaN
ERROR - 2019-10-16 14:44:21 --> Query error: Unknown column 'NaN' in 'where clause' - Invalid query: Select s.* from subjects s INNER JOIN schedule sc On sc.subject_id = s.id where sc.class_id = NaN AND sc.teacher_uid =327 AND s.session_id = 42 AND s.semsterid = 1
ERROR - 2019-10-16 14:46:36 --> Query error: Unknown column 'NaN' in 'where clause' - Invalid query: SELECT  s.*,ass.id as sid FROM sections s INNER JOIN assignsections ass on ass.sectionid = s.id  where ass.status = 'a' AND ass.classid = NaN
ERROR - 2019-10-16 14:46:36 --> Query error: Unknown column 'NaN' in 'where clause' - Invalid query: Select s.* from subjects s INNER JOIN schedule sc On sc.subject_id = s.id where sc.class_id = NaN AND sc.teacher_uid =327 AND s.session_id = 42 AND s.semsterid = 1
ERROR - 2019-10-16 15:37:17 --> Query error: Unknown column 'type' in 'field list' - Invalid query: INSERT INTO `datesheets` (`class_id`, `session_id`, `school_id`, `type`, `semester_id`, `start_time`, `end_time`, `notes`, `created_at`) VALUES ('82', '42', '1', NULL, '1', '15:30', '15:45', 'undefined', '2019-10-16 15:37')
