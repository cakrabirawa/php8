-- Migration: create kategori_produk table and add kategori_id to produk_buku

CREATE TABLE IF NOT EXISTS kategori_produk (
  id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(191) NOT NULL,
  slug VARCHAR(191) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  UNIQUE KEY (slug)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Add kategori_id to produk_buku if not exists
ALTER TABLE produk_buku
  ADD COLUMN IF NOT EXISTS kategori_id INT UNSIGNED NULL DEFAULT NULL;

-- Optionally add foreign key (commented out to avoid migration failure on non-InnoDB)
-- ALTER TABLE produk_buku
--   ADD CONSTRAINT fk_produk_kategori FOREIGN KEY (kategori_id) REFERENCES kategori_produk(id) ON DELETE SET NULL ON UPDATE CASCADE;
