# Full-Stack Web Portfolio 🚀

Bu proje, Haliç Üniversitesi Yazılım Mühendisliği bölümü Final ödevi kapsamında geliştirilmiş, dinamik verilere sahip profesyonel bir portfolyo web uygulamasıdır.

## 🛠 Kullanılan Teknolojiler
* **Frontend:** HTML5, CSS3 (Flexbox/Grid), JavaScript (ES6+).
* **Backend:** PHP.
* **Veritabanı:** MySQL.
* **Haberleşme:** Fetch API (AJAX).

## ✨ Özellikler
* **Dinamik Proje Listeleme:** Projeler veritabanından çekilir ve asenkron (sayfa yenilenmeden) yüklenir.
* **İletişim Formu:** Kullanıcı mesajları `mysqli_prepare` ile güvenli bir şekilde MySQL veritabanına kaydedilir.
* **Admin Paneli:** Şifre korumalı (Session tabanlı) panel üzerinden proje ekleme ve mesajları yönetme imkanı.
* **Güvenlik:** SQL Injection saldırılarına karşı Prepared Statements ve XSS engelleme yöntemleri kullanılmıştır.
* **Responsive Tasarım:** Tüm cihazlarla (Mobil/Tablet/Masaüstü) uyumlu arayüz.

## 📂 Kurulum
1. Bu depoyu klonlayın veya ZIP olarak indirin.
2. `portfolio_db.sql` dosyasını PHPMyAdmin üzerinden veritabanınıza içe aktarın (Import).
3. `db.php` dosyasındaki veritabanı bağlantı bilgilerini kendi yerel sunucunuza (XAMPP/Apache) göre düzenleyin.
4. Dosyaları sunucunuzun (htdocs veya /var/www/html) altına taşıyın.

## 🔑 Admin Girişi
Admin paneline erişmek için `login.php` sayfasını kullanabilirsiniz.
* **Kullanıcı Adı:** root
* **Şifre:** 1234
*(Not: Bu bilgiler test amaçlıdır.)*

## 👨‍💻 Geliştirici
**Enes Küçükkaya**  
Yazılım Mühendisliği 3. Sınıf Öğrencisi - Haliç Üniversitesi
