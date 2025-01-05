-- 4.a) Query using LIKE: 
SELECT * 
FROM SXOLEIO 
WHERE name LIKE 'School%';

-- 4.b) Query with filter and sort:
SELECT e.id, e.full_name, e.work_years 
FROM EKPAIDEYTIKOS e
WHERE e.work_years > 4
ORDER BY e.work_years DESC;

-- 4.c) Query with logical operators:
SELECT * 
FROM MATHITIS 
WHERE (age > 15 AND absences < 5) OR NOT (school IS NULL);


-- 5.a) Query using count & group_by:
SELECT
  s.name,
  count(*) AS total_students
FROM MATHITIS m
LEFT JOIN SXOLEIO s ON s.code=m.school
GROUP BY s.name;


-- 5.b) Query with AVG & group_by:
SELECT
  m.school_category,
  AVG(grade) AS average_grade 
FROM EXETASH e
INNER JOIN MATHIMA m ON e.lesson = m.id
GROUP BY m.school_category;


-- 6.a) Query inner join:
SELECT
  e.id,
  e.full_name,
  s.name AS school_name 
FROM EKPAIDEYTIKOS e
INNER JOIN SXOLEIO s ON e.school = s.code;

-- 6.b) Query left join:
SELECT
  m.id,
  m.full_name,
  e.grade 
FROM MATHITIS m
LEFT JOIN EXETASH e ON m.id = e.student;


-- 7.a) Create view with grade statistics per school 
CREATE VIEW SCHOOL_STATS AS
SELECT
	s.name AS school_name,
	k.description AS category_description,
	COUNT(m.id) AS total_students,
	AVG(e.grade) AS avg_grade
FROM
	SXOLEIO s
JOIN KATHGORIA k ON
	s.category = k.name
LEFT JOIN MATHITIS m ON
	s.code = m.school
LEFT JOIN EXETASH e ON
	m.id = e.student
GROUP BY
	s.name,
	k.description;


-- 7.b) Querying the view:
SELECT * 
FROM SCHOOL_STATS;


-- 8.a) Create procedure to update a student's absences by given amount
DELIMITER //

CREATE PROCEDURE increase_absence(
  IN student_id INT,
  IN amount INT
)
BEGIN
  UPDATE MATHITIS m SET m.absences=m.absences+amount WHERE m.id=student_id;
END//

DELIMITER ;

-- 8.b) Call procedure and update a student's absences
CALL increase_absence(1, 3);

-- 9.a) Create trigger to set missed_year to true,
--      in case a student has reached their maximum absences.
DELIMITER $$
CREATE TRIGGER update_missed_year
BEFORE UPDATE ON MATHITIS
FOR EACH ROW
BEGIN
  IF (NEW.absences > 164) THEN
    SET NEW.missed_year = true;
  END IF;
END $$
DELIMITER ;

-- 9.b) Update MATHITIS to run the trigger
UPDATE MATHITIS ma SET ma.absences=165 WHERE ma.id=1;
