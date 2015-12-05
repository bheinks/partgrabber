-- Data insertion SQL
-- for PCPartPicker Database
-- Group G19

USE partgrabber;

INSERT INTO `user` (`username`, `password`) VALUES
('user1', '1234'),
('user2', '5678');

INSERT INTO `saved_build` (`username`, `build_name`, `description`, `cost`) VALUES
('user1', 'My first build!', 'I built this!', 699.99),
('user1', 'My other build!', 'I built this too! Its cool!', 759.99);

-- more will need to be added.....