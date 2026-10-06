<?php
require_once 'db.php';

$id = "";
$ten_sp = "";
$gia = "";
$so_luong = "";
$mo_ta = "";
$is_edit = false;

if (isset($_POST['save'])) {
    $id = $_POST['id'];
    $ten = $_POST['ten_sp'];
    $gia = $_POST['gia'];
    $sl = $_POST['so_luong'];
    $mota = $_POST['mo_ta'];

    if ($id == "") {
        $conn->query("INSERT INTO san_pham (ten_sp, gia, so_luong, mo_ta) VALUES ('$ten', $gia, $sl, '$mota')");
    } else {
        $conn->query("UPDATE san_pham SET ten_sp='$ten', gia=$gia, so_luong=$sl, mo_ta='$mota' WHERE id=$id");
    }
    header("Location: index.php");
    exit();
}

if (isset($_GET['delete'])) {
    $id_del = $_GET['delete'];
    $conn->query("DELETE FROM san_pham WHERE id=$id_del");
    header("Location: index.php");
    exit();
}

if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $res = $conn->query("SELECT * FROM san_pham WHERE id=$id_edit");
    $row = $res->fetch_assoc();
    $id = $row['id'];
    $ten_sp = $row['ten_sp'];
    $gia = $row['gia'];
    $so_luong = $row['so_luong'];
    $mo_ta = $row['mo_ta'];
    $is_edit = true;
}

$result = $conn->query("SELECT * FROM san_pham ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 30px auto; background: #f8f9fa; padding: 20px; color: #333; }
        .box { background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); margin-bottom: 25px; }
        input, textarea { padding: 8px 10px; margin: 6px 0 14px; width: 100%; box-sizing: border-box; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 8px 16px; border: none; background: #28a745; color: #fff; border-radius: 4px; cursor: pointer; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); }
        th, td { padding: 10px 12px; border-bottom: 1px solid #dee2e6; text-align: left; }
        th { background: #007bff; color: #fff; }
        a.btn { text-decoration: none; padding: 4px 8px; border-radius: 3px; font-size: 13px; display: inline-block; }
        .edit { background: #ffc107; color: #000; }
        .delete { background: #dc3545; color: #fff; }
        .cancel { background: #6c757d; color: #fff; padding: 8px 14px; }
    </style>
</head>
<body>

    <div class="box">
        <h3><?= $is_edit ? "Cập nhật sản phẩm" : "Thêm sản phẩm mới" ?></h3>
        <form method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">

            <label>Tên sản phẩm:</label>
            <input type="text" name="ten_sp" value="<?= $ten_sp ?>" required>

            <label>Đơn giá (VNĐ):</label>
            <input type="number" name="gia" value="<?= $gia ?>" required>

            <label>Số lượng:</label>
            <input type="number" name="so_luong" value="<?= $so_luong ?>" required>

            <label>Mô tả:</label>
            <textarea name="mo_ta" rows="2"><?= $mo_ta ?></textarea>

            <button type="submit" name="save"><?= $is_edit ? "Lưu thay đổi" : "Thêm mới" ?></button>
            <?php if ($is_edit): ?>
                <a href="index.php" class="btn cancel">Hủy</a>
            <?php endif; ?>
        </form>
    </div>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['ten_sp'] ?></td>
            <td><?= number_format($row['gia']) ?> đ</td>
            <td><?= $row['so_luong'] ?></td>
            <td><?= $row['mo_ta'] ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id'] ?>" class="btn edit">Sửa</a>
                <a href="index.php?delete=<?= $row['id'] ?>" class="btn delete" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

</body>
</html>