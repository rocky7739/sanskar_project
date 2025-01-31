<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-03-08 10:19:08 --> 404 Page Not Found: /index
ERROR - 2021-03-08 10:45:12 --> Query error: Unknown column 'pe.published_date' in 'where clause' - Invalid query: SELECT pe.id,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status,ps.season_title
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=1 and  pe.status !=2 and pe.published_date <= '1615180512291' order by pe.position desc limit 0,10
ERROR - 2021-03-08 10:52:43 --> Query error: Unknown column 'pe.published_date' in 'where clause' - Invalid query: SELECT pe.id,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status,ps.season_title
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=5 and  pe.status !=2 and pe.published_date <= '1615180963279' order by pe.position desc limit 0,10
ERROR - 2021-03-08 10:57:41 --> Severity: Notice --> Undefined offset: 0 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 152
ERROR - 2021-03-08 11:31:30 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 136
ERROR - 2021-03-08 11:31:30 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-10,10' at line 4 - Invalid query: SELECT pe.id as episode_id,ps.season_title,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status,0 as is_locked
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=1 and  pe.status !=2 and ps.published_date <= '1615183290718' order by pe.position desc limit -10,10
ERROR - 2021-03-08 11:31:55 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 136
ERROR - 2021-03-08 11:31:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-10,10' at line 4 - Invalid query: SELECT pe.id as episode_id,ps.season_title,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=1 and  pe.status !=2 and ps.published_date <= '1615183315075' order by pe.position desc limit -10,10
ERROR - 2021-03-08 11:31:57 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 136
ERROR - 2021-03-08 11:31:57 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-10,10' at line 4 - Invalid query: SELECT pe.id as episode_id,ps.season_title,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=1 and  pe.status !=2 and ps.published_date <= '1615183317592' order by pe.position desc limit -10,10
ERROR - 2021-03-08 11:32:08 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 136
ERROR - 2021-03-08 11:32:08 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '-10,10' at line 4 - Invalid query: SELECT pe.id as episode_id,ps.season_title,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=1 and  pe.status !=2 and ps.published_date <= '1615183328398' order by pe.position desc limit -10,10
ERROR - 2021-03-08 12:10:57 --> Severity: Notice --> Undefined index: episode_id /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/videos/Premium_video.php 96
ERROR - 2021-03-08 12:11:32 --> Severity: Notice --> Undefined index: episode_id /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/videos/Premium_video.php 96
ERROR - 2021-03-08 12:11:43 --> Severity: Notice --> Undefined index: episode_id /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/videos/Premium_video.php 96
ERROR - 2021-03-08 12:41:49 --> Severity: Notice --> Undefined variable: episode_id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 133
ERROR - 2021-03-08 12:41:49 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near ')  and  pe.status !=2 and ps.published_date <= '1615187509190' order by pe.posit' at line 4 - Invalid query: SELECT pe.season_id,pe.id as episode_id,ps.season_title,pe.episode_title,pe.thumbnail_url,pe.episode_url,pe.yt_episode_url,pe.status,0 as is_locked
                From premium_episodes as pe
                LEFT JOIN premium_season as ps  ON pe.season_id = ps.id
                where pe.season_id=1  and pe.id NOT IN ()  and  pe.status !=2 and ps.published_date <= '1615187509190' order by pe.position desc limit 0,10
ERROR - 2021-03-08 14:13:38 --> 404 Page Not Found: ../modules/auth_panel/controllers//index
ERROR - 2021-03-08 14:33:18 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:33:18 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:33:19 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:33:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:34:09 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:34:09 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:34:10 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:34:10 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:34:44 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:34:44 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:36:22 --> 404 Page Not Found: ../modules/data_model/controllers/videos/Premium_video/get_related_episodes_by_season_id
ERROR - 2021-03-08 14:37:51 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:37:51 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 14:39:02 --> 404 Page Not Found: ../modules/data_model/controllers/videos/Premium_video/get_related_episodes_by_season_id
ERROR - 2021-03-08 14:39:11 --> 404 Page Not Found: ../modules/data_model/controllers/videos/Premium_video/get_related_episodes_by_season_id
ERROR - 2021-03-08 14:39:16 --> 404 Page Not Found: ../modules/data_model/controllers/videos/Premium_video/get_related_episodes_by_season_id
ERROR - 2021-03-08 14:56:18 --> Query error: Unknown column 'pv.id' in 'field list' - Invalid query: SELECT pv.id,ps.season_title,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                
ERROR - 2021-03-08 14:56:22 --> 404 Page Not Found: /index
ERROR - 2021-03-08 14:56:24 --> 404 Page Not Found: /index
ERROR - 2021-03-08 14:56:24 --> Query error: Unknown column 'pv.id' in 'field list' - Invalid query: SELECT pv.id,ps.season_title,ps.category_ids,ps.author_id,ps.status,ps.published_date,ps.position, premium_author.p_author_name as author_name
                From premium_season as ps
                LEFT JOIN premium_author  ON ps.author_id = premium_author.id
                where ps.status !=2 order by ps.position asc
                
