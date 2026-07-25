CREATE TABLE `user` (
  `user_id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `email` VARCHAR(128) NOT NULL,
  `password_hash` VARCHAR(64) NOT NULL,
  PRIMARY KEY (`user_id`));


CREATE TABLE `backlog` (
  `backlog_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `date_created` DATETIME NOT NULL,
  `game_name` VARCHAR(128) NOT NULL,
  `game_platform` VARCHAR(64) NOT NULL,
  `date_started` DATETIME NULL,
  `date_completed` DATETIME NULL,
  PRIMARY KEY (`backlog_id`),
  INDEX `fk_backlog__user_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_backlog__user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`user_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);

CREATE TABLE `review` (
  `review_id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT NOT NULL,
  `date_submitted` DATETIME NOT NULL,
  `game_name` VARCHAR(128) NOT NULL,
  `game_platform` VARCHAR(128) NOT NULL,
  `content` TEXT NOT NULL,
  `stars` INT NOT NULL DEFAULT 0,
  `likes` INT NOT NULL DEFAULT 0,
  `dislikes` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`review_id`),
  INDEX `fk_review__user_id_idx` (`user_id` ASC),
  CONSTRAINT `fk_review__user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `user` (`user_id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT);

