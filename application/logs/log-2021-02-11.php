<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-02-11 10:09:51 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:21:13 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:21:56 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:25:19 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:27:04 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:28:33 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:47:12 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:47:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:53:57 --> 404 Page Not Found: /index
ERROR - 2021-02-11 10:54:53 --> 404 Page Not Found: /index
ERROR - 2021-02-11 11:03:31 --> 404 Page Not Found: /index
ERROR - 2021-02-11 11:05:23 --> 404 Page Not Found: /index
ERROR - 2021-02-11 11:05:30 --> 404 Page Not Found: /index
ERROR - 2021-02-11 11:28:44 --> 404 Page Not Found: ../modules/data_model/controllers//index
ERROR - 2021-02-11 11:37:16 --> Query error: Table 'appsansk_tbhakti.guru_images' doesn't exist - Invalid query: SELECT count(id) as total
				  FROM guru_images where status !=2
ERROR - 2021-02-11 11:37:47 --> Query error: Table 'appsansk_tbhakti.guru_images' doesn't exist - Invalid query: SELECT count(id) as total
				  FROM guru_images where status !=2
ERROR - 2021-02-11 11:38:03 --> Query error: Table 'appsansk_tbhakti.guru_images' doesn't exist - Invalid query: INSERT INTO `guru_images` (`guru_id`, `image`, `uploaded_by`, `creation_time`) VALUES ('11', 'https://bhaktiappproduction.s3.ap-south-1.amazonaws.com/guru_thumbnails/1600316min-1613023683guru_2.jpg', '1', 1613023683931)
ERROR - 2021-02-11 11:38:07 --> Query error: Table 'appsansk_tbhakti.guru_images' doesn't exist - Invalid query: SELECT count(id) as total
				  FROM guru_images where status !=2
