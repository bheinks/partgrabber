-- Data insertion SQL
-- for PCPartPicker Database
-- Group G19

USE partgrabber;

INSERT INTO `user` (`username`, `password`) VALUES
('Brett', '1234'),
('Stuart', '1234');

INSERT INTO `saved_build` (`username`, `build_name`, `description`, `cost`, `cpu_id`, `gpu_id`, `storage_id`, `ram_id`, `motherboard_id`, `case_id`, `psu_id`) VALUES
('Stuart', 'Extreme!', 'For extreme performance!!!!', 4390.05, 'bestbuy-intel-cpu-bx80648i75960x', 'amazon-evga-video-card-12gp42992kr', 'adorama-samsung-internal-hard-drive-mz75e2t0bam', 'amazon-corsair-memory-cmd64gx4m8b2800c14', 'ncixus-msi-motherboard-b150gamingm3', 'superbiiz-cooler-master-case-rc1200kkn1', 'directron-corsair-power-supply-ax1200i'),
('Stuart', 'How do I PC?', 'Whats a CPU?', 399.35, 'amazon-intel-cpu-bx80605i5750', '0', '0', '0', 'amazon-asrock-motherboard-b85mdgs', 'bhphotovideo-cooler-master-case-mcy005pkwn00', '0'),
('Stuart', 'My cheap build', 'Nice and affordable!', 287.73, 'amazon-intel-cpu-bx80646i34130', '0', 'outletpc-seagate-internal-hard-drive-st1000dm003', 'outletpc-crucial-memory-ct51264ba160bj', 'newegg-gigabyte-motherboard-gab85mds3ha', 'newegg-cooler-master-case-nse200kkn1', 'directron-antec-power-supply-vp450'),
('Brett', 'Bretts PC', 'I built this!', 674.82, 'amazon-intel-cpu-bx80646i54430', 'ncixus-evga-video-card-02gp43751kr', 'amazon-samsung-internal-hard-drive-mz75e250bam', 'outletpc-corsair-memory-cmx8gx3m2a1333c9', 'newegg-gigabyte-motherboard-gaz97hd3', 'newegg-fractal-design-case-fdcadefsbkw', 'bestbuy-corsair-power-supply-cx750m');