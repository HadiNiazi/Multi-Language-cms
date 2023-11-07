<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            [
                'code' => 'eng',
                'name' => 'English',
                'rtl'  => 0
            ],

            [
                'code' => 'ara',
                'name' => 'Arabic',
                'rtl'  => 1
            ],

            [
                'code' => 'kur',
                'name' => 'Kurdish-Badini',
                'rtl'  => 0
            ],

            [
                'code' => 'kur-2',
                'name' => 'Kurdish-Sorani',
                'rtl'  => 0
            ],

            [
                'code' => 'kur-3',
                'name' => 'Kurdish-Kurmanji',
                'rtl'  => 0
            ],

            [
                'code' => 'urd',
                'name' => 'Urdu',
                'rtl'  => 1
            ],

            [
                'code' => 'zho',
                'name' => 'Chinese-Mandarin',
                'rtl'  => 0
            ],

            [
                'code' => 'zho-2',
                'name' => 'Chinese-Cantonese',
                'rtl'  => 0
            ]
        ];

        foreach ($languages as $language) {
            Language::create([
                'code' => $language['code'],
                'name' => $language['name'],
                'rtl'  => $language['rtl']
            ]);
        }
    }
}
