<?php
/**
 * 数据库全局配置.
 * User: gukai@bilibili.com
 * Date: 17/2/22
 * Time: 下午12:59
 */
return [
    'reply' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_reply',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'player_show' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_player',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'oversea' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_oversea',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'resource' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_resource',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'default' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_manager',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
        'id_column_overrides' => [
            'sysconfig' => 'name',
        ],
    ],
    'archive' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_archive',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'elec' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_elec',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'operation' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_operation',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'bilibili' => [
        'connection_string' => 'mysql:host=172.16.0.5;dbname=bilibili',
        'username' => 'bilibili',
        'password' => '5Fq2M4FbPZK4fhtE',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
        'id_column_overrides' => [
            'dede_archives_return_reason' => 'aid',
            'dm_index' => 'dm_inid',
            'dm_indexdata' => 'dm_inid',
            'dede_archives_stat' => 'aid',
            'dede_archives_history' => 'hid',
            'dede_member_tj' => 'mid',
            'dede_addonarticle' => 'aid',
            'dede_special_content' => 'cid',
            'dede_special' => 'spid',
            'dede_tags_article' => 'tag_id',
            'dede_topic' => 'tp_id',
            'dede_topic_content' => 'tp_cid',
        ],
    ],
    'show' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_show',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'push' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_push',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'ads' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_ads',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'log' => [
        'connection_string' => 'mysql:host=172.16.0.5;dbname=log',
        'username' => 'bilibili',
        'password' => '5Fq2M4FbPZK4fhtE',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
    'tag' => [
        'connection_string' => 'mysql:host=172.16.0.148;dbname=bilibili_tag',
        'username' => 'test',
        'password' => 'test',
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
            PDO::ATTR_PERSISTENT => true,
        ),
    ],
];
