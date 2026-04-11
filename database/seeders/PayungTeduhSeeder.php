<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PayungTeduhSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Event::truncate();

        $events = [
            // Jabodetabek
            ['nama_event' => 'Synchronize Fest 2026', 'tanggal' => '2026-10-05', 'lokasi' => 'Gambir Expo Kemayoran, Jakarta', 'harga' => 450000, 'banner' => 'https://images.weserv.nl/?url=img.okeinfo.net/content/2016/11/04/205/1533036/payung-teduh-suguhkan-harmonisasi-folk-dan-jazz-di-itb-R4lYpM6XmG.jpg'],
            ['nama_event' => 'Pesta Pora 2026', 'tanggal' => '2026-09-22', 'lokasi' => 'JIExpo Kemayoran, Jakarta', 'harga' => 350000, 'banner' => 'https://images.weserv.nl/?url=asset.kompas.com/crops/Yt-fXREo_K9Y9X0T0Q0W5A6O0W4=/0x0:0x0/750x500/data/photo/2017/12/31/4054452125.jpg'],
            ['nama_event' => 'Joyland Festival 2026', 'tanggal' => '2026-11-24', 'lokasi' => 'Gelora Bung Karno, Jakarta', 'harga' => 500000, 'banner' => 'https://images.weserv.nl/?url=awsimages.detik.net.id/community/media/visual/2017/11/17/5c7b398a-2e7a-4c28-bb8d-56a8d7a17a78_169.jpg?w=700&q=90'],
            ['nama_event' => 'The Sounds Project Vol. 9', 'tanggal' => '2026-08-11', 'lokasi' => 'Eco Park Ancol, Jakarta', 'harga' => 250000, 'banner' => 'https://images.weserv.nl/?url=akcdn.detik.net.id/community/media/visual/2022/10/31/payung-teduh_169.jpeg?w=700&q=90'],
            
            // West & Central Java
            ['nama_event' => 'Konser Intim: Bandung', 'tanggal' => '2026-12-15', 'lokasi' => 'Sabuga ITB, Bandung', 'harga' => 200000, 'banner' => 'https://images.weserv.nl/?url=asset.kompas.com/crops/9_lJk9J6W9_P9C7W6D5h7o5Q5Y=/0x0:0x0/750x500/data/photo/2022/11/25/63806be6897f7.jpg'],
            ['nama_event' => 'Lokananta Live Sessions', 'tanggal' => '2026-05-20', 'lokasi' => 'Studio Lokananta, Solo', 'harga' => 150000, 'banner' => 'https://images.weserv.nl/?url=akcdn.detik.net.id/community/media/visual/2018/12/03/60a2b7f0-264d-4ba6-8a30-01c6f5f9f44b_169.jpeg?w=700&q=90'],
            ['nama_event' => 'Prambanan Jazz 2026', 'tanggal' => '2026-07-05', 'lokasi' => 'Candi Prambanan, Yogyakarta', 'harga' => 550000, 'banner' => 'https://images.weserv.nl/?url=img.okeinfo.net/content/2016/11/04/205/1533036/payung-teduh-suguhkan-harmonisasi-folk-dan-jazz-di-itb-R4lYpM6XmG.jpg'],
            
            // East Java & Bali
            ['nama_event' => 'Folk Music Festival 2026', 'tanggal' => '2026-08-10', 'lokasi' => 'Batu, Malang', 'harga' => 150000, 'banner' => 'https://images.weserv.nl/?url=akcdn.detik.net.id/community/media/visual/2017/04/18/d5a8b5e6-6e4b-4a5b-b5a8-5a8b5a8b5a8b_169.jpg?w=700&q=90'],
            ['nama_event' => 'Bali Countdown 2027', 'tanggal' => '2026-12-31', 'lokasi' => 'GWK Cultural Park, Bali', 'harga' => 750000, 'banner' => 'https://images.weserv.nl/?url=asset.kompas.com/crops/Yt-fXREo_K9Y9X0T0Q0W5A6O0W4=/0x0:0x0/750x500/data/photo/2017/12/31/4054452125.jpg'],
            ['nama_event' => 'Jazz Gunung Bromo 2026', 'tanggal' => '2026-07-26', 'lokasi' => 'Amfiteater Jiwa Jawa, Bromo', 'harga' => 800000, 'banner' => 'https://images.weserv.nl/?url=awsimages.detik.net.id/community/media/visual/2017/11/17/5c7b398a-2e7a-4c28-bb8d-56a8d7a17a78_169.jpg?w=700&q=90'],
            
            // Sumatra & Others
            ['nama_event' => 'Sumatera Tour: Medan', 'tanggal' => '2026-05-14', 'lokasi' => 'Lapangan Merdeka, Medan', 'harga' => 175000, 'banner' => 'https://images.weserv.nl/?url=akcdn.detik.net.id/community/media/visual/2022/10/31/payung-teduh_169.jpeg?w=700&q=90'],
            ['nama_event' => 'Sumatera Tour: Palembang', 'tanggal' => '2026-05-18', 'lokasi' => 'Stadion Gelora Sriwijaya, Palembang', 'harga' => 160000, 'banner' => 'https://images.weserv.nl/?url=akcdn.detik.net.id/community/media/visual/2018/12/03/60a2b7f0-264d-4ba6-8a30-01c6f5f9f44b_169.jpeg?w=700&q=90'],
            ['nama_event' => 'Makassar Jazz Festival', 'tanggal' => '2026-03-10', 'lokasi' => 'Benteng Rotterdam, Makassar', 'harga' => 200000, 'banner' => 'https://images.weserv.nl/?url=img.okeinfo.net/content/2016/11/04/205/1533036/payung-teduh-suguhkan-harmonisasi-folk-dan-jazz-di-itb-R4lYpM6XmG.jpg'],
            ['nama_event' => 'Borneo Folk Fest', 'tanggal' => '2026-04-05', 'lokasi' => 'Lapangan Murjani, Banjarbaru', 'harga' => 125000, 'banner' => 'https://images.weserv.nl/?url=asset.kompas.com/crops/9_lJk9J6W9_P9C7W6D5h7o5Q5Y=/0x0:0x0/750x500/data/photo/2022/11/25/63806be6897f7.jpg'],
            ['nama_event' => 'Closing Ceremony Tour', 'tanggal' => '2026-12-20', 'lokasi' => 'Istora Senayan, Jakarta', 'harga' => 600000, 'banner' => 'https://images.weserv.nl/?url=akcdn.detik.net.id/community/media/visual/2017/04/18/d5a8b5e6-6e4b-4a5b-b5a8-5a8b5a8b5a8b_169.jpg?w=700&q=90'],
        ];

        foreach($events as $event) {
            \App\Models\Event::create([
                'nama_event' => $event['nama_event'],
                'kategori' => 'Konser Musik',
                'deskripsi' => 'Nikmati penampilan syahdu Payung Teduh dalam balutan melodi yang memikat hati. Segera amankan tiket Anda secara eksklusif hanya untuk member TeduhTicket.',
                'tanggal' => $event['tanggal'],
                'lokasi' => $event['lokasi'],
                'harga' => $event['harga'],
                'banner' => $event['banner']
            ]);
        }
    }
}
