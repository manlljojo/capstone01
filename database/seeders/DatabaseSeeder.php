<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Penyelenggara;
use App\Models\Pengguna;
use App\Models\Event;
use App\Models\Tiket;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Seed Admin
        $admin = Admin::create([
            'nama' => 'Administrator Konser Kita',
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'Super Admin',
        ]);

        // 2. Seed Penyelenggara
        $penyelenggara = Penyelenggara::create([
            'nama_organisasi' => 'Konser Kita Promoter',
            'email' => 'penyelenggara',
            'password' => Hash::make('penyelenggara'),
            'no_telp' => '08123456789',
            'alamat' => 'Jakarta Selatan',
        ]);

        // 3. Seed Pengguna (Peserta)
        $pengguna = Pengguna::create([
            'id_admin' => $admin->id_admin,
            'nama' => 'Reyner Peserta',
            'email' => 'peserta01',
            'password' => Hash::make('peserta'),
            'no_telp' => '08987654321',
            'tanggal_daftar' => now(),
        ]);

        // 4. Seed 21 Events (Diverse Indonesian Artists)
        $eventsData = [
            ['nama_event' => 'Juicy Luicy: Sentimental Tour - Bandung', 'harga' => 150000, 'tanggal_event' => '2026-06-15', 'lokasi' => 'Trans Studio Bandung', 'banner' => 'juicy_luicy.png', 'kapasitas' => 500],
            ['nama_event' => 'Hindia: Menari Dengan Bayangan - Jakarta', 'harga' => 175000, 'tanggal_event' => '2026-07-10', 'lokasi' => 'Basket Hall Senayan, Jakarta', 'banner' => 'hindia.png', 'kapasitas' => 700],
            ['nama_event' => 'Bernadya: Sialnya, Hidup Harus Berjalan - Jakarta', 'harga' => 200000, 'tanggal_event' => '2026-08-05', 'lokasi' => 'Teater Jakarta, TIM', 'banner' => 'bernadya.png', 'kapasitas' => 400],
            ['nama_event' => 'Tulus: Tur Manusia 2026 - Jakarta', 'harga' => 250000, 'tanggal_event' => '2026-09-20', 'lokasi' => 'JIExpo Kemayoran, Jakarta', 'banner' => 'tulus.png', 'kapasitas' => 2000],
            ['nama_event' => 'Dewa 19: Orchestra Celebration - Jakarta', 'harga' => 450000, 'tanggal_event' => '2026-10-15', 'lokasi' => 'Istora Senayan, Jakarta', 'banner' => 'dewa19.png', 'kapasitas' => 3000],
            ['nama_event' => 'Slank: 43 Tahun Berkarya - Jakarta', 'harga' => 125000, 'tanggal_event' => '2026-11-12', 'lokasi' => 'Stadion Utama GBK', 'banner' => 'slank.png', 'kapasitas' => 10000],
            ['nama_event' => 'Nadin Amizah: Konser Selamat Ulang Tahun', 'harga' => 225000, 'tanggal_event' => '2026-05-10', 'lokasi' => 'Gedung Kesenian Jakarta', 'banner' => 'nadin_amizah.png', 'kapasitas' => 400],
            ['nama_event' => 'Mahalini: Fabula 2.0 Tour', 'harga' => 185000, 'tanggal_event' => '2026-09-10', 'lokasi' => 'Bali Nusa Dua Convention Center', 'banner' => 'pesta_2026.jpg', 'kapasitas' => 2000],
            ['nama_event' => 'Pamungkas: Birdy South East Asia Tour', 'harga' => 195000, 'tanggal_event' => '2026-08-28', 'lokasi' => 'ICE BSD, Tangerang', 'banner' => 'sounds_2026.jpg', 'kapasitas' => 5000],
            ['nama_event' => 'HiVi!: Kereta Kencan Jilid 2', 'harga' => 145000, 'tanggal_event' => '2026-04-25', 'lokasi' => 'Sabuga ITB, Bandung', 'banner' => 'hivi.png', 'kapasitas' => 1500],
            ['nama_event' => 'Fourtwnty: Tur Nalar - Bali', 'harga' => 155000, 'tanggal_event' => '2026-05-30', 'lokasi' => 'Atlas Beach Club, Bali', 'banner' => 'fourtwnty.png', 'kapasitas' => 1000],
            ['nama_event' => 'Raisa: Live in Concert - Jakarta', 'harga' => 300000, 'tanggal_event' => '2026-06-20', 'lokasi' => 'Istora Senayan, Jakarta', 'banner' => 'raisa.jpg', 'kapasitas' => 5000],
            ['nama_event' => 'Isyana Sarasvati: Lexicon Experience', 'harga' => 275000, 'tanggal_event' => '2026-07-15', 'lokasi' => 'Teater Besar Jakarta', 'banner' => 'isyana.jpg', 'kapasitas' => 1200],
            ['nama_event' => 'Sheila On 7: Tunggu Aku di Jakarta', 'harga' => 350000, 'tanggal_event' => '2026-12-01', 'lokasi' => 'JIExpo Kemayoran', 'banner' => 'so7.jpg', 'kapasitas' => 15000],
            ['nama_event' => 'Noah: The Great Journey Tour', 'harga' => 400000, 'tanggal_event' => '2026-03-25', 'lokasi' => 'Ancol, Jakarta', 'banner' => 'noah.jpg', 'kapasitas' => 8000],
            ['nama_event' => 'Maliq & D\'Essentials: 20 Years Celebration', 'harga' => 180000, 'tanggal_event' => '2026-08-12', 'lokasi' => 'Senayan Park', 'banner' => 'maliq.jpg', 'kapasitas' => 4500],
            ['nama_event' => 'Yura Yunita: Pertunjukan Tutur Batin', 'harga' => 200000, 'tanggal_event' => '2026-05-20', 'lokasi' => 'Dago Tea House, Bandung', 'banner' => 'yura.jpg', 'kapasitas' => 800],
            ['nama_event' => 'Rizky Febian: Berona Day', 'harga' => 160000, 'tanggal_event' => '2026-09-05', 'lokasi' => 'Gedung Bale Dayang, Bandung', 'banner' => 'rizky_febian.jpg', 'kapasitas' => 1000],
            ['nama_event' => 'Reality Club: Present Midnight City', 'harga' => 140000, 'tanggal_event' => '2026-04-18', 'lokasi' => 'M Bloc Space, Jakarta', 'banner' => 'reality_club.jpg', 'kapasitas' => 600],
            ['nama_event' => 'Feast: Tur Membangun dan Menghancurkan 2.0', 'harga' => 135000, 'tanggal_event' => '2026-10-30', 'lokasi' => 'Sritex Arena, Solo', 'banner' => 'feast.jpg', 'kapasitas' => 2500],
            ['nama_event' => 'Perunggu: Live at Stadion Patriot', 'harga' => 120000, 'tanggal_event' => '2026-11-20', 'lokasi' => 'Bekasi', 'banner' => 'perunggu.jpg', 'kapasitas' => 3000],
        ];

        foreach ($eventsData as $e) {
            $event = Event::create([
                'id_penyelenggara' => $penyelenggara->id_penyelenggara,
                'id_admin' => $admin->id_admin,
                'nama_event' => $e['nama_event'],
                'deskripsi' => 'Nikmati pertunjukan musik luar biasa persembahan Konser Kita. Pastikan Anda hadir bersama orang tersayang dan rasakan euforia melodi yang menghanyutkan jiwa.',
                'tanggal_event' => $e['tanggal_event'],
                'lokasi' => $e['lokasi'],
                'status_event' => 'Aktif',
                'banner' => $e['banner'],
                'kategori' => 'Konser Musik',
                'kuota' => 100,
                'kapasitas' => $e['kapasitas'],
                'harga' => $e['harga'],
                'jam_operasional' => '19:00 - 22:00',
                'durasi' => '3 Jam',
                'faktor_pembatas' => 'Tiket fisik ditukar di venue mulai jam 10 pagi.',
            ]);

            Tiket::create([
                'id_event' => $event->id_event,
                'kategori_tiket' => 'Festival',
                'harga' => $e['harga'],
                'stok' => 100,
            ]);
        }
    }
}
