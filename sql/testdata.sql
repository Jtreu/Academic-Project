/* Some default values just to fill the database a little bit */
/* NOTES: when I say something should auto increment, i mean that i don't specify the id
          when i put in new data because that will auto increment without me touching it

          You can only run these statements after you have ran the statements in create_db.sql,
          duh dude.*/

/* The USE db_name statement tells MySQL to use the db_name database as the default (current) database for subsequent statements */
USE academicdb

/* teacher.id should auto increment */
INSERT INTO teachers(first_name, last_name)
VALUES ('Test', 'Teacher');

/* Inserting 3 students into the student table */
/* student.id should auto increment */
INSERT INTO students(first_name, last_name, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
SELECT DISTINCT
  'Test', 'Child1', 25, 50, 100, id,
FROM teachers WHERE teacher.first_name = 'Test' AND
                    teacher.last_name  = 'Teacher';

INSERT INTO students(first_name, last_name, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
SELECT DISTINCT
  'Test', 'Child2', 25, 50, 100, id,
FROM teachers WHERE teacher.first_name = 'Test' AND
                    teacher.last_name  = 'Teacher';

INSERT INTO students(first_name, last_name, starting_reading_lvl, current_reading_lvl, goal_reading_lvl, teacher_id)
SELECT DISTINCT
  'Test', 'Child3', 25, 50, 100, id,
FROM teachers WHERE teacher.first_name = 'Test' AND
                    teacher.last_name  = 'Teacher';

/* books.id should auto increment */
INSERT INTO books(name, reading_lvl)
VALUES ('test_book', 100);

/* insert the 3 default students under the tutiledge of test teacher */
/* Test Child1 under the tutiledge of Test Teacher */
INSERT INTO students_under_teacher(t_id, s_id)
SELECT DISTINCT t.id, s.id
FROM teachers t, students s
WHERE t.first_name = 'Test' AND
      t.last_name = 'Teacher' AND
      s.first_name = 'Test' AND
      s.last_name = 'Child1';

/* Test Child2 under the tutiledge of Test Teacher */
INSERT INTO students_under_teacher(t_id, s_id)
SELECT DISTINCT t.id, s.id
FROM teachers t, students s
WHERE t.first_name = 'Test' AND
      t.last_name = 'Teacher' AND
      s.first_name = 'Test' AND
      s.last_name = 'Child2';

/* Test Child3 under the tutiledge of Test Teacher */
INSERT INTO students_under_teacher(t_id, s_id)
SELECT DISTINCT t.id, s.id
FROM teachers t, students s
WHERE t.first_name = 'Test' AND
      t.last_name = 'Teacher' AND
      s.first_name = 'Test' AND
      s.last_name = 'Child3';

/* all default test students have read the same book */
INSERT INTO books_read(s_id, b_id)
SELECT DISTINCT s.id, b.id
FROM students s, books b
WHERE s.first_name = 'Test' AND
      s.last_name = 'Child1' AND
      b.name = 'test_book';

INSERT INTO books_read(s_id, b_id)
SELECT DISTINCT s.id, b.id
FROM students s, books b
WHERE s.first_name = 'Test' AND
      s.last_name = 'Child2' AND
      b.name = 'test_book';

INSERT INTO books_read(s_id, b_id)
SELECT DISTINCT s.id, b.id
FROM students s, books b
WHERE s.first_name = 'Test' AND
      s.last_name = 'Child3' AND
      b.name = 'test_book';

/* insert 3 different tests and grades for the test students */
INSERT INTO assessments(s_id, assessment_name, assessment_grade)
SELECT DISTINCT s.id, 'Homework1', 50
FROM students s
WHERE s.first_name = 'Test' AND
      s.last_name = 'Child1';

INSERT INTO assessments(s_id, assessment_name, assessment_grade)
SELECT DISTINCT s.id, 'Homework1', 75
FROM students s
WHERE s.first_name = 'Test' AND
      s.last_name = 'Child1';

INSERT INTO assessments(s_id, assessment_name, assessment_grade)
SELECT DISTINCT s.id, 'Homework1', 100
FROM students s
WHERE s.first_name = 'Test' AND
      s.last_name = 'Child1';
