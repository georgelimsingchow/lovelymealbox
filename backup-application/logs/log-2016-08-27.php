<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-08-27 00:27:59 --> Query error: Unknown column 'menu_last_date' in 'where clause' - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND DATE(menu_last_date) > DATE('2016-08-27 00:27:59')
ERROR - 2016-08-27 00:28:27 --> Query error: Unknown column 'expire_dat' in 'where clause' - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND DATE(expire_dat) > DATE('2016-08-27 00:28:27')
ERROR - 2016-08-27 00:32:20 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '00:32:20)' at line 4 - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND `expire_date` > DATE(2016-08-27 00:32:20)
ERROR - 2016-08-27 00:32:22 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '00:32:22)' at line 4 - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND `expire_date` > DATE(2016-08-27 00:32:22)
ERROR - 2016-08-27 00:38:04 --> Query error: Table 'food_2_user.daily_men' doesn't exist - Invalid query: SELECT *
FROM `daily_men`
WHERE `slug` = '2016-08-29'
AND DATE('expire_dat') > DATE('2016-08-27 00:38:04')
 LIMIT 1
ERROR - 2016-08-27 00:38:24 --> Query error: Table 'food_2_user.daily_men' doesn't exist - Invalid query: SELECT *
FROM `daily_men`
WHERE `slug` = '2016-08-29'
AND DATE(`expire_date`) > DATE('2016-08-27 00:38:24')
 LIMIT 1
ERROR - 2016-08-27 00:40:32 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`00:40:32`
 LIMIT 1' at line 4 - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND DATE(expire_date) > `2016-08-27` `00:40:32`
 LIMIT 1
ERROR - 2016-08-27 00:40:34 --> Query error: You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near '`00:40:34`
 LIMIT 1' at line 4 - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND DATE(expire_date) > `2016-08-27` `00:40:34`
 LIMIT 1
ERROR - 2016-08-27 00:43:11 --> Query error: Unknown column 'expire_dat' in 'where clause' - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND `expire_dat` > DATE('2016-08-28 00:00:00')
 LIMIT 1
ERROR - 2016-08-27 00:43:29 --> Query error: Unknown column 'expire_dat' in 'where clause' - Invalid query: SELECT *
FROM `daily_menu`
WHERE `slug` = '2016-08-29'
AND `expire_dat` > DATE('2016-08-27 00:00:00')
 LIMIT 1
ERROR - 2016-08-27 00:45:56 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) C:\wamp\www\food_2_user\application\modules\home\controllers\home.php 60
ERROR - 2016-08-27 00:46:44 --> Query error: Table 'food_2_user.daily_men' doesn't exist - Invalid query: SELECT *
FROM `daily_men`
WHERE `slug` = '2016-08-29'
AND DATE(expire_date) > DATE('2016-08-28 00:00:00')
 LIMIT 1
ERROR - 2016-08-27 00:47:11 --> Query error: Table 'food_2_user.daily_men' doesn't exist - Invalid query: SELECT *
FROM `daily_men`
WHERE `slug` = '2016-08-29'
AND DATE(expire_date) > DATE('2016-08-27 00:00:00')
 LIMIT 1
