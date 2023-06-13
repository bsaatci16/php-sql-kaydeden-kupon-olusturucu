<?php
// Veritabanı bağlantısı
require_once 'config.php';

// Kupon kodu oluşturma
$couponCode = "STEAM-" . generateCouponCode();

// Kupon kodunu SQL veritabanına kaydetme
$sql = "INSERT INTO coupons (code) VALUES ('$couponCode')";
if ($conn->query($sql) === TRUE) {
    echo "Yeni kupon kodu oluşturuldu: $couponCode";
} else {
    echo "Kupon kodu oluşturulurken bir hata oluştu: " . $conn->error;
}

// Veritabanı bağlantısını kapat
$conn->close();

// Rastgele kupon kodu oluşturma fonksiyonu
function generateCouponCode() {
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $length = 8;
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $code;
}
?>
