<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2021-03-11 10:11:12 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:24:55 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:25:00 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:25:03 --> Query error: Table 'appsansk_staging.users1' doesn't exist - Invalid query: SELECT users.id,username,email,country_code,mobile,DATE_FORMAT(FROM_UNIXTIME(creation_time/1000), '%d-%m-%Y %h:%i:%s') as creation_time,status,wtsp_sms_send,country.name as c_name FROM  users1 LEFT JOIN country ON users.country_code = country.phonecode  where users.status != 2 
ERROR - 2021-03-11 10:28:56 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:41:48 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:42:30 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:42:31 --> Query error: Table 'appsansk_staging.users1' doesn't exist - Invalid query: SELECT users.id,username,email,country_code,mobile,DATE_FORMAT(FROM_UNIXTIME(creation_time/1000), '%d-%m-%Y %h:%i:%s') as creation_time,status,wtsp_sms_send,country.name as c_name FROM  users1 LEFT JOIN country ON users.country_code = country.phonecode  where users.status != 2 
ERROR - 2021-03-11 10:53:32 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:53:32 --> 404 Page Not Found: /index
ERROR - 2021-03-11 10:53:33 --> Query error: Table 'appsansk_staging.users1' doesn't exist - Invalid query: SELECT count(id) as total
									FROM users1 where status != 2 
									
									
ERROR - 2021-03-11 10:54:34 --> 404 Page Not Found: /index
ERROR - 2021-03-11 11:00:02 --> Severity: Notice --> Undefined index: device_tokken /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/web_user/user_profile.php 77
ERROR - 2021-03-11 11:00:19 --> Severity: Notice --> Undefined index: device_tokken /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/web_user/user_profile.php 77
ERROR - 2021-03-11 11:00:19 --> 404 Page Not Found: /index
ERROR - 2021-03-11 11:01:18 --> Severity: Notice --> Undefined index: device_tokken /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/web_user/user_profile.php 77
ERROR - 2021-03-11 12:54:08 --> Severity: Notice --> Undefined index: currency /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 164
ERROR - 2021-03-11 13:20:42 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 123
ERROR - 2021-03-11 13:20:42 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 126
ERROR - 2021-03-11 13:20:42 --> Query error: Table 'appsansk_staging.course_coupon_master' doesn't exist - Invalid query: SELECT ccm.id , ccm.coupon_type , ccm.coupon_value
                        FROM `course_coupon_master` as ccm
                        join coupon_course_relation_master ccrm on ccrm.course_id = Array and ccrm.coupon_id = ccm.id
                        WHERE ccm.id='2'
                        and (SELECT id FROM premium_transaction_record
                        WHERE user_id = 13256 and plan_id =  Array and coupon_applied = ccm.id and transaction_status=1 limit 0,1 ) is NULL 
ERROR - 2021-03-11 13:23:00 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 123
ERROR - 2021-03-11 13:23:00 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 126
ERROR - 2021-03-11 13:23:00 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT ccm.id , ccm.coupon_type , ccm.coupon_value
                        FROM `premium_coupon_master` as ccm
                        join coupon_course_relation_master ccrm on ccrm.course_id = Array and ccrm.coupon_id = ccm.id
                        WHERE ccm.id='1'
                        and (SELECT id FROM premium_transaction_record
                        WHERE user_id = 13256 and plan_id =  Array and coupon_applied = ccm.id and transaction_status=1 limit 0,1 ) is NULL 
ERROR - 2021-03-11 13:24:25 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 123
ERROR - 2021-03-11 13:24:25 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 126
ERROR - 2021-03-11 13:24:25 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT ccm.id , ccm.coupon_type , ccm.coupon_value
                        FROM `premium_coupon_master` as ccm
                        join coupon_course_relation_master ccrm on ccrm.course_id = Array and ccrm.coupon_id = ccm.id
                        WHERE ccm.id='1'
                        and (SELECT id FROM premium_transaction_record
                        WHERE user_id = 13256 and plan_id =  Array and coupon_applied = ccm.id and transaction_status=1 limit 0,1 ) is NULL 
