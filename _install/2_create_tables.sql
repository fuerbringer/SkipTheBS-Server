/* START table user ************************/
CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL /* Table is empty for now*/
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/* END table user ************************/

/* START table video_platform ************************/
CREATE TABLE IF NOT EXISTS `video_platform` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL, /* the name of the video service (example: YouTube) */
  `video_code_prefix` varchar(255) NOT NULL, /* The part of the URL that comes before the video code (example: https://www.youtube.com/watch?v=) */
  `domain` varchar(255) NOT NULL /* The domain of the video service (example: http://youtube.com) */
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `video_platform`
ADD PRIMARY KEY (`id`);
ALTER TABLE `video_platform`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/* END table video_platform **************************/


/* START table video ************************/
CREATE TABLE IF NOT EXISTS `video` (
`id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL UNIQUE, /* the video that comes after youtube watch?v= ...*/
  `platform_id` int(11) NOT NULL /* Which platform the video is hosted on */
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

ALTER TABLE `video`
 ADD PRIMARY KEY (`id`), ADD KEY `fkey` (`platform_id`);
ALTER TABLE `video`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
ALTER TABLE `video`
ADD CONSTRAINT `fkey` FOREIGN KEY (`platform_id`) REFERENCES `video_platform` (`id`);
/* END table video **************************/


/* START table section_type **************************/
CREATE TABLE IF NOT EXISTS `section_type` (
`id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL /* Advertisement, obnoxious intro, etc... */
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

ALTER TABLE `section_type`
 ADD PRIMARY KEY (`id`);
ALTER TABLE `section_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/* END table section_type **************************/

/* START table section **************************/
CREATE TABLE IF NOT EXISTS `section` (
`id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL, /* The video in question */
  `start` time NOT NULL, /* Start time of the ad/intro */
  `stop` time NOT NULL, /* End time of the ad/intro */
  `section_type_id` int(11) NOT NULL, /* What type of section this is (ad, intro) */
  `user_id` int(11) DEFAULT NULL /* Note: this is NULL in case the user submits via Captcha */
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

ALTER TABLE `section`
 ADD PRIMARY KEY (`id`), ADD KEY `section_type_id` (`section_type_id`), ADD KEY `video_id` (`video_id`), ADD KEY `user_id` (`user_id`);
ALTER TABLE `section`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
ALTER TABLE `section`
ADD CONSTRAINT `section_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
ADD CONSTRAINT `section_ibfk_1` FOREIGN KEY (`section_type_id`) REFERENCES `section_type` (`id`),
ADD CONSTRAINT `section_ibfk_2` FOREIGN KEY (`video_id`) REFERENCES `video` (`id`);
/* END table section **************************/