ERROR - 2021-02-11 12:14:40 --> Severity: Notice --> Undefined property: CI::$video_model /home/appsansk/public_html/sanskar_development/application/third_party/MX/Controller.php 59
ERROR - 2021-02-11 12:14:40 --> Severity: error --> Exception: Call to a member function get_guru_thumbnails() on null /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/guru/Guru.php 112
ERROR - 2021-02-11 12:15:52 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT * from guru_images1 WHERE status=0  and guru_id =7 order by id desc limit 0,10
ERROR - 2021-02-11 12:19:35 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'gi.status =0  and guru_id =7 order by id desc limit 0,10' at line 1 - Invalid query: SELECT gi.id,gi.image,gi.status,guru.name FROM guru_images as giLEFT JOIN guru ON gi.guru_id = guru.idwhere gi.status =0  and guru_id =7 order by id desc limit 0,10
ERROR - 2021-02-11 12:20:44 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT gi.id,gi.image,gi.status,guru.name FROM guru_images1 as gi LEFT JOIN guru ON gi.guru_id = guru.id where gi.status =0  and guru_id =7 order by id desc limit 0,10
ERROR - 2021-02-11 12:21:24 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT gi.id,gi.image,gi.status,guru.name FROM guru_images1 as gi LEFT JOIN guru ON gi.guru_id = guru.id where gi.status =0  and guru_id =11 order by id desc limit 0,10
ERROR - 2021-02-11 12:41:22 --> Severity: Notice --> Undefined variable: offset /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Guru_model.php 163
ERROR - 2021-02-11 12:41:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '5' at line 1 - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit ,5
ERROR - 2021-02-11 12:41:37 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 0,5
ERROR - 2021-02-11 12:41:54 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 5,5
ERROR - 2021-02-11 12:42:16 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 10,10
ERROR - 2021-02-11 12:44:10 --> Severity: Notice --> Undefined variable: offset /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Guru_model.php 163
ERROR - 2021-02-11 12:44:10 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '10' at line 1 - Invalid query: SELECT image from guru_images WHERE status=0  and guru_id =11 order by id desc limit ,10
ERROR - 2021-02-11 12:44:47 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 0,10
ERROR - 2021-02-11 12:44:58 --> Severity: Notice --> Undefined variable: offset /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Guru_model.php 163
ERROR - 2021-02-11 12:44:58 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '10' at line 1 - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit ,10
ERROR - 2021-02-11 12:45:03 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 0,10
ERROR - 2021-02-11 12:45:57 --> Severity: Notice --> Undefined variable: offset /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Guru_model.php 163
ERROR - 2021-02-11 12:47:26 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 0,10
ERROR - 2021-02-11 12:47:32 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 0,10
ERROR - 2021-02-11 12:47:36 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 10,10
ERROR - 2021-02-11 12:50:03 --> Query error: Table 'appsansk_staging.guru_images1' doesn't exist - Invalid query: SELECT image from guru_images1 WHERE status=0  and guru_id =11 order by id desc limit 0,10
ERROR - 2021-02-11 13:04:35 --> 404 Page Not Found: /index
ERROR - 2021-02-11 13:06:47 --> 404 Page Not Found: ../modules/data_model/controllers//index
ERROR - 2021-02-11 13:06:53 --> 404 Page Not Found: ../modules/data_model/controllers//index
ERROR - 2021-02-11 13:08:18 --> 404 Page Not Found: /index
ERROR - 2021-02-11 13:12:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 13:13:13 --> 404 Page Not Found: /index
ERROR - 2021-02-11 13:24:46 --> 404 Page Not Found: /index
ERROR - 2021-02-11 15:32:57 --> Severity: Warning --> implode(): Invalid arguments passed /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/bhajan/Bhajan.php 298
ERROR - 2021-02-11 16:21:20 --> Query error: Unknown column 'bhajan.artist_id' in 'group statement' - Invalid query: select *,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_id limit 0,10
ERROR - 2021-02-11 16:32:00 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'DISTINCT artist.artist_image from bhajan join artist on artist.id=bhajan.artists' at line 1 - Invalid query: select *,0 as direct_play, DISTINCT artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_name limit 0,10
ERROR - 2021-02-11 16:34:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'distinct artist.id and  artist.status=0 group by bhajan.artist_name limit 0,40' at line 1 - Invalid query: select *,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.id NOT IN (125) and distinct artist.id and  artist.status=0 group by bhajan.artist_name limit 0,40
ERROR - 2021-02-11 16:41:06 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'on artists_id *,0 as direct_play,artist.artist_image from bhajan join artist on ' at line 1 - Invalid query: select distinct on artists_id *,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_name limit 0,10
ERROR - 2021-02-11 16:41:23 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'on artists_id . *,0 as direct_play,artist.artist_image from bhajan join artist o' at line 1 - Invalid query: select distinct on artists_id . *,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_name limit 0,10
ERROR - 2021-02-11 16:41:41 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan' at line 1 - Invalid query: select distinct artists_id *,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_name limit 0,10
ERROR - 2021-02-11 16:41:54 --> Query error: Unknown table 'appsansk_staging.artists_id' - Invalid query: select distinct artists_id.*,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_name limit 0,10
ERROR - 2021-02-11 16:42:19 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan' at line 1 - Invalid query: select distinct bhajan.artists_id *,0 as direct_play,artist.artist_image from bhajan join artist on artist.id=bhajan.artists_id where bhajan.status=0 and artist.status=0 group by bhajan.artist_name limit 0,10
ERROR - 2021-02-11 16:43:48 --> Severity: Warning --> implode(): Invalid arguments passed /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/controllers/bhajan/Bhajan.php 298
ERROR - 2021-02-11 16:50:37 --> Severity: Notice --> Undefined index: last_guru_id /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Guru_model.php 17
ERROR - 2021-02-11 18:09:53 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:09:55 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:11:59 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:25:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:25:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:25:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:25:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:25:15 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:39:10 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:39:10 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:39:10 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:39:11 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:39:11 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:57:14 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:57:14 --> 404 Page Not Found: /index
ERROR - 2021-02-11 18:59:39 --> 404 Page Not Found: /index
