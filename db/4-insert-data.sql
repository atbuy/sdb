INSERT INTO MATHITIS(full_name, age, class_year, school) VALUES ('Mathitis 1', 16, 1, 'B1234');
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 2', 17, 2, 'B1234', 13);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 3', 16, 1, 'E1234', 54);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 4', 15, 3, 'A1234', 34);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 5', 13, 1, 'A1234', 20);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 6', 20, 2, 'E1234', 164);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 7', 18, 1, 'F1234', 89);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 8', 16, 2, 'B1234', 1);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 9', 17, 2, 'G1234', 100);
INSERT INTO MATHITIS(full_name, age, class_year, school, absences) VALUES ('Mathitis 10', 16, 1, 'B1234', 65);


INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Edging I', 1, 'GYMNASIO');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Brainrotmaxxing I', 1, 'LYKEIO');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Edging II', 2, 'LYKEIO');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Looksmaxxing III', 1, 'EPAL');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Thick of it analysis II', 3, 'MOYSIKO');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Hawk Tuah Debate I', 1, 'EIDIKO');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Talk Tuah Production Analysis I', 1, 'EIDIKO');
INSERT INTO MATHIMA(name, active_year, school_category) VALUES ('Gooning I', 2, 'GYMNASIO');


INSERT INTO EXETASH(student, lesson, grade) VALUES (1, 1, 100);
INSERT INTO EXETASH(student, lesson, grade) VALUES (2, 1, 50);
INSERT INTO EXETASH(student, lesson, grade) VALUES (1, 2, 50);
INSERT INTO EXETASH(student, lesson, grade) VALUES (2, 3, 100);
INSERT INTO EXETASH(student, lesson, grade) VALUES (2, 2, 50);


INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(specialty) VALUES ('Math');
INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(specialty) VALUES ('Literature');
INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(specialty) VALUES ('P.E.');
INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(specialty) VALUES ('Economics');


UPDATE EKPAIDEYTIKOS SET specialty = 1 WHERE id=1;
UPDATE EKPAIDEYTIKOS SET specialty = 2 WHERE id=2;
UPDATE EKPAIDEYTIKOS SET specialty = 3 WHERE id=3;
UPDATE EKPAIDEYTIKOS SET specialty = 4 WHERE id=5;
UPDATE EKPAIDEYTIKOS SET specialty = 1 WHERE id=6;

UPDATE EKPAIDEYTIKOS SET secondary_specialty = 3 WHERE id=1;
UPDATE EKPAIDEYTIKOS SET secondary_specialty = 4 WHERE id=2;
UPDATE EKPAIDEYTIKOS SET secondary_specialty = 4 WHERE id=3;
UPDATE EKPAIDEYTIKOS SET secondary_specialty = 2 WHERE id=5;
UPDATE EKPAIDEYTIKOS SET secondary_specialty = 3 WHERE id=6;
