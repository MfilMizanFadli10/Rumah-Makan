<?php

namespace Database\Seeders;

use App\Models\Pengaturan;
use Illuminate\Database\Seeder;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        Pengaturan::create([
            'nama_rumah_makan' => 'Rumah Makan Kami',
            'alamat' => 'Jl. Khatib Sulaiman No.99, Ulak Karang Sel., Kec. Padang Utara, Kota Padang, Sumatera Barat',
            'jam_operasional' => '10:00 - 22:00 WIB',
            'no_hp' => '08123456789',
            'email' => 'contact@rumahmakan.com',
            'tagline' => 'Pesan makanan favoritmu sebelum datang dan reservasi meja dengan mudah.',
            'maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3303.65267445494!2d100.353364!3d-0.9087972!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4b8b5975bebe7%3A0x3b09504b350ef40a!2s38RX%2B3V2%2C%20Jl.%20Khatib%20Sulaiman%20No.99%2C%20Ulak%20Karang%20Sel.%2C%20Kec.%20Padang%20Utara%2C%20Kota%20Padang%2C%20Sumatera%20Barat!5e1!3m2!1sid!2sid!4v1788338768831!5m2!1sid!2sid',
            'whatsapp' => '628123456789',
        ]);
    }
}
