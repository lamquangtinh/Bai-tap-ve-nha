<?php

function formatMoney($amount) {
    return number_format($amount) . " VNĐ";
}

function calculateLineTotal($product) {
    return $product['price'] * $product['quantity'];
}

function calculateSubtotal($products) {
    $tong = 0;
    foreach ($products as $sp) {
        $tong += calculateLineTotal($sp);
    }
    return $tong;
}

function calculateDiscount($subtotal) {
    if ($subtotal >= 100000) {
        return $subtotal * 0.1;
    }
    return 0;
}

function printProductList($products) {
    echo "===== DANH SÁCH SẢN PHẨM =====\n\n";
    foreach ($products as $sp) {
        echo $sp['name'] . " - " . formatMoney($sp['price']) . " x " . $sp['quantity'] . " = " . formatMoney(calculateLineTotal($sp)) . "\n";
    }
}

function printSummary($products) {
    $subtotal = calculateSubtotal($products);
    $discount = calculateDiscount($subtotal);
    $payment = $subtotal - $discount;

    echo "\n";
    echo "Tạm tính: " . formatMoney($subtotal) . "\n";
    echo "Giảm giá: " . formatMoney($discount) . "\n";
    echo "Thanh toán: " . formatMoney($payment) . "\n";
}

$products = [
    ["name" => "Kẹo Dẻo", "price" => 45000, "quantity" => 5],
    ["name" => "Bánh Chocopai", "price" => 43000, "quantity" => 2],
    ["name" => "Bánh Trứng", "price" => 50000, "quantity" => 3]
];

printProductList($products);
printSummary($products);
?>