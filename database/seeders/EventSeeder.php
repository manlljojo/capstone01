<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::truncate();

        $events = [
            // JUICY LUICY
            [
                'nama_event' => 'Juicy Luicy: Sentimental Tour - Bandung', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Nikmati malam penuh emosi di kampung halaman Juicy Luicy.', 
                'tanggal' => '2026-06-15', 
                'lokasi' => 'Trans Studio Bandung', 
                'harga' => 350000, 
                'banner' => 'juicy_luicy.png',
                'kuota' => 100,
                'kapasitas' => 500,
                'jam_operasional' => '17:00 - 24:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Keamanan & Izin Kepolisian'
            ],
            [
                'nama_event' => 'Juicy Luicy: Sentimental Tour - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Konser intim bersama Juicy Luicy di ibu kota.', 
                'tanggal' => '2026-06-25', 
                'lokasi' => 'Tennis Indoor Senayan, Jakarta', 
                'harga' => 400000, 
                'banner' => 'juicy_luicy.png',
                'kuota' => 100,
                'kapasitas' => 800,
                'jam_operasional' => '18:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Batas Kapasitas Venue'
            ],
            
            // HINDIA
            [
                'nama_event' => 'Hindia: Menari Dengan Bayangan - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Narasi audio-visual mendalam dari Hindia.', 
                'tanggal' => '2026-07-10', 
                'lokasi' => 'Basket Hall Senayan, Jakarta', 
                'harga' => 450000, 
                'banner' => 'hindia.png',
                'kuota' => 100,
                'kapasitas' => 700,
                'jam_operasional' => '18:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Keamanan & Izin Kepolisian'
            ],
            [
                'nama_event' => 'Hindia: Menari Dengan Bayangan - Yogyakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Pertunjukan Hindia di kota budaya.', 
                'tanggal' => '2026-07-20', 
                'lokasi' => 'Jogja Expo Center', 
                'harga' => 300000, 
                'banner' => 'hindia.png',
                'kuota' => 100,
                'kapasitas' => 600,
                'jam_operasional' => '17:30 - 24:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Kapasitas Venue Maksimal'
            ],
            
            // BERNADYA
            [
                'nama_event' => 'Bernadya: Sialnya, Hidup Harus Berjalan - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Malam intim bersama Bernadya.', 
                'tanggal' => '2026-08-05', 
                'lokasi' => 'Teater Jakarta, TIM', 
                'harga' => 550000, 
                'banner' => 'bernadya.png',
                'kuota' => 100,
                'kapasitas' => 400,
                'jam_operasional' => '19:00 - 23:30 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Batas Waktu Operasional'
            ],
            [
                'nama_event' => 'Bernadya: Sialnya, Hidup Harus Berjalan - Surabaya', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Bernadya menyapa penggemar di Jawa Timur.', 
                'tanggal' => '2026-08-15', 
                'lokasi' => 'Dyandra Convention Center, Surabaya', 
                'harga' => 350000, 
                'banner' => 'bernadya.png',
                'kuota' => 100,
                'kapasitas' => 600,
                'jam_operasional' => '19:00 - 23:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Kapasitas Mal & Keamanan'
            ],
            
            // TULUS
            [
                'nama_event' => 'Tulus: Tur Manusia 2026 - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Rayakan kemanusiaan bersama Tulus dalam balutan musik megah.', 
                'tanggal' => '2026-09-20', 
                'lokasi' => 'JIExpo Kemayoran, Jakarta', 
                'harga' => 750000, 
                'banner' => 'tulus.png',
                'kuota' => 100,
                'kapasitas' => 2000,
                'jam_operasional' => '16:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Keamanan & Izin Kepolisian'
            ],
            [
                'nama_event' => 'Tulus: Tur Manusia 2026 - Medan', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Panggung Tulus di tanah Sumatera.', 
                'tanggal' => '2026-09-30', 
                'lokasi' => 'Pardede Hall, Medan', 
                'harga' => 450000, 
                'banner' => 'tulus.png',
                'kuota' => 100,
                'kapasitas' => 1200,
                'jam_operasional' => '18:00 - 24:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Izin Keramaian Daerah'
            ],
            
            // DEWA 19
            [
                'nama_event' => 'Dewa 19: Orchestra Celebration - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Lagu legendaris Dewa 19 dengan iringan orkestra megah.', 
                'tanggal' => '2026-10-15', 
                'lokasi' => 'Istora Senayan, Jakarta', 
                'harga' => 1250000, 
                'banner' => 'dewa19.png',
                'kuota' => 100,
                'kapasitas' => 3000,
                'jam_operasional' => '19:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Kapasitas Eksklusif Venue'
            ],
            [
                'nama_event' => 'Dewa 19: 30 Years Anniversary - Solo', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Perayaan 3 dekade Dewa 19 di Edutorium Solo.', 
                'tanggal' => '2026-10-25', 
                'lokasi' => 'Edutorium UMS, Solo', 
                'harga' => 600000, 
                'banner' => 'dewa19.png',
                'kuota' => 100,
                'kapasitas' => 2500,
                'jam_operasional' => '18:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Izin Kepolisian & Keamanan'
            ],
            
            // SLANK
            [
                'nama_event' => 'Slank: 43 Tahun Berkarya - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Energi rock n roll yang tak pernah padam di GBK.', 
                'tanggal' => '2026-11-12', 
                'lokasi' => 'Stadion Utama GBK', 
                'harga' => 250000, 
                'banner' => 'slank.png',
                'kuota' => 100,
                'kapasitas' => 10000,
                'jam_operasional' => '17:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Batas Keamanan Stadion'
            ],
            [
                'nama_event' => 'Slank: Tur Sumatera - Palembang', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Aksi panggung legendaris Slank di Palembang.', 
                'tanggal' => '2026-11-20', 
                'lokasi' => 'Stadion Gelora Sriwijaya', 
                'harga' => 150000, 
                'banner' => 'slank.png',
                'kuota' => 100,
                'kapasitas' => 3000,
                'jam_operasional' => '19:00 - 24:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Izin Keramaian Daerah'
            ],
            
            // PAYUNG TEDUH
            [
                'nama_event' => 'Payung Teduh: Reuni Syahdu - Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Nostalgia di bawah langit kota bersama Payung Teduh.', 
                'tanggal' => '2026-12-20', 
                'lokasi' => 'Hutan Kota by GBK', 
                'harga' => 400000, 
                'banner' => 'synch_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 500,
                'jam_operasional' => '17:00 - 22:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Batas Waktu Area Terbuka'
            ],
            [
                'nama_event' => 'Payung Teduh: Live at Jazz Gunung Bromo', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Nada syahdu di ketinggian Bromo.', 
                'tanggal' => '2027-01-05', 
                'lokasi' => 'Jiwa Jawa Resort, Bromo', 
                'harga' => 850000, 
                'banner' => 'synch_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 300,
                'jam_operasional' => '16:00 - 21:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Amfiteater Terbatas'
            ],
            
            // NEW ARTISTS
            [
                'nama_event' => 'Sheila on 7: Tunggu Aku di Jakarta', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Salah satu konser yang paling ditunggu di tahun ini.', 
                'tanggal' => '2027-02-14', 
                'lokasi' => 'Stadion Utama GBK', 
                'harga' => 650000, 
                'banner' => 'pesta_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 15000,
                'jam_operasional' => '17:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Batas Kapasitas Stadion'
            ],
            [
                'nama_event' => 'Nadin Amizah: Konser Selamat Ulang Tahun', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Pertunjukan teatrikal dan musik yang menyentuh jiwa.', 
                'tanggal' => '2026-05-10', 
                'lokasi' => 'Gedung Kesenian Jakarta', 
                'harga' => 500000, 
                'banner' => 'intim_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 400,
                'jam_operasional' => '19:30 - 22:30 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Kapasitas Gedung Kesenian'
            ],
            [
                'nama_event' => 'Reality Club: Present Midnight Show', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Aksi panggung enerjik dari Reality Club.', 
                'tanggal' => '2027-03-21', 
                'lokasi' => 'M Bloc Live House, Jakarta', 
                'harga' => 350000, 
                'banner' => 'sounds_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 500,
                'jam_operasional' => '20:00 - 24:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Batas Waktu Operasional'
            ],
            [
                'nama_event' => 'Feast: Tur Membangun dan Menghancurkan', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Distorsi penuh makna dari Feast.', 
                'tanggal' => '2026-12-05', 
                'lokasi' => 'Ecopark Ancol, Jakarta', 
                'harga' => 300000, 
                'banner' => 'joyland_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 3000,
                'jam_operasional' => '18:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Keamanan Area Terbuka'
            ],
            [
                'nama_event' => 'Lyodra: Home Coming Concert', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Suara emas Lyodra kembali ke tanah kelahiran.', 
                'tanggal' => '2027-01-15', 
                'lokasi' => 'Medan International Convention Center', 
                'harga' => 550000, 
                'banner' => 'intim_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 1500,
                'jam_operasional' => '19:00 - 23:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Izin Keramaian Medan'
            ],
            [
                'nama_event' => 'Mahalini: Fabula 2.0 Tour', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Drama musikal dan pop ballad dari Mahalini.', 
                'tanggal' => '2026-09-10', 
                'lokasi' => 'Bali Nusa Dua Convention Center', 
                'harga' => 450000, 
                'banner' => 'pesta_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 2000,
                'jam_operasional' => '19:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Protokol Wisata Bali'
            ],
            [
                'nama_event' => 'Pamungkas: Birdy South East Asia Tour', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Pamungkas membawa tur Asia-nya ke Jakarta.', 
                'tanggal' => '2026-08-28', 
                'lokasi' => 'ICE BSD, Tangerang', 
                'harga' => 700000, 
                'banner' => 'sounds_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 5000,
                'jam_operasional' => '16:00 - 24:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Kapasitas Gedung ICE BSD'
            ],
            [
                'nama_event' => 'HiVi!: Kereta Kencan Jilid 2', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Keceriaan pop HiVi! menyapa Bandung kembali.', 
                'tanggal' => '2026-04-25', 
                'lokasi' => 'Sabuga ITB, Bandung', 
                'harga' => 150000, 
                'banner' => 'joyland_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 1500,
                'jam_operasional' => '18:00 - 22:00 WIB',
                'durasi' => '2 Jam',
                'faktor_pembatas' => 'Izin Kampus ITB'
            ],
            [
                'nama_event' => 'Fourtwnty: Tur Nalar - Bali', 
                'kategori' => 'Konser Musik', 
                'deskripsi' => 'Malam santai di tepi pantai bersama Fourtwnty.', 
                'tanggal' => '2026-05-30', 
                'lokasi' => 'Atlas Beach Club, Bali', 
                'harga' => 300000, 
                'banner' => 'pesta_2026.jpg',
                'kuota' => 100,
                'kapasitas' => 1000,
                'jam_operasional' => '17:00 - 23:00 WIB',
                'durasi' => '2.5 Jam',
                'faktor_pembatas' => 'Batas Waktu Beach Club'
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
