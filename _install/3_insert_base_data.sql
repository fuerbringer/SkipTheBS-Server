/* Insert YouTube as video platform. More could technically be added. */
INSERT INTO `skipthebs`.`video_platform` (`id`, `name`, `video_code_prefix`, `domain`) VALUES ('1', 'YouTube', 'youtube.com/watch?v=', 'youtube.com');

/* Insert a video: using one of LTTs videos. Perfect for testing purposes since his videos are full of annoying sponsored spots and obnoxious intros */
INSERT INTO `skipthebs`.`video` (`id`, `code`, `platform_id`) VALUES ('1', 'VdJdHf8BscM', '1');

/* Inserting the advertisement and intro sections */
INSERT INTO `skipthebs`.`section_type` (`id`, `name`) VALUES ('1', 'advertisement');
INSERT INTO `skipthebs`.`section_type` (`id`, `name`) VALUES ('2', 'intro');

/* Finally, insert where the ad begins and stops */
INSERT INTO `skipthebs`.`section` (`id`, `video_id`, `start`, `stop`, `section_type_id`) VALUES (NULL, '1', '42.0', '52.0', '1');
INSERT INTO `skipthebs`.`section` (`id`, `video_id`, `start`, `stop`, `section_type_id`) VALUES (NULL, '1', '489.0', '571.0', '1');
INSERT INTO `skipthebs`.`section` (`id`, `video_id`, `start`, `stop`, `section_type_id`) VALUES (NULL, '1', '33.0', '41.0', '2');
