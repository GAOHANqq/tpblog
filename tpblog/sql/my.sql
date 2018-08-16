CREATE TABLE blog_users (
	id int not null auto_increment,
	username varchar(64) not null default '',	
	password varchar(128) not null default '',	
	nickname varchar(64) not null default '',	
	intro text default null,	
	avatar varchar(255) not null default '',
	primary key(id)	
) ENGINE innodb CHARSET utf8;

CREATE TABLE blog_categories (
	id int not null auto_increment,
	name varchar(64) not null default '',	
	creared_time int not null default 0,	
	user_id int not null default 0,	
	primary key(id),
	index(user_id)	
) ENGINE innodb CHARSET utf8;

CREATE TABLE blog_tags (
	id int not null auto_increment,
	name varchar(64) not null default '',	
	creared_time int not null default 0,	
	user_id int not null default 0,	
	primary key(id),
	index(user_id)	
) ENGINE innodb CHARSET utf8;

CREATE TABLE blog_articles (
	id int not null auto_increment,
	title varchar(128) not null default '',	
	body text default null,
	creared_time int not null default 0,
	updated_time int not null default 0,
	category_id int not null default 0,
	user_id  int not null default 0,
	primary key(id),
	index(category_id),	
	index(user_id)	
) ENGINE innodb CHARSET utf8;

CREATE TABLE blog_article_tag_map (
	id int not null auto_increment,
	article_id int not null default 0,	
	tag_id int not null default 0,	
	primary key(id),
) ENGINE innodb CHARSET utf8;

