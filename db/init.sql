CREATE TABLE IF NOT EXISTS bins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    location_name VARCHAR(100),
    lat DECIMAL(10, 8),
    lng DECIMAL(11, 8),
    fill_level INT DEFAULT 0, -- 0 to 100%
    last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('admin','user') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Sample data with different fill levels
INSERT INTO bins (location_name, lat, lng, fill_level) VALUES 
('CNSC Main Campus', 14.1171, 122.9525, 95), -- Red (Critical)
('Daet Public Market', 14.1122, 122.9556, 75), -- Yellow (Warning)
('SM City Daet Area', 14.1085, 122.9540, 40); -- Green (Normal)

INSERT INTO bins (location_name, lat, lng, fill_level) VALUES 
('Daet Municipal Hall', 14.1135, 122.9510, 25),        -- Low (won't show in route)
('Vinzons Town Plaza', 14.1200, 122.9480, 80),         -- High
('Mercedes Town Center', 14.1180, 122.9200, 55),       -- Medium
('Basud Public Market', 14.0650, 122.9350, 40),       -- Low (won't show in route)
('Talisay Elementary School', 14.1090, 122.9600, 85);  -- High

-- Sample users (passwords are hashed once; values below match password_verify in PHP)
-- admin/admin123
INSERT INTO users (username, password_hash, role) VALUES
('admin', '$2a$12$MtEHz2N7Al8vowNChEYRDu/Mmt9OuN4Z.jWw7fGEAHwonikOtirdy', 'admin')
ON DUPLICATE KEY UPDATE username=username;

-- user/user123
INSERT INTO users (username, password_hash, role) VALUES
('user', '$2a$12$pNc8AVwLoxHzR4DOwuCecufaQSoeqbnG8UUDsnZhB8SxsEWuEqVEG', 'user')
ON DUPLICATE KEY UPDATE username=username;
