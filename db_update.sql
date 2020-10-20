ALTER TABLE `tbl_site_setting`
    ADD `ts_whats_app_number` VARCHAR(15) NOT NULL AFTER `ts_phone`;

UPDATE `tbl_site_setting`
SET `ts_whats_app_number` = '+91 9321598572'
WHERE `tbl_site_setting`.`ts_id` = 2;

UPDATE `tbl_site_setting`
SET `ts_phone` = '+91 9167672264'
WHERE `tbl_site_setting`.`ts_id` = 2;

/*--Login And Register--*/
ALTER TABLE `tbl_customer`
    ADD `tc_whats_app_number` VARCHAR(15) NOT NULL AFTER `tc_mobile`;

ALTER TABLE `tbl_customer_address`
    ADD `tca_landmark` VARCHAR(50) NOT NULL AFTER `tca_street_address1`;

/*--tbl_category--*/

ALTER TABLE `tbl_category`
    ADD `cat_HSNCode`       VARCHAR(20) NOT NULL AFTER `cat_desc`,
    ADD `cat_GSTPercentage` INT(3)      NOT NULL DEFAULT '0' AFTER `cat_HSNCode`;

/*---tbl_product data--*/

ALTER TABLE `tbl_product_data`
    CHANGE `tpd_size_master_id` `tpd_weight` FLOAT(11, 2) NOT NULL;

ALTER TABLE `tbl_product_data`
    ADD `tpd_qty` INT NOT NULL COMMENT 'color and weight wise producvt quanity' AFTER `tpd_weight`;

ALTER TABLE `tbl_product_data`
    CHANGE `tpd_weight` `tpd_weight` FLOAT(11, 3) NOT NULL;

ALTER TABLE `tbl_product`
    ADD `tp_ImportantNoticeBox` VARCHAR(1000) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' AFTER `tp_long_desc`;

ALTER TABLE `tbl_product`
    DROP `tp_size_category`;

ALTER TABLE `tbl_product_data`
    DROP `tpd_size_category_id`;

ALTER TABLE `tbl_product`
    DROP `tp_price`,
    DROP `tp_gst_amount`;

ALTER TABLE `tbl_product`
    CHANGE `tp_gst_type` `tp_gst_type` INT(11) NULL DEFAULT NULL COMMENT '1=excluding,2=including';

ALTER TABLE `tbl_product`
    CHANGE `tp_attraction` `tp_attraction` INT(11) NULL DEFAULT NULL COMMENT '1=new,2=premium,3=trade';


ALTER TABLE `tbl_order_item`
    CHANGE `oi_size_category` `oi_size_category` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
    CHANGE `oi_size` `oi_size`                   VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
    CHANGE `oi_size_id` `oi_size_id`             INT(11)                                                     NULL DEFAULT NULL,
    CHANGE `oi_tmp_size_id` `oi_tmp_size_id`     INT(11)                                                     NULL DEFAULT NULL;