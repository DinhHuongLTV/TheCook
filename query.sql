-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2022 at 01:08 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `TheCook_db`
--

-- --------------------------------------------------------
Create database if not exists TheCook_db;

use TheCook_db;

CREATE TABLE IF NOT EXISTS news_categories (
    id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'Tên danh mục',
    description TEXT DEFAULT NULL COMMENT 'Mô tả danh mục',
    status tinyint(1) default 0 comment 'Trạng thái: 0 - inactive, 1 - active',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP () COMMENT 'Ngày tạo danh mục',
    updated_at DATETIME DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
    primary key (id)
);

-- hạng mục đầu bếp: âu, á, bàn tiệc,... 
create table if not exists chef_categories (
	id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'Tên danh mục',
    description TEXT DEFAULT NULL COMMENT 'Mô tả danh mục',
    status tinyint(1) default 0 comment 'Trạng thái: 0 - inactive, 1 - active',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP () COMMENT 'Ngày tạo danh mục',
    updated_at DATETIME DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
    primary key (id)
);




-- các loại người dùng: 1 - admin, 2 - đầu bếp, 3 - người dùng thông thường
create table if not exists user_categories (
	id INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL COMMENT 'Tên danh mục',
    discription TEXT DEFAULT NULL COMMENT 'Mô tả danh mục',
    status tinyint default 0 comment 'Trạng thái: 0 - inactive, 1 - active',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP () COMMENT 'Ngày tạo danh mục',
    updated_at DATETIME DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
    primary key (id)
);

-- update user_categories set status = 1;

-- insert into user_categories (id, name) values 
-- (1, 'admin'),
-- (2, 'chef'),
-- (3, 'general_user');

create table if not exists news (
	id	int(11) not null auto_increment,
    category_id int(11) default null comment 'id danh mục của tin tức, là khóa ngoại liên kết với bảng news_categories',
	name varchar(255) not null comment 'Tiêu đề tin tức',
	summary varchar(255) DEFAULT NULL COMMENT 'Mô tả ngắn cho tin tức',
	avatar varchar(255) DEFAULT NULL COMMENT 'Tên file ảnh tin tức',
	content text DEFAULT NULL COMMENT 'Mô tả chi tiết cho sản phẩm',
	status tinyint(3) DEFAULT 0 COMMENT 'Trạng thái danh mục: 0 - Inactive, 1 - Active',
	seo_title varchar(255) DEFAULT NULL COMMENT 'Từ khóa seo cho title',
	seo_description varchar(255) DEFAULT NULL COMMENT 'Từ khóa seo cho phần mô tả',
	seo_keywords varchar(255) DEFAULT NULL COMMENT 'Các từ khóa seo',
	created_at timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
	updated_at datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
    primary key (id),
    foreign key (category_id) references news_categories(id)
);

	
create table if not exists `users` (
	id int(11) not null auto_increment,
    category_id int(11) default null comment 'hạng mục người dùng - liên kết với bảng user_categories',
    username varchar(255) default null comment 'Tên đăng nhập',
    `password` varchar(255) default null comment 'Mật khẩu',
    first_name varchar(255) default null comment 'Tên',
    last_name varchar(255) default null comment 'Họ',
    phone varchar(255) default null comment 'SĐT',
    address varchar(255) default null comment 'Địa chỉ',
    email varchar(255) default null comment 'Email',
    avatar varchar(255) default null comment 'Tên file ảnh đại diện',
    jobs varchar(255) DEFAULT NULL COMMENT 'Nghề nghiệp',
	last_login datetime DEFAULT NULL COMMENT 'Lần đăng nhập gần đây nhất',
	facebook varchar(255) DEFAULT NULL COMMENT 'Link facebook',
	`status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái kích hoạt: 0 - Inactive, 1 - Active',
	created_at timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
	updated_at datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
	primary key (id),
    foreign key (category_id) references user_categories(id)
);

create table if not exists `chefs` (
	id int(11) not null auto_increment,
    user_category_id int(11) default null comment 'hạng mục người dùng - liên kết với bảng user_categories',
    category_id int(11) default null comment 'Hạng mục đầu bếp - liên kết với bảng chef_categories',
    username varchar(255) default null comment 'Tên đăng nhập',
    `password` varchar(255) default null comment 'Mật khẩu',
    first_name varchar(255) default null comment 'Tên',
    summary text default null comment 'Mô tả sơ lược',
    `description` text default null comment 'Mô tả chi tiết',
    nationality varchar(255) default null comment 'Quốc tịch',
    last_name varchar(255) default null comment 'Họ',
    phone varchar(255) default null comment 'SĐT',
    address varchar(255) default null comment 'Địa chỉ',
    email varchar(255) default null comment 'Email',
    avatar varchar(255) default null comment 'Tên file ảnh đại diện',
    jobs varchar(255) DEFAULT NULL COMMENT 'Nghề nghiệp',
	last_login datetime DEFAULT NULL COMMENT 'Lần đăng nhập gần đây nhất',
	facebook varchar(255) DEFAULT NULL COMMENT 'Link facebook',
	`status` tinyint(3) DEFAULT 0 COMMENT 'Trạng thái kích hoạt: 0 - Inactive, 1 - Active',
	created_at timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
	updated_at datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
	primary key (id),
    foreign key (user_category_id) references user_categories(id),
    foreign key (category_id) references chef_categories(id)
);

-- alter table chefs add column price int(9) default null comment 'Giá làm việc một giờ';

create table if not exists `admin` (
	id int(11) not null auto_increment,
    category_id tinyint(1) default null comment 'Hạng mục người dùng',
    username varchar(255) default null comment 'Tên tài khoản',
    password varchar(255) default null comment 'Mật khẩu',
    created_at timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
	updated_at datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
    primary key (id),
    foreign key (category_id) references user_categories(id)
);

create table if not exists `orders` (
	id int(11) not null auto_increment,
    user_id int(11) default null comment 'Id khách hàng đặt hàng',
    fullname varchar(255) default null comment 'Tên khách hàng đặt hàng',
    address varchar(255) default null,
    phone varchar(255) default null,
    email varchar(255) default null,
    note text(255) default null,
    booking_date datetime default null,
	booking_hour datetime default null,
    price_total int(11) default null,
    payment_status tinyint(1) default 0 comment '0 - chưa thanh toán, 1 - đã thanh toán',
    created_at timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Ngày tạo',
	updated_at datetime DEFAULT NULL COMMENT 'Ngày cập nhật cuối',
    primary key (id)
);


create table if not exists `order_detail` (
	order_id int(11) default null,
    user_id int(11) default null,
    foreign key (user_id) references users(id),
    foreign key (order_id) references orders(id)
    );
    

















