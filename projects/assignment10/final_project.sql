CREATE TABLE final_project (
  final_project_id int UNSIGNED NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  address varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  state  varchar(25) NOT NULL,
  phone varchar(25) NOT NULL,
  email varchar(100) NOT NULL,
  dob date NOT NULL,
  age varchar(100) NOT NULL,
  c1 char(1) NOT NULL,
  c2 char(1) NOT NULL,  
  c3 char(1) NOT NULL,
  PRIMARY KEY (final_project_id)
);
