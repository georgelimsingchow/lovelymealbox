<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2016-08-23 17:32:29 --> Query error: Table 'food_2_user.orde' doesn't exist - Invalid query: INSERT INTO `orde` (`customer_id`, `order_no`, `firstname`, `lastname`, `email`, `phone`, `payment_firstname`, `payment_lastname`, `payment_address_1`, `payment_address_2`, `payment_city`, `payment_postcode`, `payment_state`, `payment_phone`, `comment`, `total`, `order_status`, `create_date`, `update_date`) VALUES (4, 'MB-INV-201608231732294', 'EvaExpress', 'BusExpress', 'eva.express@yahoo.com', '', 'christine', 'lau', '45 jalan kedandi hello', 'walao eh', 'kuching', '93450', '3', '0142058898', '', '165.00', 'processing', '2016-08-23 17:32:29', '2016-08-23 17:32:29')
ERROR - 2016-08-23 17:34:25 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: UPDATE `food_cart_detai` SET `status` = 'to_order'
WHERE `daily_menu_id` = '20'
ERROR - 2016-08-23 17:35:01 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: UPDATE `food_cart_detai` SET `status` = 'to_order'
WHERE `daily_menu_id` = '1'
ERROR - 2016-08-23 17:35:10 --> Query error: Table 'food_2_user.food_cart_detai' doesn't exist - Invalid query: UPDATE `food_cart_detai` SET `status` = 'to_order'
WHERE `id` = '1'
ERROR - 2016-08-23 17:35:59 --> Severity: Parsing Error --> syntax error, unexpected '}' C:\wamp\www\food_2_user\application\modules\checkout\controllers\checkout.php 121
ERROR - 2016-08-23 17:57:37 --> 404 Page Not Found: ../modules/account/controllers/Order/index
ERROR - 2016-08-23 17:57:53 --> 404 Page Not Found: ../modules/account/controllers/Order/index
ERROR - 2016-08-23 17:57:53 --> 404 Page Not Found: ../modules/account/controllers/Order/index
ERROR - 2016-08-23 17:57:53 --> 404 Page Not Found: ../modules/account/controllers/Order/index
ERROR - 2016-08-23 17:57:59 --> 404 Page Not Found: ../modules/account/controllers/Order/index
ERROR - 2016-08-23 17:58:29 --> Severity: Notice --> Undefined index: date_key C:\wamp\www\food_2_user\application\modules\account\controllers\order.php 35
ERROR - 2016-08-23 17:58:29 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT *
FROM `order`
WHERE `customer_id` = '4'
AND `status` = 'to_order'
ERROR - 2016-08-23 17:58:40 --> Query error: Unknown column 'status' in 'where clause' - Invalid query: SELECT *
FROM `order`
WHERE `customer_id` = '4'
AND `status` = 'to_order'
ERROR - 2016-08-23 18:24:25 --> Severity: Notice --> Undefined index: city C:\wamp\www\food_2_user\application\modules\account\views\order\order_show_page.php 26
ERROR - 2016-08-23 18:30:32 --> Severity: Notice --> Undefined index: status C:\wamp\www\food_2_user\application\modules\account\views\order\order_show_page.php 38
ERROR - 2016-08-23 18:42:02 --> 404 Page Not Found: ../modules/account/controllers/Order/processing
ERROR - 2016-08-23 18:42:05 --> 404 Page Not Found: ../modules/account/controllers/Order/paid
ERROR - 2016-08-23 18:42:30 --> 404 Page Not Found: ../modules/account/controllers/Order/paid
