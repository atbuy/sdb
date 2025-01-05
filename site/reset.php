<?php
  // Resets the database.
  // This is useful because there is no authentication on the site,
  // so anyone is able to run operations on the tables implemented.
  // This endpoint will simply drop the database, and then reload all the SQL files.

  // Only accept DELETE requests
  if ($_SERVER["REQUEST_METHOD"] != "DELETE") {
    http_response_code(405);
    exit();
  }

  include './connect.php';

  mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

  header("Content-Type", "application/json");

  $response = new stdClass();


  // Clean database by dropping all the existing tables;
  $query = "DROP TABLE IF EXISTS EKPAIDEYTIKOS;
            DROP TABLE IF EXISTS EIDIKOTHTA_EKPAIDEYTIKOU;
            DROP TABLE IF EXISTS EXETASH;
            DROP TABLE IF EXISTS MATHIMA;
            DROP TABLE IF EXISTS MATHITIS;
            DROP TABLE IF EXISTS SXOLEIO;
            DROP TABLE IF EXISTS KATHGORIA;";
  $success = $conn->multi_query($query);
  if (!$success) {
    http_response_code(500);
    $response->message = "Could not clean database.";
    $response->status = 500;
    echo json_encode($response);
    exit();
  }

  // Free mysqli buffer by reading all results
  while ($conn->next_result()) {};

  // Recreate all tables
  $query = "CREATE TABLE KATHGORIA(
              name VARCHAR(8) PRIMARY KEY,
              description VARCHAR(5000) NOT NULL
            );
            CREATE TABLE SXOLEIO(
              code VARCHAR(5) PRIMARY KEY,
              name VARCHAR(30) NOT NULL,
              address VARCHAR(45) NOT NULL,
              category VARCHAR(8) NOT NULL,
              FOREIGN KEY (category) REFERENCES KATHGORIA(name)
            );
            CREATE TABLE EKPAIDEYTIKOS(
              id INT PRIMARY KEY AUTO_INCREMENT,
              full_name VARCHAR(35) NOT NULL,
              work_years INT NOT NULL,
              school VARCHAR(5),
              FOREIGN KEY (school) REFERENCES SXOLEIO(code)
            );
            CREATE TABLE MATHITIS(
              id INT PRIMARY KEY AUTO_INCREMENT,
              full_name VARCHAR(35) NOT NULL,
              age INT NOT NULL,
              class_year INT NOT NULL,
              school VARCHAR(5) NOT NULL,
              absences INT DEFAULT 0 NOT NULL,
              missed_year BOOLEAN DEFAULT false NOT NULL,
              FOREIGN KEY (school) REFERENCES SXOLEIO(code) ON DELETE CASCADE
            );
            CREATE TABLE MATHIMA(
              id INT PRIMARY KEY AUTO_INCREMENT,
              name VARCHAR(50) NOT NULL,
              active_year INT NOT NULL,
              school_category VARCHAR(8),
              FOREIGN KEY (school_category) REFERENCES KATHGORIA(name) ON DELETE SET NULL
            );
            CREATE TABLE EXETASH(
              id INT PRIMARY KEY AUTO_INCREMENT,
              student INT NOT NULL,
              lesson INT NOT NULL,
              grade SMALLINT UNSIGNED DEFAULT 0,
              FOREIGN KEY (student) REFERENCES MATHITIS(id) ON DELETE CASCADE,
              FOREIGN KEY (lesson) REFERENCES MATHIMA(id) ON DELETE CASCADE,
              CONSTRAINT valid_grade CHECK (
                grade BETWEEN 0 AND 100
              )
            );
            CREATE TABLE EIDIKOTHTA_EKPAIDEYTIKOU(
              id INT PRIMARY KEY AUTO_INCREMENT,
              specialty VARCHAR(50) NOT NULL
            );
            ALTER TABLE EKPAIDEYTIKOS ADD COLUMN (specialty INT);
            ALTER TABLE EKPAIDEYTIKOS ADD COLUMN (secondary_specialty INT);
            ALTER TABLE EKPAIDEYTIKOS ADD CONSTRAINT FOREIGN KEY (specialty) REFERENCES EIDIKOTHTA_EKPAIDEYTIKOU(id) ON DELETE SET NULL;
            ALTER TABLE EKPAIDEYTIKOS ADD CONSTRAINT FOREIGN KEY (secondary_specialty) REFERENCES EIDIKOTHTA_EKPAIDEYTIKOU(id) ON DELETE SET NULL;";
  $success = $conn->multi_query($query);
  if (!$success) {
    http_response_code(500);
    $response->message = "Could not recreate database.";
    $response->status = 500;
    echo json_encode($response);
    exit();
  }

  // Free mysqli buffer by reading all results
  while ($conn->next_result()) {};

  // Reinsert all the data in the database to restore it
  $query =  'INSERT INTO KATHGORIA(name, description) VALUES ("GYMNASIO", "Gymnasio");'.
            'INSERT INTO KATHGORIA(name, description) VALUES ("LYKEIO", "Lykeio");'.
            'INSERT INTO KATHGORIA(name, description) VALUES ("EPAL", "Epal");'.
            'INSERT INTO KATHGORIA(name, description) VALUES ("MOYSIKO", "Moysiko");'.
            'INSERT INTO KATHGORIA(name, description) VALUES ("EIDIKO", "Eidiko");'.
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('A1234', 'School 1', 'Address 1', 'GYMNASIO');".
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('B1234', 'School 2', 'Address 2', 'LYKEIO');".
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('C1234', 'School 3', 'Address 3', 'LYKEIO');".
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('D1234', 'School 4', 'Address 4', 'LYKEIO');".
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('E1234', 'School 5', 'Address 5', 'EPAL');".
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('F1234', 'School 6', 'Address 6', 'MOYSIKO');".
            "INSERT INTO SXOLEIO(code, name, address, category) VALUES ('G1234', 'School 7', 'Address 7', 'EIDIKO');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (1, 'Kathigitis 1', 1, 'A1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (2, 'Kathigitis 2', 3, 'A1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (3, 'Kathigitis 3', 2, 'B1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (4, 'Kathigitis 4', 4, 'C1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (5, 'Kathigitis 5', 5, 'D1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (6, 'Kathigitis 6', 20, 'A1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (7, 'Kathigitis 7', 5, 'E1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (8, 'Kathigitis 8', 10, 'F1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (9, 'Kathigitis 9', 9, 'G1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (10, 'Kathigitis 10', 7, 'E1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (11, 'Kathigitis 11', 3, 'B1234');".
            "INSERT INTO EKPAIDEYTIKOS(id, full_name, work_years, school) VALUES (12, 'Kathigitis 12', 4, 'B1234');".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school) VALUES (1, 'Mathitis 1', 16, 1, 'B1234');".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (2, 'Mathitis 2', 17, 2, 'B1234', 13);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (3, 'Mathitis 3', 16, 1, 'E1234', 54);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (4, 'Mathitis 4', 15, 3, 'A1234', 34);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (5, 'Mathitis 5', 13, 1, 'A1234', 20);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (6, 'Mathitis 6', 20, 2, 'E1234', 164);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (7, 'Mathitis 7', 18, 1, 'F1234', 89);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (8, 'Mathitis 8', 16, 2, 'B1234', 1);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (9, 'Mathitis 9', 17, 2, 'G1234', 100);".
            "INSERT INTO MATHITIS(id, full_name, age, class_year, school, absences) VALUES (10, 'Mathitis 10', 16, 1, 'B1234', 65);".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (1, 'Edging I', 1, 'GYMNASIO');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (2, 'Brainrotmaxxing I', 1, 'LYKEIO');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (3, 'Edging II', 2, 'LYKEIO');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (4, 'Looksmaxxing III', 1, 'EPAL');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (5, 'Thick of it analysis II', 3, 'MOYSIKO');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (6, 'Hawk Tuah Debate I', 1, 'EIDIKO');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (7, 'Talk Tuah Production Analysis I', 1, 'EIDIKO');".
            "INSERT INTO MATHIMA(id, name, active_year, school_category) VALUES (8, 'Gooning I', 2, 'GYMNASIO');".
            "INSERT INTO EXETASH(id, student, lesson, grade) VALUES (1, 1, 1, 100);".
            "INSERT INTO EXETASH(id, student, lesson, grade) VALUES (2, 2, 1, 50);".
            "INSERT INTO EXETASH(id, student, lesson, grade) VALUES (3, 1, 2, 50);".
            "INSERT INTO EXETASH(id, student, lesson, grade) VALUES (4, 2, 3, 100);".
            "INSERT INTO EXETASH(id, student, lesson, grade) VALUES (5, 2, 2, 50);".
            "INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(id, specialty) VALUES (1, 'Math');".
            "INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(id, specialty) VALUES (2, 'Literature');".
            "INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(id, specialty) VALUES (3, 'P.E.');".
            "INSERT INTO EIDIKOTHTA_EKPAIDEYTIKOU(id, specialty) VALUES (4, 'Economics');";
  $success = $conn->multi_query($query);
  if (!$success) {
    http_response_code(500);
    $response->message = "Could not restore database.";
    $response->status = 500;
    echo json_encode($response);
    exit();
  }

  // Free mysqli buffer by reading all results
  while ($conn->next_result()) {};

  // Database was restored successfully
  http_response_code(200);
  $response->message = "Successfully restored database.";
  $response->status = 200;
  echo json_encode($response);
?>
