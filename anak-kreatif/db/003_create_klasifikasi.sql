-- Migration: create klasifikasi_produk table and add klasifikasi_id to produk_buku

CREATE TABLE IF NOT EXISTS klasifikasi_produk (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(191) NOT NULL,
  slug VARCHAR(191) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add klasifikasi_id to produk_buku if not exists
ALTER TABLE produk_buku
  ADD COLUMN IF NOT EXISTS klasifikasi_id INT UNSIGNED NULL DEFAULT NULL;

-- Seed default klasifikasi values if table empty
INSERT INTO klasifikasi_produk (nama, slug, is_active)
SELECT * FROM (
  SELECT 'Books' AS nama, 'books' AS slug, 1 AS is_active
  UNION ALL SELECT 'Non Books', 'non-books', 1
  UNION ALL SELECT 'Digital', 'digital', 1
) AS tmp
WHERE NOT EXISTS (SELECT 1 FROM klasifikasi_produk LIMIT 1);

-- Optionally add foreign key (commented out for portability)
-- ALTER TABLE produk_buku
--   ADD CONSTRAINT fk_produk_klasifikasi FOREIGN KEY (klasifikasi_id) REFERENCES klasifikasi_produk(id) ON DELETE SET NULL ON UPDATE CASCADE;
