CREATE DATABASE IF NOT EXISTS academicdb;

/* The USE db_name statement tells MySQL to use the db_name database as the default (current) database for subsequent statements */
USE academicdb;

CREATE TABLE IF NOT EXISTS teachers (
  id int(11) NOT NULL AUTO_INCREMENT,
  first_name varchar(255) default NULL,
  last_name varchar(255) default NULL,
  PRIMARY KEY(id),
  CHECK (first_name <> "")
);

CREATE TABLE IF NOT EXISTS students (
  id int(11) NOT NULL AUTO_INCREMENT,
  teacher_id int(11) NOT NULL,
  first_name varchar(255) default NULL,
  last_name varchar(255) default NULL,
  grade int(2) default NULL,
  age int(2) default NULL,
  /* will have at most 3 digits: xxx */
  starting_reading_lvl int(3) default 0,
  current_reading_lvl int(3) default 0,
  goal_reading_lvl int(3) default NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(teacher_id) REFERENCES teachers(id)
);

CREATE TABLE IF NOT EXISTS students_under_teacher (
  /* teacher id */
  t_id int(11) NOT NULL,
  /* student id */
  s_id int(11) NOT NULL,
  FOREIGN KEY(t_id) REFERENCES teachers(id),
  FOREIGN KEY(s_id) REFERENCES students(id)
);

CREATE TABLE IF NOT EXISTS books (
  id int(11) NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  reading_lvl int(11) DEFAULT 0,
  PRIMARY KEY(id)
);

CREATE TABLE IF NOT EXISTS books_read (
  /* student id */
  s_id int(11) NOT NULL,
  /* book id */
  b_id int(11) NOT NULL,
  FOREIGN KEY(s_id) REFERENCES students(id),
  FOREIGN KEY(b_id) REFERENCES books(id)
);

CREATE TABLE IF NOT EXISTS assessments (
  /* student id */
  s_id int(11) NOT NULL,
  assessment_name varchar(255) default NULL,
  assessment_grade int(3) default 0,
  FOREIGN KEY(s_id) REFERENCES students(id)
);
