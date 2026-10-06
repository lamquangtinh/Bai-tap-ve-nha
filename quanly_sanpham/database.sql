CREATE DATABASE IF NOT EXISTS db_quanly_sanpham;
USE db_quanly_sanpham;

CREATE TABLE IF NOT EXISTS san_pham (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_sp VARCHAR(255) NOT NULL,
    gia DECIMAL(10,2) NOT NULL,
    so_luong INT NOT NULL DEFAULT 0,
    mo_ta TEXT,
    ngay_tao DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO san_pham (ten_sp, gia, so_luong, mo_ta) VALUES
('Bánh mì chà bông', 15000.00, 20, 'Bánh mì tươi nhân chà bông cay'),
('Sữa tươi trân châu', 30000.00, 15, 'Sữa tươi tiệt trùng thêm trân châu'),
('Bánh Chocopai', 45000.00, 10, 'Hộp 6 gói socola truyền thống'),
('Trứng gà ta', 28000.00, 50, 'Vỉ 10 quả trứng gà ta tươi'),
('Mỳ tôm', 50000.00, 10, 'Mỳ tôm hảo hảo chua cay');