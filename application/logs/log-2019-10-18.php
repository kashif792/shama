<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-10-18 05:52:43 --> Query error: Cannot add or update a child row: a foreign key constraint fails (`shama2`.`datesheet_details`, CONSTRAINT `FK_Datesheet_table` FOREIGN KEY (`datesheet_id`) REFERENCES `datesheets` (`id`) ON DELETE CASCADE) - Invalid query: INSERT INTO `datesheet_details` (`datesheet_id`, `start_time`, `end_time`, `exam_date`, `subject_id`, `created_at`) VALUES ('saveDatesheetDetail', '07:15', '08:15', '2019-10-18', '979', '2019-10-18 05:52')
