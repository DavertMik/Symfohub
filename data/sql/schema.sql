CREATE TABLE assertion (id BIGINT AUTO_INCREMENT, repository_id BIGINT, user_id BIGINT, works VARCHAR(255), comment TEXT, body VARCHAR(255), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX repository_id_idx (repository_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE documentation (id BIGINT AUTO_INCREMENT, repository_id BIGINT, text LONGTEXT, html LONGTEXT, text_hash VARCHAR(32) NOT NULL, INDEX repository_id_idx (repository_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE post (id BIGINT AUTO_INCREMENT, repository_id BIGINT, user_id BIGINT, title VARCHAR(255), body LONGTEXT, html LONGTEXT, is_recommendation TINYINT(1), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX repository_id_idx (repository_id), INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE repository_rate (id BIGINT, rate FLOAT(18, 2), comment TEXT, do_git_hub_user_id bigint(20), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id, do_git_hub_user_id)) ENGINE = INNODB;
CREATE TABLE repository_index (keyword VARCHAR(200), field VARCHAR(50), position BIGINT, id BIGINT, PRIMARY KEY(keyword, field, position, id)) ENGINE = INNODB;
CREATE TABLE repository (id BIGINT AUTO_INCREMENT, name VARCHAR(255), owner VARCHAR(255), source VARCHAR(255), parent VARCHAR(255), description LONGTEXT, forks BIGINT DEFAULT 0, watchers BIGINT DEFAULT 0, fork TINYINT(1) DEFAULT '0', private TINYINT(1) DEFAULT '0', homepage TEXT, has_wiki TINYINT(1) DEFAULT '0', has_issues TINYINT(1) DEFAULT '0', has_downloads TINYINT(1) DEFAULT '0', inner_rate BIGINT, type VARCHAR(255), works VARCHAR(255), percent BIGINT, total BIGINT, is_verified TINYINT(1) DEFAULT '0', is_recomended TINYINT(1) DEFAULT '0', created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, rate FLOAT(18, 2), INDEX innner_rate_idx (inner_rate), INDEX owner_idx (owner), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE requirement (id BIGINT AUTO_INCREMENT, repository_id BIGINT, type VARCHAR(255), value VARCHAR(255), INDEX repository_id_idx (repository_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE requirment (id BIGINT AUTO_INCREMENT, repostory_id BIGINT, type VARCHAR(255), name VARCHAR(255), version VARCHAR(5), INDEX repostory_id_idx (repostory_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tag (id BIGINT AUTO_INCREMENT, name VARCHAR(100), is_triple TINYINT(1), triple_namespace VARCHAR(100), triple_key VARCHAR(100), triple_value VARCHAR(100), INDEX name_idx (name), INDEX triple1_idx (triple_namespace), INDEX triple2_idx (triple_key), INDEX triple3_idx (triple_value), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE tagging (id BIGINT AUTO_INCREMENT, tag_id BIGINT NOT NULL, taggable_model VARCHAR(30), taggable_id BIGINT, INDEX tag_idx (tag_id), INDEX taggable_idx (taggable_model, taggable_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE twitter_tweets (keyword VARCHAR(255) NOT NULL, screen_name VARCHAR(255) NOT NULL, avatar VARCHAR(255), user_id VARCHAR(255) NOT NULL, native_id VARCHAR(255), parsed_text VARCHAR(255), created_at datetime NOT NULL, fetched_at DATETIME NOT NULL, INDEX keyword_idx (keyword), INDEX identification_idx (screen_name, user_id), PRIMARY KEY(native_id)) ENGINE = INNODB;
CREATE TABLE twitter_tweet_last_fetches (id BIGINT AUTO_INCREMENT, keyword VARCHAR(255) NOT NULL, screen_name VARCHAR(255), user_id VARCHAR(255), fetched_at datetime, INDEX keyword_idx (keyword), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE do_git_hub_remember (id BIGINT AUTO_INCREMENT, remember_key VARCHAR(32), user_id BIGINT, access_token VARCHAR(50), created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX user_id_idx (user_id), PRIMARY KEY(id)) ENGINE = INNODB;
CREATE TABLE do_git_hub_user (id BIGINT AUTO_INCREMENT, username VARCHAR(255), email VARCHAR(255), is_admin TINYINT(1) DEFAULT '0', UNIQUE INDEX unique_username_idx (username), INDEX username_idx (username), PRIMARY KEY(id)) ENGINE = INNODB;
ALTER TABLE assertion ADD CONSTRAINT assertion_user_id_do_git_hub_user_id FOREIGN KEY (user_id) REFERENCES do_git_hub_user(id);
ALTER TABLE assertion ADD CONSTRAINT assertion_repository_id_repository_id FOREIGN KEY (repository_id) REFERENCES repository(id);
ALTER TABLE documentation ADD CONSTRAINT documentation_repository_id_repository_id FOREIGN KEY (repository_id) REFERENCES repository(id);
ALTER TABLE post ADD CONSTRAINT post_user_id_do_git_hub_user_id FOREIGN KEY (user_id) REFERENCES do_git_hub_user(id);
ALTER TABLE post ADD CONSTRAINT post_repository_id_repository_id FOREIGN KEY (repository_id) REFERENCES repository(id);
ALTER TABLE repository_rate ADD CONSTRAINT repository_rate_id_repository_id FOREIGN KEY (id) REFERENCES repository(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE repository_rate ADD CONSTRAINT repository_rate_do_git_hub_user_id_do_git_hub_user_id FOREIGN KEY (do_git_hub_user_id) REFERENCES do_git_hub_user(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE repository_index ADD CONSTRAINT repository_index_id_repository_id FOREIGN KEY (id) REFERENCES repository(id) ON UPDATE CASCADE ON DELETE CASCADE;
ALTER TABLE repository ADD CONSTRAINT repository_owner_do_git_hub_user_username FOREIGN KEY (owner) REFERENCES do_git_hub_user(username);
ALTER TABLE requirement ADD CONSTRAINT requirement_repository_id_repository_id FOREIGN KEY (repository_id) REFERENCES repository(id);
ALTER TABLE requirment ADD CONSTRAINT requirment_repostory_id_repository_id FOREIGN KEY (repostory_id) REFERENCES repository(id);
ALTER TABLE do_git_hub_remember ADD CONSTRAINT do_git_hub_remember_user_id_do_git_hub_user_id FOREIGN KEY (user_id) REFERENCES do_git_hub_user(id) ON DELETE CASCADE;
