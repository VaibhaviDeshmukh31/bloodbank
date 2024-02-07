DELIMITER //

CREATE PROCEDURE InsertDonor(
    IN p_first_name VARCHAR(50),
    IN p_last_name VARCHAR(50),
    IN p_email VARCHAR(100),
    IN p_phone_number VARCHAR(20),
    IN p_date_of_birth DATE,
    IN p_blood_type ENUM('A', 'B', 'AB', 'O', 'Other'),
    IN p_zip_code VARCHAR(10)
)
BEGIN
    INSERT INTO donors (
        first_name, last_name, email, phone_number, date_of_birth, blood_type, zip_code
    ) VALUES (
        p_first_name, p_last_name, p_email, p_phone_number, p_date_of_birth, p_blood_type, p_zip_code
    );
END //

DELIMITER ;
