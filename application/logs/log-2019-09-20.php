<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-09-20 04:24:16 --> Query error: Column 'session_id' cannot be null - Invalid query: INSERT INTO `semester_dates` (`session_id`, `semester_id`, `start_date`, `end_date`, `school_id`, `created`, `last_edited`) VALUES (NULL, '1', '2019-12-31', '2020-07-01', NULL, '2019-09-20', '2019-09-20')
ERROR - 2019-09-20 06:24:33 --> Query error: Table 'shama2.ci_sessions' doesn't exist - Invalid query: SELECT `data`
FROM `ci_sessions`
WHERE `id` = 'i1rcg3p5fq02fph5s5fqohtfjuj456hh'
AND `ip_address` = '::1'
ERROR - 2019-09-20 11:25:33 --> Query error: Table 'shama2.student_semesters' doesn't exist - Invalid query: SELECT * FROM `student_semesters` INNER JOIN invantageuser as inv on inv.id=studentid WHERE classid = 82 AND sectionid = 78 AND semesterid = 1 AND sessionid = 42
ERROR - 2019-09-20 07:47:06 --> Severity: error --> Exception: syntax error, unexpected 'else' (T_ELSE) C:\wamp64\www\shama\application\controllers\Ips.php 1591
