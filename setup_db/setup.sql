DROP DATABASE IF EXISTS `quiz`;
CREATE DATABASE quiz;
USE quiz;

DROP TABLE IF EXISTS `questions`;
CREATE TABLE questions(
   `id`          INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,`content`     VARCHAR(255) NOT NULL
  ,`created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,`update_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS `choices`;
CREATE TABLE choices(
   `id`          INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,`content`     VARCHAR(255) NOT NULL
  ,`result_flg`  TINYINT(1)   DEFAULT NULL
  ,`questions_id`INT          NOT NULL
  ,`created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,`update_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS `answer_history`;
CREATE TABLE answer_histroy(
   `id`          INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,`users_id`    INT          NOT NULL
  ,`choices_id1` INT          NOT NULL
  ,`choices_id2` INT          NOT NULL
  ,`choices_id3` INT          NOT NULL
  ,`created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,`update_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS `users`;
CREATE TABLE users(
   `id`          INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,`email`       VARCHAR(255) NOT NULL
  ,`password`    VARCHAR(32)  NOT NULL
  ,`created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
  ,`update_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
DROP TABLE IF EXISTS `user_detail`;
CREATE TABLE user_detail(
   `id`           INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
   ,`name`        VARCHAR(24)  
   ,`address_id`  INT
   ,`birthday`    VARCHAR(10)
   ,`tel`         VARCHAR(13)
   ,`works_id`     INT
   ,`users_id`    INT          NOT NULL
   ,`created_at`  TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
   ,`update_at`   DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
DROP TABLE IF EXISTS `address`;
CREATE TABLE address(
  `id`           INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,`address`     VARCHAR(3)   NOT NULL
)
DROP TABLE IF EXISTS `works`;
CREATE TABLE works(
  `id`           INT          NOT NULL AUTO_INCREMENT PRIMARY KEY
  ,`work`        VARCHAR(8)   NOT NULL
)
