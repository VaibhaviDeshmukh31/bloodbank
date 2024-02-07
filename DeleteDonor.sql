DELIMITER //

CREATE PROCEDURE DeleteDonor(IN donorID INT)
BEGIN
    DECLARE done INT DEFAULT 0;
    DECLARE donorCursor CURSOR FOR
        SELECT donor_id, first_name, last_name, email
        FROM donors
        WHERE donor_id = donorID;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = 1;

    -- Initialize variables to store donor details
    DECLARE v_donor_id INT;
    DECLARE v_first_name VARCHAR(50);
    DECLARE v_last_name VARCHAR(50);
    DECLARE v_email VARCHAR(100);

    -- Open the cursor and fetch donor details
    OPEN donorCursor;
    FETCH donorCursor INTO v_donor_id, v_first_name, v_last_name, v_email;

    -- Check if the donor exists
    IF done = 1 THEN
        -- Donor not found, return an error message
        SELECT 'Error: Donor not found' AS message;
    ELSE
        -- Donor found, proceed with deletion
        DELETE FROM donors WHERE donor_id = donorID;
        SELECT CONCAT('Donor ', v_first_name, ' ', v_last_name, ' (ID: ', v_donor_id, ') has been deleted.') AS message;
    END IF;

    -- Close the cursor
    CLOSE donorCursor;
END //

DELIMITER ;
