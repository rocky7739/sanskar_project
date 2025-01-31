<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-03-10 10:08:12 --> 404 Page Not Found: /index
ERROR - 2021-03-10 10:13:39 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 10:13:39 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 10:13:39 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 10:13:39 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 10:13:39 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('189',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 10:14:11 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 10:14:11 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 10:14:11 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 10:14:11 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 10:14:11 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('179',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 10:49:37 --> 404 Page Not Found: /index
ERROR - 2021-03-10 10:49:39 --> 404 Page Not Found: /index
ERROR - 2021-03-10 10:50:27 --> 404 Page Not Found: /index
ERROR - 2021-03-10 10:51:06 --> Severity: Notice --> Undefined variable: validation_error /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_season_episode.php 12
ERROR - 2021-03-10 10:51:09 --> Severity: Notice --> Undefined variable: validation_error /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_season_episode.php 12
ERROR - 2021-03-10 11:21:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%t%' 
ERROR - 2021-03-10 11:21:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%ty%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%ty%' 
ERROR - 2021-03-10 11:22:02 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%tyj%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%tyj%' 
ERROR - 2021-03-10 11:22:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%ty%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%ty%' 
ERROR - 2021-03-10 11:22:03 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%t%' 
ERROR - 2021-03-10 11:22:07 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%s%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ps.season_title LIKE '%s%' 
ERROR - 2021-03-10 11:22:09 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sa%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ps.season_title LIKE '%sa%' 
ERROR - 2021-03-10 11:22:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sat%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ps.season_title LIKE '%sat%' 
ERROR - 2021-03-10 11:22:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sa%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ps.season_title LIKE '%sa%' 
ERROR - 2021-03-10 11:22:12 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%s%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ps.season_title LIKE '%s%' 
ERROR - 2021-03-10 11:22:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_description LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_description LIKE '%t%' 
ERROR - 2021-03-10 11:22:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_description LIKE '%ty%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_description LIKE '%ty%' 
ERROR - 2021-03-10 11:22:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_description LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_description LIKE '%t%' 
ERROR - 2021-03-10 11:23:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%t%' 
ERROR - 2021-03-10 11:23:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%ty%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%ty%' 
ERROR - 2021-03-10 11:23:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%t%' 
ERROR - 2021-03-10 11:23:24 --> 404 Page Not Found: /index
ERROR - 2021-03-10 11:23:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%t%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%t%' 
ERROR - 2021-03-10 11:23:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ep.episode_title LIKE '%ty%'' at line 5 - Invalid query: SELECT ep.id,ep.episode_title,ep.episode_description,ep.position,ep.status, ps.season_title as season_title
                From premium_episodes as ep
                LEFT JOIN premium_season as ps  ON ep.season_id = ps.id
                where ep.status !=2 and season_id=10 order by ep.position asc 
                 AND ep.episode_title LIKE '%ty%' 
ERROR - 2021-03-10 11:29:01 --> 404 Page Not Found: /index
ERROR - 2021-03-10 11:30:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%s%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%s%' 
ERROR - 2021-03-10 11:30:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sa%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%sa%' 
ERROR - 2021-03-10 11:30:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sad%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%sad%' 
ERROR - 2021-03-10 11:30:26 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sadu%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%sadu%' 
ERROR - 2021-03-10 11:30:27 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sad%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%sad%' 
ERROR - 2021-03-10 11:30:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%sa%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%sa%' 
ERROR - 2021-03-10 11:30:28 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.season_title LIKE '%s%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.season_title LIKE '%s%' 
ERROR - 2021-03-10 11:30:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.description LIKE '%t%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.description LIKE '%t%' 
ERROR - 2021-03-10 11:30:31 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.description LIKE '%th%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.description LIKE '%th%' 
ERROR - 2021-03-10 11:30:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.description LIKE '%the%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.description LIKE '%the%' 
ERROR - 2021-03-10 11:30:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.description LIKE '%th%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.description LIKE '%th%' 
ERROR - 2021-03-10 11:30:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'AND ps.description LIKE '%t%'' at line 5 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                 AND ps.description LIKE '%t%' 
ERROR - 2021-03-10 11:35:14 --> Severity: Notice --> Undefined index: episode_description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/view_season_episode.php 47
ERROR - 2021-03-10 11:35:27 --> Severity: Notice --> Undefined index: episode_description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season_episode.php 56
ERROR - 2021-03-10 11:54:59 --> Severity: error --> Exception: Too few arguments to function Premium_video::lock_unlock_episodes(), 1 passed in /home/appsansk/public_html/sanskar_development/system/core/CodeIgniter.php on line 532 and exactly 3 expected /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 1003
ERROR - 2021-03-10 11:55:08 --> Severity: error --> Exception: Too few arguments to function Premium_video::lock_unlock_episodes(), 2 passed in /home/appsansk/public_html/sanskar_development/system/core/CodeIgniter.php on line 532 and exactly 3 expected /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 1003
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:32 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:35 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:43 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:50 --> 404 Page Not Found: /index
ERROR - 2021-03-10 11:55:52 --> 404 Page Not Found: /index
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 986
ERROR - 2021-03-10 11:55:52 --> Severity: Notice --> Undefined property: stdClass::$season_id /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 987
ERROR - 2021-03-10 11:57:11 --> 404 Page Not Found: /index
ERROR - 2021-03-10 12:07:01 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 32
ERROR - 2021-03-10 12:07:01 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 32
ERROR - 2021-03-10 12:07:08 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 32
ERROR - 2021-03-10 12:07:08 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 32
ERROR - 2021-03-10 12:11:02 --> Severity: Notice --> Undefined index: episode_details /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/videos/Premium_video.php 58
ERROR - 2021-03-10 12:11:51 --> Severity: Notice --> Undefined index: episode_details /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/videos/Premium_video.php 59
ERROR - 2021-03-10 12:19:07 --> Severity: Notice --> Undefined variable: final_result /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/videos/Premium_video.php 67
ERROR - 2021-03-10 12:42:59 --> Severity: Notice --> Undefined index: id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Menu_master_model.php 247
ERROR - 2021-03-10 12:42:59 --> Severity: Notice --> Undefined index: id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Menu_master_model.php 247
ERROR - 2021-03-10 12:42:59 --> Severity: Notice --> Undefined index: id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Menu_master_model.php 247
ERROR - 2021-03-10 12:42:59 --> Severity: Notice --> Undefined index: id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Menu_master_model.php 247
ERROR - 2021-03-10 12:42:59 --> Severity: Notice --> Undefined index: id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Menu_master_model.php 247
ERROR - 2021-03-10 12:42:59 --> Severity: Notice --> Undefined index: id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Menu_master_model.php 247
ERROR - 2021-03-10 13:12:25 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:12:25 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:12:25 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 13:12:25 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 13:12:25 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('189',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 13:13:32 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:13:32 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:13:32 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 13:13:32 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 13:13:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('189',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 13:14:36 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:14:36 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:14:36 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 13:14:36 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 13:14:36 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('189',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 13:21:29 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:21:29 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 13:21:29 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 13:21:29 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 13:21:29 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('209',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 15:48:48 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:48:48 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:48:48 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 15:48:48 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 15:48:48 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('28',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 15:48:54 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:48:54 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:48:54 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 15:48:54 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 15:48:54 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('28',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 15:49:13 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:49:13 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:49:13 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 15:49:13 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 15:49:13 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('182',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 15:50:37 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:50:37 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:50:37 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 15:50:37 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 15:50:37 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('28',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 15:52:16 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:52:16 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-10 15:52:16 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-10 15:52:16 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-10 15:52:16 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('158',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-10 16:13:30 --> Severity: Notice --> Undefined variable: display_validity /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_plan.php 72
ERROR - 2021-03-10 16:41:13 --> Query error: Unknown column 'state' in 'field list' - Invalid query: SELECT `id`, `validity`, `amount`, `state`, `creation_time`
FROM `premium_plan`
WHERE `id` = '1'
ERROR - 2021-03-10 16:42:32 --> Severity: error --> Exception: Call to undefined function validate_jwt() /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 22
ERROR - 2021-03-10 16:43:50 --> Query error: Unknown column 'transection_via' in 'field list' - Invalid query: INSERT INTO `premium_transaction_record` (`user_id`, `plan_id`, `pre_transaction_id`, `amount`, `tax`, `coupon_applied`, `creation_time`, `pay_via`, `transection_via`) VALUES ('13256', '2', '846a0de0fa1ad92e54a83054955fbf', '60', '', '', 1615374830262, 'PAY_U_MONEY', 0)
ERROR - 2021-03-10 16:46:50 --> Query error: Unknown column 'device_type' in 'field list' - Invalid query: INSERT INTO `premium_transaction_record` (`user_id`, `plan_id`, `pre_transaction_id`, `amount`, `tax`, `coupon_applied`, `device_type`, `creation_time`, `pay_via`) VALUES ('13256', '2', '6697db6e1f8ccb4be7ee30a77112cb', '60', '', '', '1', 1615375010403, 'PAY_U_MONEY')
ERROR - 2021-03-10 16:47:19 --> Query error: Unknown column 'transection_via' in 'field list' - Invalid query: INSERT INTO `premium_transaction_record` (`user_id`, `plan_id`, `pre_transaction_id`, `amount`, `tax`, `coupon_applied`, `transection_via`, `creation_time`, `pay_via`) VALUES ('13256', '2', '85986debe4a573bb13a4c59bfa9c53', '60', '', '', '1', 1615375039469, 'PAY_U_MONEY')
ERROR - 2021-03-10 18:18:59 --> Severity: Notice --> Undefined index: amount /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 190
ERROR - 2021-03-10 18:18:59 --> Severity: Notice --> Undefined index: currency /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 191
ERROR - 2021-03-10 18:26:45 --> Severity: Notice --> Undefined variable: document /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 289
ERROR - 2021-03-10 18:53:49 --> Severity: error --> Exception: syntax error, unexpected '$validityyt_time' (T_VARIABLE), expecting ',' or ')' /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 168
ERROR - 2021-03-10 19:06:07 --> Severity: Notice --> A non well formed numeric value encountered /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 166
