<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-09 15:10:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'ORDER BY i.screenname ASC' at line 1 - Invalid query: SELECT s.* FROM `student_semesters` as s INNER JOIN  invantageuser AS i ON s.studentid = i.id where s.classid = 85 AND s.sectionid = 78 AND s.semesterid = 1 AND s.sessionid =  ORDER BY i.screenname ASC 
