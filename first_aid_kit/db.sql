CREATE TABLE households (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    mobileNo VARCHAR(20) NOT NULL,
    adharNo VARCHAR(20) NOT NULL,
    familyMembers INT NOT NULL,
    adults INT NOT NULL,
    children INT NOT NULL,
    address TEXT NOT NULL,
    pinCode VARCHAR(10) NOT NULL,
    district VARCHAR(255) NOT NULL,
    knowsFirstAid BOOLEAN NOT NULL,
    hasCprTraining BOOLEAN NOT NULL,
    userPhoto VARCHAR(255),
    signature VARCHAR(255),
    published_date DATE NOT NULL
);

INSERT INTO households (name, email, gender, mobileNo, adharNo, familyMembers, adults, children, address, pinCode, district, knowsFirstAid, hasCprTraining, userPhoto, signature, published_date)
VALUES
    ('John Doe', 'john@example.com', 'Male', '1234567890', '123456789012', 4, 2, 2, '123 Main St', '12345', 'District 1', TRUE, FALSE, 'photo1.jpg', 'signature1.jpg', '2024-02-01'),
    ('Jane Smith', 'jane@example.com', 'Female', '9876543210', '987654321098', 3, 2, 1, '456 Elm St', '54321', 'District 2', TRUE, TRUE, 'photo2.jpg', 'signature2.jpg', '2024-02-02'),
    ('Alice Johnson', 'alice@example.com', 'Female', '5551112222', '555111222233', 5, 3, 2, '789 Oak St', '67890', 'District 3', FALSE, TRUE, 'photo3.jpg', 'signature3.jpg', '2024-02-03'),
    ('Bob Brown', 'bob@example.com', 'Male', '7778889999', '777888999900', 2, 2, 0, '321 Pine St', '13579', 'District 4', TRUE, FALSE, 'photo4.jpg', 'signature4.jpg', '2024-02-04'),
    ('Eve Wilson', 'eve@example.com', 'Female', '4445556666', '444555666677', 6, 4, 2, '654 Cedar St', '24680', 'District 5', FALSE, FALSE, 'photo5.jpg', 'signature5.jpg', '2024-02-05'),
    ('Michael Clark', 'michael@example.com', 'Male', '1112223333', '111222333344', 3, 2, 1, '987 Walnut St', '97531', 'District 6', TRUE, TRUE, 'photo6.jpg', 'signature6.jpg', '2024-02-06'),
    ('Emma Davis', 'emma@example.com', 'Female', '8889990000', '888999000011', 4, 2, 2, '654 Maple St', '36987', 'District 7', TRUE, FALSE, 'photo7.jpg', 'signature7.jpg', '2024-02-07'),
    ('William Miller', 'william@example.com', 'Male', '3334445555', '333444555566', 2, 2, 0, '321 Birch St', '75309', 'District 8', FALSE, TRUE, 'photo8.jpg', 'signature8.jpg', '2024-02-08'),
    ('Olivia Garcia', 'olivia@example.com', 'Female', '6667778888', '666777888899', 5, 3, 2, '987 Oak St', '12345', 'District 9', TRUE, TRUE, 'photo9.jpg', 'signature9.jpg', '2024-02-09'),
    ('James Martinez', 'james@example.com', 'Male', '9990001111', '999000111122', 4, 3, 1, '654 Pine St', '67890', 'District 10', FALSE, FALSE, 'photo10.jpg', 'signature10.jpg', '2024-02-10'),
    ('Sophia Rodriguez', 'sophia@example.com', 'Female', '2223334444', '222333444455', 3, 2, 1, '987 Elm St', '24680', 'District 11', TRUE, TRUE, 'photo11.jpg', 'signature11.jpg', '2024-02-11'),
    ('Benjamin Hernandez', 'benjamin@example.com', 'Male', '5556667777', '555666777788', 6, 4, 2, '321 Walnut St', '97531', 'District 12', FALSE, FALSE, 'photo12.jpg', 'signature12.jpg', '2024-02-12'),
    ('Mia Lopez', 'mia@example.com', 'Female', '1112223333', '111222333344', 4, 3, 1, '654 Cedar St', '36987', 'District 13', TRUE, FALSE, 'photo13.jpg', 'signature13.jpg', '2024-02-13'),
    ('Alexander Hill', 'alexander@example.com', 'Male', '8889990000', '888999000011', 2, 2, 0, '987 Maple St', '75309', 'District 14', FALSE, TRUE, 'photo14.jpg', 'signature14.jpg', '2024-02-14'),
    ('David Wilson', 'david@example.com', 'Male', '4445556666', '444555666677', 4, 2, 2, '789 Oak St', '67890', 'District 16', TRUE, TRUE, 'photo16.jpg', 'signature16.jpg', '2024-02-16'),
    ('Ava Thompson', 'ava@example.com', 'Female', '7778889999', '777888999900', 3, 2, 1, '321 Pine St', '13579', 'District 17', FALSE, FALSE, 'photo17.jpg', 'signature17.jpg', '2024-02-17'),
    ('Noah Lee', 'noah@example.com', 'Male', '2223334444', '222333444455', 5, 3, 2, '654 Cedar St', '24680', 'District 18', TRUE, FALSE, 'photo18.jpg', 'signature18.jpg', '2024-02-18'),
    ('Sophie Perez', 'sophie@example.com', 'Female', '9990001111', '999000111122', 2, 2, 0, '987 Walnut St', '97531', 'District 19', FALSE, TRUE, 'photo19.jpg', 'signature19.jpg', '2024-02-19'),
    ('Liam Moore', 'liam@example.com', 'Male', '6667778888', '666777888899', 6, 4, 2, '654 Maple St', '36987', 'District 20', TRUE, TRUE, 'photo20.jpg', 'signature20.jpg', '2024-02-20'),
    ('Liam Wilson', 'liam@example.com', 'Male', '1112223333', '111222333344', 4, 3, 1, '654 Pine St', '67890', 'District 1', FALSE, FALSE, 'photo21.jpg', 'signature21.jpg', '2024-02-21'),
    ('Sophia Johnson', 'sophia@example.com', 'Female', '8889990000', '888999000011', 2, 2, 0, '321 Walnut St', '97531', 'District 3', TRUE, TRUE, 'photo22.jpg', 'signature22.jpg', '2024-02-22'),
    ('Benjamin Davis', 'benjamin@example.com', 'Male', '5556667777', '555666777788', 5, 3, 2, '987 Oak St', '12345', 'District 5', FALSE, FALSE, 'photo23.jpg', 'signature23.jpg', '2024-02-23'),
    ('Mia Martinez', 'mia@example.com', 'Female', '1112223333', '111222333344', 4, 3, 1, '654 Cedar St', '36987', 'District 7', TRUE, FALSE, 'photo24.jpg', 'signature24.jpg', '2024-02-24'),
    ('Alexander Garcia', 'alexander@example.com', 'Male', '8889990000', '888999000011', 2, 2, 0, '987 Maple St', '75309', 'District 9', FALSE, TRUE, 'photo25.jpg', 'signature25.jpg', '2024-02-25'),
    ('Charlotte Rodriguez', 'charlotte@example.com', 'Female', '3334445555', '333444555566', 5, 3, 2, '321 Birch St', '12345', 'District 11', TRUE, TRUE, 'photo26.jpg', 'signature26.jpg', '2024-02-26'),
    ('William Hernandez', 'william@example.com', 'Male', '7778889999', '777888999900', 3, 2, 1, '321 Pine St', '13579', 'District 13', FALSE, FALSE, 'photo27.jpg', 'signature27.jpg', '2024-02-27'),
    ('Olivia Lopez', 'olivia@example.com', 'Female', '6667778888', '666777888899', 6, 4, 2, '654 Cedar St', '24680', 'District 15', TRUE, TRUE, 'photo28.jpg', 'signature28.jpg', '2024-02-28'),
    ('James Hill', 'james@example.com', 'Male', '9990001111', '999000111122', 4, 3, 1, '987 Elm St', '97531', 'District 17', FALSE, FALSE, 'photo29.jpg', 'signature29.jpg', '2024-02-29'),
    ('Emma Scott', 'emma@example.com', 'Female', '8889990000', '888999000011', 2, 2, 0, '321 Walnut St', '75309', 'District 19', TRUE, TRUE, 'photo30.jpg', 'signature30.jpg', '2024-03-01'),
    ('John Doe', 'john@example.com', 'Male', '1234567890', '123456789012', 4, 2, 2, '123 Main St', '12345', 'District 1', TRUE, FALSE, 'photo1.jpg', 'signature1.jpg', '2024-03-02'),
    ('Jane Doe', 'jane@example.com', 'Female', '9876543210', '987654321098', 2, 1, 0, '456 Elm St', '54321', 'District 2', TRUE, TRUE, 'photo2.jpg', 'signature2.jpg', '2024-03-02'),
    ('Alice Smith', 'alice@example.com', 'Female', '5551234567', '555123456789', 2, 0, 0, '789 Oak St', '67890', 'District 3', TRUE, FALSE, 'photo3.jpg', 'signature3.jpg', '2024-03-02'),
    ('Bob Johnson', 'bob@example.com', 'Male', '3334445555', '333444555666', 3, 1, 1, '456 Pine St', '98765', 'District 4', TRUE, TRUE, 'photo4.jpg', 'signature4.jpg', '2024-03-02'),
    ('Sarah Brown', 'sarah@example.com', 'Female', '2223334444', '222333444555', 1, 0, 0, '789 Maple St', '45678', 'District 5', TRUE, FALSE, 'photo5.jpg', 'signature5.jpg', '2024-03-02'),
    ('Smith', 'smith@example.com', 'Female', '5551234123', '555123456123', 2, 0, 0, '222 Oak St', '67891', 'District 3', TRUE, FALSE, 'photo35.jpg', 'signature35.jpg', '2024-03-02'),
    ('Charlotte Scott', 'charlotte@example.com', 'Female', '3334445555', '333444555566', 5, 3, 2, '321 Birch St', '12345', 'District 15', TRUE, TRUE, 'photo15.jpg', 'signature15.jpg', '2024-02-15');
