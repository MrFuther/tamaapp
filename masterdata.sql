shift_personnelCREATE TABLE locations (
    id INT AUTO_INCREMENT PRIMARY KEY,shift_personnel
    location_name VARCHAR(255) NOT NULL
);

CREATE TABLE device_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT NOT NULL,
    device_type ENUM('Access Point', 'Switch', 'Perangkat IT') NOT NULL,
    device_id VARCHAR(255) NOT NULL,
    FOREIGN KEY (location_id) REFERENCES locations(id) ON DELETE CASCADE
);

CREATE TABLE shift_personnel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_id INT NOT NULL,
    shift ENUM('Pagi', 'Siang', 'Malam') NOT NULL,
    personnel TEXT NOT NULL,
    FOREIGN KEY (location_id) REFERENCES locations(id) ON DELETE CASCADE
);
