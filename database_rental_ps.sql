-- Tambah kolom tanggal expired di tabel members
ALTER TABLE members ADD COLUMN expiry_date DATE DEFAULT NULL;

-- (Opsional) Kalo mau bersihin data member lama biar fresh
TRUNCATE TABLE members;