ERROR - 2021-03-11 13:25:00 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 123
ERROR - 2021-03-11 13:25:00 --> Severity: Notice --> Array to string conversion /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 126
ERROR - 2021-03-11 13:25:00 --> Query error: Unknown column 'Array' in 'where clause' - Invalid query: SELECT ccm.id , ccm.coupon_type , ccm.coupon_value
                        FROM `premium_coupon_master` as ccm
                        join coupon_course_relation_master ccrm on ccrm.course_id = Array and ccrm.coupon_id = ccm.id
                        WHERE ccm.id='1'
                        and (SELECT id FROM premium_transaction_record
                        WHERE user_id = 13256 and plan_id =  Array and coupon_applied = ccm.id and transaction_status=1 limit 0,1 ) is NULL 
ERROR - 2021-03-11 13:25:57 --> Query error: Unknown column 'ccrm.course_id' in 'on clause' - Invalid query: SELECT ccm.id , ccm.coupon_type , ccm.coupon_value
                        FROM `premium_coupon_master` as ccm
                        join coupon_course_relation_master ccrm on ccrm.course_id = 2 and ccrm.coupon_id = ccm.id
                        WHERE ccm.id='1'
                        and (SELECT id FROM premium_transaction_record
                        WHERE user_id = 13256 and plan_id =  2 and coupon_applied = ccm.id and transaction_status=1 limit 0,1 ) is NULL 
ERROR - 2021-03-11 14:21:40 --> Severity: Notice --> Undefined variable: display_validity /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_plan.php 72
ERROR - 2021-03-11 14:22:04 --> Severity: Notice --> Undefined variable: display_validity /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_plan.php 72
ERROR - 2021-03-11 14:23:15 --> Severity: Notice --> Undefined variable: display_validity /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/premium_videos/add_plan.php 72
ERROR - 2021-03-11 15:11:21 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-11 15:11:21 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-11 15:11:21 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-11 15:11:21 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-11 15:11:21 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('209',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-11 15:11:33 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-11 15:11:33 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-11 15:11:33 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-11 15:11:33 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-11 15:11:33 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('209',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-11 15:11:59 --> Severity: Notice --> Undefined index: page_no /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-11 15:11:59 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 288
ERROR - 2021-03-11 15:11:59 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 289
ERROR - 2021-03-11 15:11:59 --> Severity: Notice --> Undefined index: limit /home/appsansk/public_html/sanskar_development/application/modules/data_model/models/Bhajan_model.php 290
ERROR - 2021-03-11 15:11:59 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near '' at line 5 - Invalid query: SELECT * from bhajan where
   								  FIND_IN_SET('175',related_guru)
   								  and status=0
   								  order by id desc
   								  limit 0,
ERROR - 2021-03-11 15:37:55 --> Severity: error --> Exception: Too few arguments to function Transaction::fetch_payment_details(), 0 passed in /home/appsansk/public_html/sanskar_development/system/core/CodeIgniter.php on line 532 and exactly 1 expected /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 241
ERROR - 2021-03-11 15:38:12 --> Severity: Notice --> Undefined variable: document /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 309
ERROR - 2021-03-11 16:30:35 --> Severity: Notice --> Undefined index: course_image /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/transaction/course_transactions_details.php 93
ERROR - 2021-03-11 16:30:35 --> Severity: Notice --> Undefined index: user_profile_picture /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/transaction/course_transactions_details.php 166
ERROR - 2021-03-11 17:10:13 --> Severity: Notice --> Undefined index: device_tokken /home/appsansk/public_html/sanskar_development/application/modules/auth_panel/views/web_user/user_profile.php 77
ERROR - 2021-03-11 17:38:52 --> Severity: error --> Exception: Call to undefined function create_log_file() /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 143
ERROR - 2021-03-11 17:54:43 --> Query error: Table 'appsansk_staging.premium_transaction_record1' doesn't exist - Invalid query: SELECT MAX(DISTINCT(invoice_no)) as invoice_no
FROM `premium_transaction_record1`
ERROR - 2021-03-11 18:02:19 --> Severity: Notice --> Undefined index: plan_id /home/appsansk/public_html/sanskar_development/application/modules/data_model/controllers/Transaction.php 141
