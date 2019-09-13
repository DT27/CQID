-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3306
-- 生成日期: 2019 年 09 月 13 日 21:21
-- 服务器版本: 5.6.38
-- PHP 版本: 5.6.32

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `cqid`
--

-- --------------------------------------------------------

--
-- 表的结构 `oauth_access_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL COMMENT 'System generated access token',
  `client_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_CLIENTS.CLIENT_ID',
  `user_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_USERS.USER_ID',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the token becomes invalid',
  `scope` varchar(4000) DEFAULT NULL COMMENT 'Space-delimited list of scopes token can access',
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_authorization_codes`
--

CREATE TABLE IF NOT EXISTS `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL COMMENT 'System generated authorization code',
  `client_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_CLIENTS.CLIENT_ID',
  `user_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_USERS.USER_ID',
  `redirect_uri` varchar(2000) NOT NULL COMMENT 'URI to redirect user after authorization',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the code becomes invalid',
  `scope` varchar(4000) DEFAULT NULL COMMENT 'Space-delimited list scopes code can request',
  `id_token` varchar(1000) DEFAULT NULL COMMENT 'JSON web token used for OpenID Connect',
  PRIMARY KEY (`authorization_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_clients`
--

CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `client_id` varchar(80) NOT NULL COMMENT 'A unique client identifier',
  `client_secret` varchar(80) DEFAULT NULL COMMENT 'Used to secure Client Credentials Grant',
  `redirect_uri` varchar(2000) DEFAULT NULL COMMENT 'Redirect URI used for Authorization Grant',
  `grant_types` varchar(80) DEFAULT NULL COMMENT 'Space-delimited list of permitted grant types',
  `scope` varchar(4000) DEFAULT NULL COMMENT 'Space-delimited list of permitted scopes',
  `user_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_USERS.USER_ID',
  PRIMARY KEY (`client_id`),
  UNIQUE KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_jti`
--

CREATE TABLE IF NOT EXISTS `oauth_jti` (
  `issuer` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `audience` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `jti` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_jwt`
--

CREATE TABLE IF NOT EXISTS `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_public_keys`
--

CREATE TABLE IF NOT EXISTS `oauth_public_keys` (
  `client_id` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) DEFAULT NULL,
  `private_key` varchar(2000) DEFAULT NULL,
  `encryption_algorithm` varchar(100) DEFAULT 'RS256'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_refresh_tokens`
--

CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL COMMENT 'System generated refresh token',
  `client_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_CLIENTS.CLIENT_ID',
  `user_id` varchar(80) DEFAULT NULL COMMENT 'OAUTH_USERS.USER_ID',
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'When the token becomes invalid',
  `scope` varchar(4000) DEFAULT NULL COMMENT 'Space-delimited list scopes token can access',
  PRIMARY KEY (`refresh_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_scopes`
--

CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope` varchar(80) NOT NULL COMMENT 'Name of scope, without spaces',
  `is_default` tinyint(1) DEFAULT NULL COMMENT 'True to grant scope',
  PRIMARY KEY (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oauth_users`
--

CREATE TABLE IF NOT EXISTS `oauth_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(80) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `first_name` varchar(80) DEFAULT NULL,
  `last_name` varchar(80) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified` tinyint(1) DEFAULT NULL,
  `scope` varchar(80) DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
