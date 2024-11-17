CREATE TABLE MATHITIS(
  id INT PRIMARY KEY AUTO_INCREMENT,
  full_name VARCHAR(35) NOT NULL,
  age INT NOT NULL,
  class_year INT NOT NULL,  -- Should be the year the student is on currently.
  school VARCHAR(5) NOT NULL,
  absences INT DEFAULT 0 NOT NULL,

  FOREIGN KEY (school) REFERENCES SXOLEIO(code)
);


CREATE TABLE MATHIMA(
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(50) NOT NULL,
  active_year INT NOT NULL, -- Shows when the students should take this lesson
  school_category VARCHAR(8) NOT NULL,

  FOREIGN KEY (school_category) REFERENCES KATHGORIA(name)
);


CREATE TABLE EXETASH(
  id INT PRIMARY KEY AUTO_INCREMENT,
  student INT NOT NULL,
  lesson INT NOT NULL,
  -- Should be 0 to 100. Defaults to 0 if the student did not take the exam.
  grade SMALLINT UNSIGNED DEFAULT 0,

  FOREIGN KEY (student) REFERENCES MATHITIS(id),
  FOREIGN KEY (lesson) REFERENCES MATHIMA(id),

  CONSTRAINT valid_grade CHECK (
    grade BETWEEN 0 AND 100
  )
);

CREATE TABLE EIDIKOTHTA_EKPAIDEYTIKOU(
  id INT PRIMARY KEY AUTO_INCREMENT,
  specialty VARCHAR(50) NOT NULL
);

-- Add optional specialty to each teacher. Not all teachers have a specialty in a subject
ALTER TABLE EKPAIDEYTIKOS ADD COLUMN (specialty INT);
ALTER TABLE EKPAIDEYTIKOS ADD COLUMN (secondary_specialty INT);
ALTER TABLE EKPAIDEYTIKOS ADD CONSTRAINT FOREIGN KEY (specialty) REFERENCES EIDIKOTHTA_EKPAIDEYTIKOU(id);
ALTER TABLE EKPAIDEYTIKOS ADD CONSTRAINT FOREIGN KEY (secondary_specialty) REFERENCES EIDIKOTHTA_EKPAIDEYTIKOU(id);
