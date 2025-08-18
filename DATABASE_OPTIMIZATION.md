# Database Optimization Recommendations

## Recommended Database Indexes

Untuk meningkatkan performa query, tambahkan index berikut pada database:

### Tabel `jurnal`
```sql
-- Index untuk query berdasarkan giatId dan tanggal
CREATE INDEX idx_jurnal_giatid_tanggal ON jurnal(giatId, tanggal DESC);

-- Index untuk pencarian berdasarkan tanggal dan giatId (untuk validasi duplikasi)
CREATE INDEX idx_jurnal_tanggal_giatid ON jurnal(tanggal, giatId);

-- Index untuk created_at jika sering digunakan untuk sorting
CREATE INDEX idx_jurnal_created_at ON jurnal(created_at DESC);
```

### Tabel `trxtcm`
```sql
-- Index untuk join dengan tcm berdasarkan tcmId
CREATE INDEX idx_trxtcm_tcmid ON trxtcm(tcmId);

-- Index untuk query berdasarkan kegiatanId
CREATE INDEX idx_trxtcm_kegiatanid ON trxtcm(kegiatanId);

-- Composite index untuk query yang menggunakan kedua field
CREATE INDEX idx_trxtcm_kegiatan_tcm ON trxtcm(kegiatanId, tcmId);
```

### Tabel `kegiatan`
```sql
-- Index untuk join berdasarkan transferKeId
CREATE INDEX idx_kegiatan_transferkeid ON kegiatan(transferKeId);
```

## Query Performance Tips

1. **Gunakan LIMIT** pada query yang tidak memerlukan semua data
2. **Avoid SELECT *** - selalu specify kolom yang dibutuhkan
3. **Use prepared statements** untuk query yang sering dijalankan
4. **Monitor slow query log** untuk mengidentifikasi bottleneck

## Cache Strategy

- **Page cache**: 30 menit untuk halaman index
- **Query cache**: 1 jam untuk data yang jarang berubah
- **Clear cache**: Otomatis saat ada insert/update/delete

Implementasi ini akan meningkatkan performa aplikasi secara signifikan.
