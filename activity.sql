CREATE TABLE activities (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tanggal DATE NOT NULL,
    lokasi VARCHAR(255) NOT NULL,
    device VARCHAR(255) NOT NULL,
    shift ENUM('Pagi', 'Siang', 'Malam') NOT NULL,
    personil TEXT NOT NULL,
    foto_perangkat VARCHAR(255),
    foto_lokasi VARCHAR(255),
    foto_teknisi VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
