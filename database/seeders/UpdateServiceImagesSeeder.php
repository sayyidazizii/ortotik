<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\MedicalService;

class UpdateServiceImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $p = MedicalService::where('slug', 'prosthetics')->first();
        if ($p) {
            $p->thumbnail = 'images/client_update/image3.png';
            $p->gallery_images = ['images/client_update/image1.png', 'images/client_update/image5.png'];
            $p->save();
        }

        $b = MedicalService::where('slug', 'like', '%bracing%')->first();
        if ($b) {
            $b->thumbnail = 'images/client_update/image7.png';
            $b->gallery_images = ['images/client_update/image4.png', 'images/client_update/image2.png'];
            $b->save();
        }

        $s = MedicalService::where('slug', 'scoliosis-center')->first();
        if ($s) {
            $s->thumbnail = 'images/client_update/image6.png';
            $s->gallery_images = ['images/client_update/image2.png', 'images/client_update/image4.png'];
            $s->save();
        }

        $phy = MedicalService::where('slug', 'physiotherapy')->first();
        if ($phy) {
            $phy->thumbnail = 'images/client_update/image5.png';
            $phy->gallery_images = ['images/client_update/image1.png', 'images/client_update/image7.png'];
            $phy->save();
        }

        $neu = MedicalService::where('slug', 'neuro-robotic')->first();
        if (!$neu) {
            MedicalService::create([
                'title' => 'Neuro Robotic Rehabilitation',
                'slug' => 'neuro-robotic',
                'summary' => 'Terapi pemulihan neuro-motorik canggih berbasis robotik eksoskeleton dan sensor biofeedback untuk pasien stroke & cedera saraf medula spinalis.',
                'content' => '<h3>Teknologi Rehabilitasi Robotik Modern</h3><p>Kombinasi robotik eksoskeleton terkomputerisasi membantu menstimulasi jalur saraf motorik otak pasien secara repetitif, presisi, dan terukur.</p>',
                'thumbnail' => 'images/client_update/image4.png',
                'gallery_images' => ['images/client_update/image3.png', 'images/client_update/image6.png'],
                'icon_name' => 'cpu',
                'order_position' => 5,
                'is_active' => true,
            ]);
        }
    }
}
