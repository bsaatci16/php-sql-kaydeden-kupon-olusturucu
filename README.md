# php-sql-kaydeden-kupon-olusturucu
PHP ile oluşturduğunuz STEAM- başlıklı kodları otomatik SQL'e kaydedebilirsiniz.

İlk olarak, veritabanı bağlantısı için bir config.php dosyası oluşturun ve veritabanı bilgilerinizi içine ekleyin:

<?php
$dbHost = "localhost";
$dbUser = "kullanici_adi";
$dbPass = "parola";
$dbName = "veritabani_adi";

// Veritabanı bağlantısı oluştur
$conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

// Bağlantı hatası kontrolü
if ($conn->connect_error) {
    die("Veritabanı bağlantısı başarısız: " . $conn->connect_error);
}
?>

Ardından, coupon_generator.php adında bir dosya oluşturun ve aşağıdaki kodu içine ekleyin:

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

Bu kod, "STEAM-" ile başlayan bir kupon kodu oluşturur ve bu kodu SQL veritabanına kaydeder. generateCouponCode() fonksiyonu, belirtilen uzunlukta rastgele bir kupon kodu oluşturmak için kullanılır.

3. Daha sonra, coupons adında bir tablo oluşturun ve sadece code sütununu içerecek şekilde tasarlayın:

CREATE TABLE coupons (
  id INT PRIMARY KEY AUTO_INCREMENT,
  code VARCHAR(20)
);


Artık coupon_generator.php dosyasını bir web tarayıcısında çalıştırarak her seferinde yeni bir "STEAM-" ile başlayan kupon kodu oluşturabilirsiniz. Bu kupon kodu otomatik olarak SQL veritabanına kaydedilecektir.
