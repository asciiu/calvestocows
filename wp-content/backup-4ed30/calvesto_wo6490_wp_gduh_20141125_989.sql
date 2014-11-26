# WordPress MySQL database backup
#
# Generated: Tuesday 25. November 2014 22:49 UTC
# Hostname: localhost
# Database: `calvesto_wo6490`
# --------------------------------------------------------
# --------------------------------------------------------
# Table: `wp_gduh_commentmeta`
# --------------------------------------------------------


#
# Delete any existing table `wp_gduh_commentmeta`
#

DROP TABLE IF EXISTS `wp_gduh_commentmeta`;


#
# Table structure of table `wp_gduh_commentmeta`
#

CREATE TABLE `wp_gduh_commentmeta` (
  `meta_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_value` longtext,
  PRIMARY KEY (`meta_id`),
  KEY `comment_id` (`comment_id`),
  KEY `meta_key` (`meta_key`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ;

#
# Data contents of table `wp_gduh_commentmeta`
#
 
INSERT INTO `wp_gduh_commentmeta` VALUES (1, 2, 'akismet_history', 'a:4:{s:4:"time";d:1408686976.004293;s:7:"message";s:99:"Akismet was unable to check this comment (response: invalid), will automatically retry again later.";s:5:"event";s:11:"check-error";s:4:"user";s:0:"";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (2, 2, 'akismet_history', 'a:4:{s:4:"time";d:1408842347.4405589;s:7:"message";s:51:"mlaughlin432 changed the comment status to approved";s:5:"event";s:15:"status-approved";s:4:"user";s:12:"mlaughlin432";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (3, 3, 'akismet_history', 'a:4:{s:4:"time";d:1408784332.9689729;s:7:"message";s:99:"Akismet was unable to check this comment (response: invalid), will automatically retry again later.";s:5:"event";s:11:"check-error";s:4:"user";s:0:"";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (4, 3, 'akismet_history', 'a:4:{s:4:"time";d:1408842349.210608;s:7:"message";s:51:"mlaughlin432 changed the comment status to approved";s:5:"event";s:15:"status-approved";s:4:"user";s:12:"mlaughlin432";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (5, 4, 'akismet_history', 'a:4:{s:4:"time";d:1408842512.5864279;s:7:"message";s:99:"Akismet was unable to check this comment (response: invalid), will automatically retry again later.";s:5:"event";s:11:"check-error";s:4:"user";s:12:"mlaughlin432";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (6, 5, 'akismet_history', 'a:4:{s:4:"time";d:1408491690.201005;s:7:"message";s:51:"mlaughlin432 changed the comment status to approved";s:5:"event";s:15:"status-approved";s:4:"user";s:12:"mlaughlin432";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (7, 5, 'akismet_history', 'a:4:{s:4:"time";d:1408282352.49664;s:7:"message";s:99:"Akismet was unable to check this comment (response: invalid), will automatically retry again later.";s:5:"event";s:11:"check-error";s:4:"user";s:0:"";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (8, 6, 'akismet_history', 'a:4:{s:4:"time";d:1408491872.7513781;s:7:"message";s:99:"Akismet was unable to check this comment (response: invalid), will automatically retry again later.";s:5:"event";s:11:"check-error";s:4:"user";s:12:"mlaughlin432";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (9, 7, 'akismet_history', 'a:4:{s:4:"time";d:1408569897.6458361;s:7:"message";s:99:"Akismet was unable to check this comment (response: invalid), will automatically retry again later.";s:5:"event";s:11:"check-error";s:4:"user";s:0:"";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (10, 8, 'akismet_result', 'false'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (11, 8, 'akismet_history', 'a:4:{s:4:"time";d:1401135354.3881879;s:7:"message";s:28:"Akismet cleared this comment";s:5:"event";s:9:"check-ham";s:4:"user";s:0:"";}'); 
INSERT INTO `wp_gduh_commentmeta` VALUES (12, 8, 'akismet_history', 'a:4:{s:4:"time";d:1401160081.9403701;s:7:"message";s:44:"fahri changed the comment status to approved";s:5:"event";s:15:"status-approved";s:4:"user";s:5:"fahri";}');
#
# End of data contents of table `wp_gduh_commentmeta`
# --------------------------------------------------------

# --------------------------------------------------------
# Table: `wp_gduh_comments`
# --------------------------------------------------------


#
# Delete any existing table `wp_gduh_comments`
#

DROP TABLE IF EXISTS `wp_gduh_comments`;


#
# Table structure of table `wp_gduh_comments`
#

CREATE TABLE `wp_gduh_comments` (
  `comment_ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `comment_post_ID` bigint(20) unsigned NOT NULL DEFAULT '0',
  `comment_author` tinytext NOT NULL,
  `comment_author_email` varchar(100) NOT NULL DEFAULT '',
  `comment_author_url` varchar(200) NOT NULL DEFAULT '',
  `comment_author_IP` varchar(100) NOT NULL DEFAULT '',
  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `comment_content` text NOT NULL,
  `comment_karma` int(11) NOT NULL DEFAULT '0',
  `comment_approved` varchar(20) NOT NULL DEFAULT '1',
  `comment_agent` varchar(255) NOT NULL DEFAULT '',
  `comment_type` varchar(20) NOT NULL DEFAULT '',
  `comment_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`comment_ID`),
  KEY `comment_post_ID` (`comment_post_ID`),
  KEY `comment_approved_date_gmt` (`comment_approved`,`comment_date_gmt`),
  KEY `comment_date_gmt` (`comment_date_gmt`),
  KEY `comment_parent` (`comment_parent`),
  KEY `comment_author_email` (`comment_author_email`(10))
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 ;

#
# Data contents of table `wp_gduh_comments`
#
 
INSERT INTO `wp_gduh_comments` VALUES (1, 1, 'Mr WordPress', '', 'https://wordpress.org/', '', '2014-11-04 03:57:56', '2014-11-04 03:57:56', 'Hi, this is a comment.\nTo delete a comment, just log in and view the post&#039;s comments. There you will have the option to edit or delete them.', 0, 'post-trashed', '', '', 0, 0); 
INSERT INTO `wp_gduh_comments` VALUES (2, 2464, 'free fat loss secrets', 'annette_marchand@gmail.com', 'http://bit.ly/1tipLIU', '192.161.162.242', '2014-08-22 05:56:15', '2014-08-22 05:56:15', 'Hey There. I discovered your weblog using msn. That is \na very neatly written article. I will make sure to bookmark it and return to learn extra of your useful \ninformation. Thanks for the post. I will certainly \nreturn.', 0, '1', '', '', 0, 0); 
INSERT INTO `wp_gduh_comments` VALUES (3, 2464, 'summer fat loss workout', 'sherigertz@gawab.com', 'http://bit.ly/1tipLIU', '188.208.15.74', '2014-08-23 08:58:52', '2014-08-23 08:58:52', 'Excellent web site you\'ve got here.. It\'s hard \nto find high-quality writing like yours nowadays.\n\nI truly appreciate people like you! Take care!!', 0, '1', '', '', 0, 0); 
INSERT INTO `wp_gduh_comments` VALUES (4, 2464, 'Maxwell Laughlin', 'mlaughlin432@gmail.com', '', '71.218.52.173', '2014-08-24 01:08:32', '2014-08-24 01:08:32', 'Thanks for the kind words! There are plenty more good articles to come!', 0, '1', '', '', 2, 3); 
INSERT INTO `wp_gduh_comments` VALUES (5, 2605, 'Ethan', 'dorieservice@aol.com', 'http://Desiree.over-blog.com', '183.220.228.180', '2014-08-17 13:32:32', '2014-08-17 13:32:32', 'I see a lot of interesting articles here. You have to spend a lot of time writing, i know how to save you a lot \nof work, there is an online tool that creates high quality,\ngoogle friendly posts in minutes, just search in google  - k2 \nunlimited content', 0, '1', '', '', 0, 0); 
INSERT INTO `wp_gduh_comments` VALUES (6, 2605, 'Maxwell Laughlin', 'mlaughlin432@gmail.com', '', '71.218.52.173', '2014-08-19 23:44:32', '2014-08-19 23:44:32', 'Ethan, \nThanks for your positive feedback! That\'s really cool that you like to write as well. We are always looking for guest writers and I would be happy to do the same if you have a blog too! You can email me at couchdivorce@gmail.com. Thanks!', 0, '1', '', '', 5, 3); 
INSERT INTO `wp_gduh_comments` VALUES (7, 2605, 'Chester', 'michalgatty@gmail.com', 'http://Tamera.wikispaces.com', '111.9.137.223', '2014-08-20 21:24:57', '2014-08-20 21:24:57', 'I see a lot of interesting articles here. You have to spend a \nlot of time writing, i know how to save you a lot of time, there is an online tool that creates readable,\ngoogle friendly posts in minutes, just type in google  - k2 unlimited content', 0, '0', '', '', 0, 0); 
INSERT INTO `wp_gduh_comments` VALUES (8, 1900, 'Daily News Company', 'snowwhitesmooky@gmail.com', 'http://www.dailynewscompany.com', '182.178.161.101', '2014-05-27 03:15:54', '2014-05-26 20:15:54', 'Beautiful image effect on feature image', 0, 'post-trashed', '', '', 0, 0); 
INSERT INTO `wp_gduh_comments` VALUES (9, 3078, 'Carl', 'jasminllewelyn@gmail.com', 'http://Consuelo.blogspot.com', '183.222.72.134', '2014-11-19 12:04:07', '2014-11-19 19:04:07', 'Do you know that you can copy articles from other sites to your blog and they will pass \r\ncopyscape test and google will see them as unique? I know one cool \r\ntool that will help you to do that, just type in google  - masagaltas free content', 0, '0', 'Mozilla/5.0 (Windows NT 5.1; rv:13.0) Gecko/20100101 Firefox/13.0.1', '', 0, 0);