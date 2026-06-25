-- Migration : système multi-utilisateurs
-- Exécuter une seule fois sur la base MySQL o2switch
-- Puis : php -r "echo password_hash('TON_MOT_DE_PASSE', PASSWORD_DEFAULT);"
-- Et insérer le premier admin :
-- INSERT INTO cms_users (username, password_hash, role) VALUES ('victoria', 'LE_HASH', 'admin');

CREATE TABLE IF NOT EXISTS cms_users (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  username      VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role          ENUM('admin','client') NOT NULL DEFAULT 'client',
  active        TINYINT(1) NOT NULL DEFAULT 1,
  created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS cms_login_attempts (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  ip           VARCHAR(45) NOT NULL,
  attempted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_ip_time (ip, attempted_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