ERROR - 2016-08-27 00:54:31 --> Query error: Unknown column 'menu_last_date' in 'where clause' - Invalid query: SELECT *
FROM `daily_menu`
WHERE `status` = '1'
AND `slug` = '2016-08-28'
AND DATE(menu_last_date) > DATE('2016-08-27 00:54:31')
ERROR - 2016-08-27 01:10:53 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:10:53 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:12:33 --> Severity: Notice --> Undefined variable: cart_total C:\wamp\www\food_2_user\application\modules\order\views\order_date_page.php 89
ERROR - 2016-08-27 01:12:34 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:12:34 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:13:02 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:13:02 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:21:35 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:21:35 --> 404 Page Not Found: /index
ERROR - 2016-08-27 01:32:48 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 01:32:48 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 01:32:48 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 01:40:13 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: SELECT `that_day_date`, SUM(quantity) as total_boxes
FROM `food_cart_detai`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
AND `expire_date` > DATE('2016-08-27 01:40:13')
GROUP BY `that_day_date`
ERROR - 2016-08-27 01:40:46 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: SELECT `that_day_date`, SUM(quantity) as total_boxes
FROM `food_cart_detai`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
GROUP BY `that_day_date`
ERROR - 2016-08-27 01:42:15 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: SELECT `that_day_date`, SUM(quantity) as total_boxes
FROM `food_cart_detai`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
GROUP BY `that_day_date`
ERROR - 2016-08-27 01:43:09 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: SELECT `that_day_date`, SUM(quantity) as total_boxes
FROM `food_cart_detai`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
AND `expire_date` > DATE('2016-08-27 01:43:09')
GROUP BY `that_day_date`
ERROR - 2016-08-27 02:02:31 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: SELECT `that_day_date`, SUM(quantity) as total_boxes
FROM `food_cart_detai`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
AND `expire_date` > DATE('2016-08-27 02:02:31')
GROUP BY `that_day_date`
ERROR - 2016-08-27 02:46:01 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 02:46:01 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 02:46:01 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 02:49:49 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:49:49 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:49:52 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:49:52 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:13 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:13 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:24 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:24 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:24 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:24 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:25 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:25 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:25 --> 404 Page Not Found: /index
ERROR - 2016-08-27 02:52:25 --> 404 Page Not Found: /index
ERROR - 2016-08-27 12:42:01 --> Severity: Notice --> Undefined variable: total C:\wamp\www\food_2_user\application\helpers\functions_helper.php 154
ERROR - 2016-08-27 12:42:57 --> Query error: Unknown column 'that_day_dat' in 'field list' - Invalid query: SELECT `that_day_dat`, SUM(quantity) as total_boxes
FROM `food_cart_detail`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
AND `expire_date` > DATE('2016-08-27 12:42:57')
GROUP BY `that_day_date`
ERROR - 2016-08-27 12:44:12 --> Query error: Unknown column 'that_day_dat' in 'field list' - Invalid query: SELECT `that_day_dat`, SUM(quantity) as total_boxes
FROM `food_cart_detail`
WHERE `status` = 'in_cart'
AND `user_id` = '5'
AND `expire_date` > DATE('2016-08-27 12:44:12')
GROUP BY `that_day_date`
ERROR - 2016-08-27 12:47:04 --> Severity: Notice --> Undefined variable: total C:\wamp\www\food_2_user\application\helpers\functions_helper.php 189
ERROR - 2016-08-27 12:48:25 --> Severity: Notice --> Undefined variable: data C:\wamp\www\food_2_user\application\helpers\functions_helper.php 184
ERROR - 2016-08-27 13:08:38 --> Severity: Warning --> mysqli::real_connect(): (HY000/1049): Unknown database 'food_2_user' C:\wamp\www\food_2_user\system\database\drivers\mysqli\mysqli_driver.php 202
ERROR - 2016-08-27 13:08:38 --> Unable to connect to the database
ERROR - 2016-08-27 13:25:33 --> 404 Page Not Found: /index
ERROR - 2016-08-27 13:25:33 --> 404 Page Not Found: /index
ERROR - 2016-08-27 13:25:37 --> 404 Page Not Found: /index
ERROR - 2016-08-27 13:25:37 --> 404 Page Not Found: /index
ERROR - 2016-08-27 13:27:33 --> 404 Page Not Found: /index
ERROR - 2016-08-27 13:27:33 --> 404 Page Not Found: /index
ERROR - 2016-08-27 05:45:53 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/application/helpers/functions_helper.php:187) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 05:45:53 --> Severity: Compile Error --> Can't use method return value in write context /home/caocao89/public_html/pamhoot/application/helpers/functions_helper.php 187
ERROR - 2016-08-27 05:50:11 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): Access denied for user 'root'@'localhost' (using password: NO) /home/caocao89/public_html/pamhoot/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2016-08-27 05:50:11 --> Unable to connect to the database
ERROR - 2016-08-27 05:50:11 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 05:51:54 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): Access denied for user 'mealbox'@'localhost' (using password: YES) /home/caocao89/public_html/pamhoot/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2016-08-27 05:51:54 --> Unable to connect to the database
ERROR - 2016-08-27 05:51:54 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 06:02:07 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): Access denied for user 'mealbox'@'localhost' (using password: YES) /home/caocao89/public_html/pamhoot/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2016-08-27 06:02:07 --> Unable to connect to the database
ERROR - 2016-08-27 06:02:07 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 06:03:18 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): Access denied for user 'mealbox'@'localhost' (using password: YES) /home/caocao89/public_html/pamhoot/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2016-08-27 06:03:18 --> Unable to connect to the database
ERROR - 2016-08-27 06:03:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 06:03:20 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): Access denied for user 'mealbox'@'localhost' (using password: YES) /home/caocao89/public_html/pamhoot/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2016-08-27 06:03:20 --> Unable to connect to the database
ERROR - 2016-08-27 06:03:20 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 06:04:18 --> Severity: Warning --> mysqli::real_connect(): (28000/1045): Access denied for user 'mealbox'@'localhost' (using password: YES) /home/caocao89/public_html/pamhoot/system/database/drivers/mysqli/mysqli_driver.php 202
ERROR - 2016-08-27 06:04:18 --> Unable to connect to the database
ERROR - 2016-08-27 06:04:18 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 06:08:04 --> 404 Page Not Found: ../modules/home/controllers//index
ERROR - 2016-08-27 06:08:20 --> 404 Page Not Found: ../modules/home/controllers//index
ERROR - 2016-08-27 06:09:13 --> 404 Page Not Found: ../modules/home/controllers//index
ERROR - 2016-08-27 06:09:14 --> 404 Page Not Found: ../modules/home/controllers//index
ERROR - 2016-08-27 06:09:15 --> 404 Page Not Found: ../modules/home/controllers//index
ERROR - 2016-08-27 06:10:07 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:10:13 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:13:31 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:18:21 --> Severity: error --> Exception: Unable to locate the model you have specified: Mdl_usermodel /home/caocao89/public_html/pamhoot/system/core/Loader.php 344
ERROR - 2016-08-27 06:18:21 --> Severity: error --> Exception: Unable to locate the model you have specified: Mdl_usermodel /home/caocao89/public_html/pamhoot/system/core/Loader.php 344
ERROR - 2016-08-27 06:19:45 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/application/modules/home/controllers/Home.php:24) /home/caocao89/public_html/pamhoot/system/core/Common.php 568
ERROR - 2016-08-27 06:19:45 --> Severity: Error --> Call to a member function public_bootstrap() on a non-object /home/caocao89/public_html/pamhoot/application/modules/home/controllers/Home.php 24
ERROR - 2016-08-27 06:20:33 --> 404 Page Not Found: ../modules/order/controllers//index
ERROR - 2016-08-27 06:21:02 --> 404 Page Not Found: ../modules/order/controllers//index
ERROR - 2016-08-27 06:21:29 --> 404 Page Not Found: ../modules/login/controllers//index
ERROR - 2016-08-27 06:21:34 --> 404 Page Not Found: ../modules/register/controllers//index
ERROR - 2016-08-27 06:22:37 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:22:46 --> 404 Page Not Found: ../modules/login/controllers//index
ERROR - 2016-08-27 06:25:03 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:25:05 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:25:09 --> 404 Page Not Found: ../modules/Home/controllers//index
ERROR - 2016-08-27 06:25:26 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:25:28 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:25:29 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:25:31 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:26:00 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:26:38 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:29:21 --> 404 Page Not Found: ../modules/login/controllers//index
ERROR - 2016-08-27 06:35:02 --> 404 Page Not Found: ../modules/login/controllers/Login/callback
ERROR - 2016-08-27 06:41:55 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:41:57 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:42:48 --> Severity: error --> Exception: Unable to locate the model you have specified: Mdl_order /home/caocao89/public_html/pamhoot/system/core/Loader.php 344
ERROR - 2016-08-27 06:48:35 --> Severity: error --> Exception: Unable to locate the model you have specified: Mdl_order /home/caocao89/public_html/pamhoot/system/core/Loader.php 344
ERROR - 2016-08-27 06:48:36 --> Severity: error --> Exception: Unable to locate the model you have specified: Mdl_order /home/caocao89/public_html/pamhoot/system/core/Loader.php 344
ERROR - 2016-08-27 06:55:58 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:55:59 --> 404 Page Not Found: /index
ERROR - 2016-08-27 06:56:04 --> Severity: error --> Exception: Unable to locate the model you have specified: Mdl_admin /home/caocao89/public_html/pamhoot/system/core/Loader.php 344
ERROR - 2016-08-27 06:57:18 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 06:57:18 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 06:57:18 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:13:03 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:13:03 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:15:25 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:15:25 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:15:27 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:16:28 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:17:00 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:17:00 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:17:03 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:17:03 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:41:46 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:46 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:46 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:48 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:48 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:48 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:55 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:55 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:56 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:58 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:58 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:41:58 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:46:54 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:46:54 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:46:54 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:47:09 --> Query error: Unknown column 'menu_last_date' in 'order clause' - Invalid query: SELECT *
FROM `daily_menu`
ORDER BY `menu_last_date` DESC
ERROR - 2016-08-27 07:47:15 --> Query error: Unknown column 'menu_last_date' in 'order clause' - Invalid query: SELECT *
FROM `daily_menu`
ORDER BY `menu_last_date` DESC
ERROR - 2016-08-27 07:47:20 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:47:20 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:47:20 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:47:38 --> Query error: Unknown column 'menu_last_date' in 'order clause' - Invalid query: SELECT *
FROM `daily_menu`
ORDER BY `menu_last_date` DESC
ERROR - 2016-08-27 07:47:40 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:47:40 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:47:40 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:53:47 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:53:47 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:54:04 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:54:04 --> 404 Page Not Found: /index
ERROR - 2016-08-27 07:58:37 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:58:37 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:58:37 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:59:20 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:59:20 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 07:59:20 --> 404 Page Not Found: ../modules/superadmin/controllers/Superadmin/dist
ERROR - 2016-08-27 08:56:06 --> 404 Page Not Found: /index
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: firstname /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 82
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: lastname /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 83
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: address_1 /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 84
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: address_2 /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 85
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: city /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 86
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: postcode /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 87
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: state_id /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 88
ERROR - 2016-08-27 18:22:00 --> Severity: Notice --> Undefined index: mobile_no /home/caocao89/public_html/pamhoot/application/modules/checkout/controllers/Checkout.php 89
ERROR - 2016-08-27 18:22:00 --> Severity: Warning --> Cannot modify header information - headers already sent by (output started at /home/caocao89/public_html/pamhoot/system/core/Exceptions.php:272) /home/caocao89/public_html/pamhoot/system/helpers/url_helper.php 564
ERROR - 2016-08-27 18:39:57 --> Severity: Notice --> Undefined offset: 0 /home/caocao89/public_html/pamhoot/application/helpers/functions_helper.php 290
ERROR - 2016-08-27 19:19:11 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:19:11 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:21:54 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:21:54 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:22:38 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:22:38 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:23:32 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:23:32 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:29:41 --> 404 Page Not Found: /index
ERROR - 2016-08-27 19:29:41 --> 404 Page Not Found: /index
ERROR - 2016-08-27 22:47:50 --> 404 Page Not Found: /index