ERROR - 2021-03-08 14:56:53 --> 404 Page Not Found: /index
ERROR - 2021-03-08 14:56:54 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:54 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:54 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:54 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:54 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:56 --> 404 Page Not Found: /index
ERROR - 2021-03-08 14:56:56 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:56 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:56 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:56 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:56:56 --> Severity: Notice --> Undefined property: stdClass::$description /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/videos/Premium_video.php 683
ERROR - 2021-03-08 14:57:25 --> 404 Page Not Found: /index
ERROR - 2021-03-08 14:58:26 --> 404 Page Not Found: /index
ERROR - 2021-03-08 14:59:03 --> 404 Page Not Found: /index
ERROR - 2021-03-08 15:02:17 --> 404 Page Not Found: ../modules/data_model/controllers/videos/Premium_video/get_related_episodes_by_season_id
ERROR - 2021-03-08 15:39:46 --> 404 Page Not Found: ../modules/data_model/controllers/Menu_master/get_premium_plan
ERROR - 2021-03-08 16:01:19 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 16:01:19 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 16:01:19 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 16:01:19 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 16:01:19 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 40
ERROR - 2021-03-08 16:01:19 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 40
ERROR - 2021-03-08 16:01:19 --> Severity: Notice --> Undefined variable: all /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 101
ERROR - 2021-03-08 16:01:19 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 101
ERROR - 2021-03-08 16:25:17 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:25:17 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:25:36 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:25:36 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:48:49 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:48:49 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:49:17 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:49:17 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:50:17 --> Severity: Notice --> Undefined variable: categories /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 16:50:17 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/edit_season.php 31
ERROR - 2021-03-08 17:04:20 --> Severity: Notice --> Undefined variable: display_validity /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_plan.php 72
ERROR - 2021-03-08 17:04:33 --> Severity: Notice --> Undefined variable: display_validity /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_plan.php 72
ERROR - 2021-03-08 17:23:10 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 17:23:10 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 17:23:10 --> Severity: Warning --> in_array() expects parameter 2 to be array, string given /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 17:23:10 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 34
ERROR - 2021-03-08 17:23:10 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 40
ERROR - 2021-03-08 17:23:10 --> Severity: Notice --> Undefined variable: category /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 40
ERROR - 2021-03-08 17:23:10 --> Severity: Notice --> Undefined variable: all /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 101
ERROR - 2021-03-08 17:23:10 --> Severity: Warning --> Invalid argument supplied for foreach() /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_author.php 101
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined offset: 1 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined offset: 2 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined offset: 3 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined offset: 4 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined offset: 5 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:35:48 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined offset: 1 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined offset: 2 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined offset: 3 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined offset: 4 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined offset: 5 /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 349
ERROR - 2021-03-08 17:36:01 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 350
ERROR - 2021-03-08 17:43:03 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 357
ERROR - 2021-03-08 17:43:03 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 358
ERROR - 2021-03-08 17:43:03 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 357
ERROR - 2021-03-08 17:43:03 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 358
ERROR - 2021-03-08 17:45:17 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 357
ERROR - 2021-03-08 17:45:17 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 358
ERROR - 2021-03-08 17:45:17 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 357
ERROR - 2021-03-08 17:45:17 --> Severity: Notice --> Undefined index: description /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 358
ERROR - 2021-03-08 17:50:20 --> Severity: Notice --> Undefined index: season_details /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Premium_video_model.php 354
ERROR - 2021-03-08 18:03:55 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'From premium_season as ps
                        where ps.status =0 and FIND_IN' at line 4 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.season_thumbnail,ps.short_video,ps.promo_video,ps.yt_promo_video,(SELECT COUNT(pe.id) 
              FROM premium_episodes as pe 
             WHERE pe.season_id =     pe.id) as total_episodes,
                        From premium_season as ps
                        where ps.status =0 and FIND_IN_SET(1,ps.author_id) and ps.published_date <= '1615206835201' order by ps.position asc
ERROR - 2021-03-08 18:04:40 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'From premium_season as ps
                        where ps.status =0 and FIND_IN' at line 3 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.season_thumbnail,ps.short_video,ps.promo_video,ps.yt_promo_video,(SELECT COUNT(pe.id) 
              FROM premium_episodes as pe) as total_episodes,
                        From premium_season as ps
                        where ps.status =0 and FIND_IN_SET(1,ps.author_id) and ps.published_date <= '1615206880062' order by ps.position asc
ERROR - 2021-03-08 18:05:43 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'From premium_season as ps
                        where ps.status =0 and FIND_IN' at line 3 - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.season_thumbnail,ps.short_video,ps.promo_video,ps.yt_promo_video,(SELECT COUNT(premium_episodes.id) 
              FROM premium_episodes) as total_episodes,
                        From premium_season as ps
                        where ps.status =0 and FIND_IN_SET(1,ps.author_id) and ps.published_date <= '1615206943622' order by ps.position asc
ERROR - 2021-03-08 18:13:56 --> Query error: Table 'appsansk_staging.premium_season1' doesn't exist - Invalid query: SELECT ps.id,ps.season_title,ps.description,ps.season_thumbnail,ps.short_video,ps.promo_video,ps.yt_promo_video,(SELECT COUNT(pe.id) 
              FROM premium_episodes as pe where pe.season_id=ps.id) as total_episodes
                        From premium_season1 as ps
                        where ps.status =0 and FIND_IN_SET(1,ps.author_id) and ps.published_date <= '1615207436782' order by ps.position asc
ERROR - 2021-03-08 18:19:17 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-08 18:19:17 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-08 18:19:17 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-08 18:19:17 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-08 18:19:17 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('164',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-08 18:46:42 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-08 18:46:42 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-08 18:46:42 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-08 18:46:42 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-08 18:46:42 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('148',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
