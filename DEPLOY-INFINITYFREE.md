# Deploy DataCenterPro ke InfinityFree

## Langkah 1: Daftar InfinityFree
1. Buka https://infinityfree.com
2. Klik **Sign Up**
3. Isi email & password, lalu verifikasi email
4. Login ke InfinityFree

## Langkah 2: Buat Hosting Account
1. Di dashboard, klik **Create Account**
2. Pilih domain: `datacenterpro` → pilih extension (misal `.infinityfreeapp.com`)
3. Buat **database** di panel (MySQL)
4. Catat:
   - DB Host: `sql.infinityfree.com`
   - DB Name: `youruser_datacenterpro` (format: `usernamee_name`)
   - DB User: `youruser`
   - DB Password: (yang dibuat)

## Langkah 3: Upload File
1. Buka **File Manager** di panel InfinityFree
2. Buka folder `htdocs`
3. Upload file **`dcpro-infinityfree.zip`**
4. Extract zip di folder `htdocs`
5. Pindahkan isi folder ke root `htdocs` (bukan di subfolder)

## Langkah 4: Setup Database
1. Buka **phpMyAdmin** di panel InfinityFree
2. Pilih database yang sudah dibuat
3. Klik tab **SQL**
4. Paste isi file `database/infinityfree-schema.sql`
5. Klik **Go** / **Execute**

## Langkah 5: Edit File .env
1. Buka File Manager
2. Edit file `.env` di root `htdocs`
3. Ganti placeholder dengan data sebenarnya:

```
APP_URL=http://datacenterpro.infinityfreeapp.com
DB_DATABASE=youruser_datacenterpro
DB_USERNAME=youruser
DB_PASSWORD=your_db_password
```

## Langkah 6: Generate APP_KEY
1. Buka **Terminal** di panel (atau gunakan online generator)
2. Salin key: https://generate-random.org/encryption-key-generator?count=1&bits=256&characters=base64
3. Edit `.env`, ganti `APP_KEY=` dengan `APP_KEY=base64:xxx...`

## Langkah 7: Test Website
1. Buka browser: `http://datacenterpro.infinityfreeapp.com`
2. Login admin: `admin@datacenterpro.com` / `password`

---

## Troubleshooting
- **500 Error**: Cek file `.env` sudah benar
- **Database Error**: Pastikan nama DB format `user_name` (pakai underscore)
- **White Screen**: Aktifkan `APP_DEBUG=true` di `.env` untuk lihat error
