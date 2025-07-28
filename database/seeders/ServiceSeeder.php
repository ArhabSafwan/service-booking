<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'name' => 'Haircut',
                'description' => 'Professional haircut by our expert stylists.',
                'price' => 25.00,
                'status' => true,
            ],
            [
                'name' => 'Massage',
                'description' => 'Relaxing full-body massage session.',
                'price' => 50.00,
                'status' => true,
            ],
            [
                'name' => 'Facial',
                'description' => 'Deep-cleansing and rejuvenating facial.',
                'price' => 35.00,
                'status' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
