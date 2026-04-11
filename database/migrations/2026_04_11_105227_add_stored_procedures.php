<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Procedure Konfirmasi Pembayaran
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_KonfirmasiPembayaran");
        DB::unprepared("
            CREATE PROCEDURE sp_KonfirmasiPembayaran(IN p_id INT)
            BEGIN
                UPDATE peserta SET status_pembayaran = 'Lunas' WHERE id = p_id;
            END
        ");

        // 2. Procedure Check-in Peserta (Hanya jika lunas)
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_CheckInPeserta");
        DB::unprepared("
            CREATE PROCEDURE sp_CheckInPeserta(IN p_tiket_id VARCHAR(255))
            BEGIN
                UPDATE peserta SET check_in = 'Sudah' 
                WHERE tiket_id = p_tiket_id AND status_pembayaran = 'Lunas';
            END
        ");

        // 3. Procedure Ringkasan Event (Revenue & Terjual)
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetRingkasanEvent");
        DB::unprepared("
            CREATE PROCEDURE sp_GetRingkasanEvent()
            BEGIN
                SELECT e.id, e.nama_event, e.kategori, 
                       COUNT(p.id) as tiket_terjual, 
                       SUM(CASE WHEN p.status_pembayaran = 'Lunas' THEN p.total_bayar ELSE 0 END) as total_revenue
                FROM events e
                LEFT JOIN peserta p ON e.id = p.event_id
                GROUP BY e.id;
            END
        ");

        // 4. Procedure Hapus Peserta Pending (Cleanup)
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_HapusPesertaPending");
        DB::unprepared("
            CREATE PROCEDURE sp_HapusPesertaPending(IN p_hours INT)
            BEGIN
                DELETE FROM peserta 
                WHERE status_pembayaran = 'Pending' 
                AND created_at < NOW() - INTERVAL p_hours HOUR;
            END
        ");

        // 5. Procedure Update Harga per Kategori
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_UpdateHargaKategori");
        DB::unprepared("
            CREATE PROCEDURE sp_UpdateHargaKategori(IN p_kategori VARCHAR(100), IN p_harga_baru INT)
            BEGIN
                UPDATE events SET harga = p_harga_baru WHERE kategori = p_kategori;
            END
        ");

        // 6. Procedure Get Detail Peserta (Scanner Ready)
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetDetailPesertaByTiket");
        DB::unprepared("
            CREATE PROCEDURE sp_GetDetailPesertaByTiket(IN p_tiket_id VARCHAR(255))
            BEGIN
                SELECT p.*, e.nama_event, e.tanggal, e.lokasi
                FROM peserta p
                JOIN events e ON p.event_id = e.id
                WHERE p.tiket_id = p_tiket_id;
            END
        ");

        // 7. Procedure Statistik Dashboard Utama
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetStatistikDashboard");
        DB::unprepared("
            CREATE PROCEDURE sp_GetStatistikDashboard()
            BEGIN
                SELECT 
                    (SELECT SUM(total_bayar) FROM peserta WHERE status_pembayaran = 'Lunas') as global_revenue,
                    (SELECT COUNT(*) FROM peserta WHERE status_pembayaran = 'Lunas') as total_penonton_lunas,
                    (SELECT COUNT(*) FROM events) as total_event_aktif;
            END
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_KonfirmasiPembayaran");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_CheckInPeserta");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetRingkasanEvent");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_HapusPesertaPending");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_UpdateHargaKategori");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetDetailPesertaByTiket");
        DB::unprepared("DROP PROCEDURE IF EXISTS sp_GetStatistikDashboard");
    }
};
