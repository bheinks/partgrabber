-- Data insertion SQL
-- for PCPartPicker Database
-- Group G19

USE partgrabber;

INSERT INTO `user` (`username`, `password`) VALUES
('user1', '1234'),
('user2', '5678');

INSERT INTO `saved_build` (`username`, `build_name`, `description`, `cost`, `cpu_id`, `gpu_id`, `storage_id`, `ram_id`, `motherboard_id`, `case_id`, `psu_id`) VALUES
('user1', 'My first build!', 'I built this!', 699.99, 0, 0, 0, 0, 0, 0, 0),
('user1', 'My other build!', 'I built this too! Its cool!', 759.99, 0, 0, 0, 0, 0, 0, 0);

INSERT INTO `cpu` (`comp_id`, `name`, `manufacturer`, `architecture`, `socket`) VALUES
(1, 'i5', 'Intel', 'x86', 'LGA1155');

-- more will need to be added.....