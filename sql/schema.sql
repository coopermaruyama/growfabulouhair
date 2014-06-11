

create table stripe_response (
  id int unsigned primary key not null auto_increment,
  order_id int unsigned not null,
  first_name varchar(255) not null,
  last_name varchar(255) not null,
  email varchar(255) not null,
  total float not null default 0,
  json text not null,
  created_on timestamp not null
);


