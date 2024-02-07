DELIMITER //
CREATE PROCEDURE AddDonor(
    IN p_first_name VARCHAR(255),
    IN p_last_name VARCHAR(255),
    IN p_email VARCHAR(255),
    IN p_phone_number VARCHAR(20),
    IN p_date_of_birth DATE,
    IN p_blood_type VARCHAR(5),
    IN p_donation_date DATE,
    IN p_address VARCHAR(255),
    IN p_city VARCHAR(100),
    IN p_state VARCHAR(100),
    IN p_zip_code VARCHAR(10)
)
BEGIN
    -- Check if the donor's age is less than 18 years (you can modify this condition)
    IF TIMESTAMPDIFF(YEAR, p_date_of_birth, CURDATE()) < 18 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Donor must be at least 18 years old.';
    ELSE
        INSERT INTO donors (
            first_name,
            last_name,
            email,
            phone_number,
            date_of_birth,
            blood_type,
            donation_date,
            address,
            city,
            state,
            zip_code
        )
        VALUES (
            p_first_name,
            p_last_name,
            p_email,
            p_phone_number,
            p_date_of_birth,
            p_blood_type,
            p_donation_date,
            p_address,
            p_city,
            p_state,
            p_zip_code
        );

        SELECT 'Donor added successfully' AS message;
    END IF;
END //
DELIMITER ;
