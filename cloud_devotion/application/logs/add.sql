ALTER TABLE `tbl_users` ADD `work_start` INT(1) NOT NULL COMMENT '作業開始時間' AFTER `roleId`, ADD `work_end` INT(1) NOT NULL COMMENT '作業終了時間' AFTER `work_start`;