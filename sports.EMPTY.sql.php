-- phpMyAdmin SQL Dump
-- version 2.11.3deb1ubuntu1.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2010 年 09 月 30 日 19:19
-- 服务器版本: 5.0.51
-- PHP 版本: 5.2.4-2ubuntu5.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- 数据库: `sports`
--

-- --------------------------------------------------------

--
-- 表的结构 `2010_event`
--

CREATE TABLE IF NOT EXISTS `2010_event` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `2010_grade`
--

CREATE TABLE IF NOT EXISTS `2010_grade` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(200) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `2010_match`
--

CREATE TABLE IF NOT EXISTS `2010_match` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `grade_id` smallint(5) unsigned NOT NULL,
  `event_id` smallint(5) unsigned zerofill NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `2010_score`
--

CREATE TABLE IF NOT EXISTS `2010_score` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `match_id` smallint(5) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `class` smallint(5) unsigned NOT NULL,
  `rank` smallint(5) unsigned NOT NULL,
  `score` varchar(250) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
