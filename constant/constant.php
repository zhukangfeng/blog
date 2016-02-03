<?php

/**
 * Timezone set
 */
date_default_timezone_set('Asia/Tokyo');

/**
 * database's info
 **/
define("DB_ADDRESS", "localhost");
define("DB_USERNAME", "admin");
define("DB_PASSWORD", "admin");
define("DB_NAME", "blog");

/**
 * TABALE post
 **/
define("DB_TABLE_POST", "post");
define("DB_POST_TITLE", "title");
define("DB_POST_ID", "post_id");
define("DB_POST_TIME", "entry_time");
define("DB_POST_MODIFY_TIME", "modify_time");
define("DB_POST_COMMENT_ID", "comment_id");
define("DB_POST_PLACE", "place");
define("DB_POST_USER_ID", "user_id");
define("DB_POST_POST", "post");

define("TEST", "test");

/**
 * TABLE comment
 **/
define("DB_TABLE_COMMENT", "comment");
define("DB_COMMENT_ID", "comment_id");
define("DB_COMMENT_POST_ID", "post_id");
define("DB_COMMENT_FATHER_COMMENT_ID", "father_comment_id");
define("DB_COMMENT_COMMENT", "comment");
define("DB_COMMENT_USER_ID", "user_id");
define("DB_COMMENT_TIME", "time");

/**
 * TABLE user
 **/
define("DB_TABLE_USER", "user");
define("DB_USER_ID", "user_id");
define("DB_USER_NAME", "user_name");
define("DB_USER_BIRTHDAY", "birthday");
define("DB_USER_REGISTER_TIME", "register_time");
define("DB_USER_LAST_LOGIN_TIME", "last_login_time");
define("DB_USER_MAIL", "mail");
define("DB_USER_PASSWORD", "password");

define("AUTHER", "auther");
define("GUEST", "guest");
define("CONSTANT_POST", "post");
define("FATHER_COMMENT_AUTHOR", "father_comment_author");
define("POST_AUTHOR", "post_auhtor");
define("PASSWORD_CONFIRM", "password_confirm");
define("COMMENT_AUTHOR", "comment_author");

