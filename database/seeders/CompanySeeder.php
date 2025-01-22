<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $companies = [
            "Nebula Nexus Inc.",       // Innovazione tecnologica futuristica
            "Velociti Dynamics Ltd.",  // Soluzioni veloci ed efficienti
            "Aurora Synergy Co.",      // Energia rinnovabile e sostenibilità
            "QuantumCraft Studios",    // Design e creatività avanzata
            "Ironclad Industries",     // Robustezza e affidabilità
            "EcoSphere Ventures",      // Impatto ecologico e innovazione
            "LuxeVista Holdings",      // Lusso e prestigio
            "NovaTrail Systems",       // Soluzioni per trasporti innovativi
            "Skyforge Enterprises",    // Ambizione e costruzioni futuristiche
            "PixelPeak Interactive",   // Tecnologia e intrattenimento digitale
        ];
        for ($i = 0; $i < 10; $i++) {
            $company=new Company();
            $company->name = $companies[$i];
            //$company->logo = 'https://via.placeholder.com/150';
            $company->VAT_number = $faker->numerify('###########');
            $company->save();
        }
    }
}
