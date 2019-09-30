<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-27 09:34:44 --> Query error: Column 'optionid' cannot be null - Invalid query: INSERT INTO `quiz_evaluation` (`studentid`, `quizid`, `questionid`, `optionid`) VALUES ('413', '21', '33', NULL)
ERROR - 2019-09-27 09:39:10 --> Query error: Column 'optionid' cannot be null - Invalid query: INSERT INTO `quiz_evaluation` (`studentid`, `quizid`, `questionid`, `optionid`) VALUES ('413', '21', '34', NULL)
ERROR - 2019-09-27 09:50:32 --> Query error: Column 'optionid' cannot be null - Invalid query: INSERT INTO `quiz_evaluation` (`studentid`, `quizid`, `questionid`, `optionid`) VALUES ('479', '21', '33', NULL)
ERROR - 2019-09-27 05:09:49 --> Unable to connect to the database
ERROR - 2019-09-27 05:09:56 --> Unable to connect to the database
ERROR - 2019-09-27 05:09:57 --> Unable to connect to the database
ERROR - 2019-09-27 12:50:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND q.classid = 85 AND q.sectionid = 78 AND s.status = 'a' AND se.status = 'a' A' at line 1 - Invalid query: SELECT q.* FROM quize q INNER JOIN semester s ON s.id = q.semsterid INNER JOIN sessions se ON se.id = q.sessionid Where q.subjectid =  AND q.classid = 85 AND q.sectionid = 78 AND s.status = 'a' AND se.status = 'a' AND q.tacher_uid = 485 AND q.semsterid = 1 AND q.sessionid = 42  order by q.quiz_term asc
ERROR - 2019-09-27 12:50:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND q.classid = 85 AND q.sectionid = 78 AND s.status = 'a' AND se.status = 'a' A' at line 1 - Invalid query: SELECT q.* FROM quize q INNER JOIN semester s ON s.id = q.semsterid INNER JOIN sessions se ON se.id = q.sessionid Where q.subjectid =  AND q.classid = 85 AND q.sectionid = 78 AND s.status = 'a' AND se.status = 'a' AND q.tacher_uid = 485 AND q.semsterid = 1 AND q.sessionid = 42  order by q.quiz_term asc
ERROR - 2019-09-27 12:52:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND subjectid = 990' at line 1 - Invalid query: SELECT * FROM quizemarks  where studentid =   AND subjectid = 990
ERROR - 2019-09-27 13:07:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'AND subjectid = 990' at line 1 - Invalid query: SELECT * FROM quizemarks  where quizid = 21 AND studentid =   AND subjectid = 990
ERROR - 2019-09-27 15:19:21 --> Query error: Unknown column 'semsterid' in 'where clause' - Invalid query: SELECT *
FROM `quizemarks`
WHERE `classid` = '85'
AND `sectionid` = '78'
AND `subjectid` = '990'
AND `studentid` = '408'
AND `quizid` = '21'
AND `semsterid` = '1'
AND `sessionid` = '42'
ERROR - 2019-09-27 11:17:12 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) C:\wamp64\www\shama\application\controllers\Ips.php 980
ERROR - 2019-09-27 11:17:12 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) C:\wamp64\www\shama\application\controllers\Ips.php 980
ERROR - 2019-09-27 11:18:12 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) C:\wamp64\www\shama\application\controllers\Ips.php 980
ERROR - 2019-09-27 11:18:13 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) C:\wamp64\www\shama\application\controllers\Ips.php 980
ERROR - 2019-09-27 16:19:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM correct_option  Where question_id =
ERROR - 2019-09-27 17:02:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM correct_option  Where question_id =
ERROR - 2019-09-27 17:03:24 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM correct_option  Where question_id =
ERROR - 2019-09-27 17:04:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: SELECT * FROM correct_option  Where question_id =
ERROR - 2019-09-27 17:09:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'quizid=21' at line 1 - Invalid query: SELECT * FROM quizemarks  Where studentid =407 quizid=21
ERROR - 2019-09-27 17:10:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'quizid=21' at line 1 - Invalid query: SELECT * FROM quizemarks  Where studentid =407 quizid=21
ERROR - 2019-09-27 17:11:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'quizid=21' at line 1 - Invalid query: SELECT * FROM quizemarks  Where studentid =407 quizid=21
