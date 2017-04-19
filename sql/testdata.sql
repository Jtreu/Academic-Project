/* Some default values just to fill the database a little bit */
/* NOTES: when I say something should auto increment, i mean that i don't specify the id
          when i put in new data because that will auto increment without me touching it

          You can only run these statements after you have ran the statements in create_db.sql,
          duh dude.*/

/* The USE db_name statement tells MySQL to use the db_name database as the default (current) database for subsequent statements */
USE academicdb;

/* teacher.id should auto increment */
INSERT INTO teachers(first_name, last_name)
VALUES ('Joanne', 'Higgins');

INSERT INTO teachers(first_name, last_name)
VALUES ('Barbara', 'Smith');

/* Inserting 3 students into the student table */
/* student.id should auto increment */
INSERT INTO students(first_name, last_name, grade, age, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
SELECT DISTINCT
  'Christopher', 'Coolidge', 6, 12, 25, 50, 100, id
FROM teachers WHERE teachers.first_name = 'Joanne' AND
                    teachers.last_name  = 'Higgins';

INSERT INTO students(first_name, last_name, grade, age, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
SELECT DISTINCT
  'Sally', 'Summer', 6, 12, 25, 50, 100, id
FROM teachers WHERE teachers.first_name = 'Joanne' AND
                    teachers.last_name  = 'Higgins';

INSERT INTO students(first_name, last_name, grade, age, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
SELECT DISTINCT
  'Billy', 'Bojangles', 6, 12, 25, 50, 100, id
FROM teachers WHERE teachers.first_name = 'Joanne' AND
                    teachers.last_name  = 'Higgins';

/* books.id should auto increment */
INSERT INTO books(name, reading_lvl)
VALUES ('The catcher in the rye', 100);

/* insert the 3 default students under the tutiledge of test teacher */
/* Test Coolidge under the tutiledge of Test Teacher */
INSERT INTO students_under_teacher(t_id, s_id)
SELECT DISTINCT t.id, s.id
FROM teachers t, students s
WHERE t.first_name = 'Joanne' AND
      t.last_name = 'Higgins' AND
      s.first_name = 'Christopher' AND
      s.last_name = 'Coolidge';

/* Test Summer under the tutiledge of Test Teacher */
INSERT INTO students_under_teacher(t_id, s_id)
SELECT DISTINCT t.id, s.id
FROM teachers t, students s
WHERE t.first_name = 'Joanne' AND
      t.last_name = 'Higgins' AND
      s.first_name = 'Sally' AND
      s.last_name = 'Summer';

/* Test Bojangles under the tutiledge of Test Teacher */
INSERT INTO students_under_teacher(t_id, s_id)
SELECT DISTINCT t.id, s.id
FROM teachers t, students s
WHERE t.first_name = 'Joanne' AND
      t.last_name = 'Higgins' AND
      s.first_name = 'Billy' AND
      s.last_name = 'Bojangles';

/* all default test students have read the same book */
INSERT INTO books_read(s_id, b_id)
SELECT DISTINCT s.id, b.id
FROM students s, books b
WHERE s.first_name = 'Christopher' AND
      s.last_name = 'Coolidge' AND
      b.name = 'The catcher in the rye';

INSERT INTO books_read(s_id, b_id)
SELECT DISTINCT s.id, b.id
FROM students s, books b
WHERE s.first_name = 'Sally' AND
      s.last_name = 'Summer' AND
      b.name = 'The catcher in the rye';

INSERT INTO books_read(s_id, b_id)
SELECT DISTINCT s.id, b.id
FROM students s, books b
WHERE s.first_name = 'Billy' AND
      s.last_name = 'Bojangles' AND
      b.name = 'The catcher in the rye';

/* insert 3 different tests and grades for the test students */
INSERT INTO assessments(s_id, assessment_name, assessment_grade)
SELECT DISTINCT s.id, 'Homework1', 50
FROM students s
WHERE s.first_name = 'Christopher' AND
      s.last_name = 'Coolidge';

INSERT INTO assessments(s_id, assessment_name, assessment_grade)
SELECT DISTINCT s.id, 'Homework1', 75
FROM students s
WHERE s.first_name = 'Sally' AND
      s.last_name = 'Summer';

INSERT INTO assessments(s_id, assessment_name, assessment_grade)
SELECT DISTINCT s.id, 'Homework1', 100
FROM students s
WHERE s.first_name = 'Billy' AND
      s.last_name = 'Bojangles';
