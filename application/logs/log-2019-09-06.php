<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-06 05:14:45 --> Query error: Table 'shama.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'v9aj6de2ulmi6qijjvps1us47o4c5l9e'
AND `ip_address` = '::1'
ERROR - 2019-09-06 10:15:32 --> Query error: Table 'shama.student_semesters' doesn't exist - Invalid query: SELECT * FROM `student_semesters` INNER JOIN invantageuser as inv on inv.id=studentid WHERE classid = 84 AND sectionid = 78 AND semesterid = 1 AND sessionid = 42
ERROR - 2019-09-06 10:15:44 --> Query error: Table 'shama.student_semesters' doesn't exist - Invalid query: SELECT * FROM `student_semesters` INNER JOIN invantageuser as inv on inv.id=studentid WHERE classid = 84 AND sectionid = 78 AND semesterid = 1 AND sessionid = 42
ERROR - 2019-09-06 12:05:23 --> Query error: Column 'semesterid' cannot be null - Invalid query: INSERT INTO `student_semesters` (`classid`, `sectionid`, `semesterid`, `studentid`, `status`, `sessionid`) VALUES ('82', '78', NULL, '705', 'r', '42')
ERROR - 2019-09-06 12:37:23 --> Query error: Column 'semesterid' cannot be null - Invalid query: INSERT INTO `student_semesters` (`classid`, `sectionid`, `semesterid`, `studentid`, `status`, `sessionid`) VALUES ('82', '78', NULL, '722', 'r', '42')
ERROR - 2019-09-06 12:38:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '' at line 1 - Invalid query: Update student_semesters set status ='u' where  id =
ERROR - 2019-09-06 07:48:32 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1479
ERROR - 2019-09-06 07:48:43 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1477
ERROR - 2019-09-06 07:49:32 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1490
ERROR - 2019-09-06 07:49:43 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1494
ERROR - 2019-09-06 07:50:32 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1502
ERROR - 2019-09-06 07:50:43 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1506
ERROR - 2019-09-06 07:50:52 --> Severity: error --> Exception: syntax error, unexpected 'if' (T_IF), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1506
ERROR - 2019-09-06 07:51:19 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1509
ERROR - 2019-09-06 07:51:32 --> Severity: error --> Exception: syntax error, unexpected 'echo' (T_ECHO), expecting function (T_FUNCTION) or const (T_CONST) C:\wamp64\www\shama\application\controllers\Ips.php 1509
ERROR - 2019-09-06 14:33:29 --> Query error: Unknown column 'session_id' in 'where clause' - Invalid query: SELECT *
FROM `student_semesters`
WHERE `session_id` = '42'
AND `semester_id` = '11'
