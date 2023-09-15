<?php

namespace Database\Seeders;

use App\Models\Genders;
use Illuminate\Database\Seeder;

class Gender extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $arrayGenders = [
            ['name' => 'Misterio'],
            ['name' => 'Ciencia ficción'],
            ['name' => 'Romance'],
            ['name' => 'Drama'],
            ['name' => 'Aventura'],
            ['name' => 'Acción'],
            ['name' => 'Terror'],
            ['name' => 'Histórico'],
            ['name' => 'Biografía'],
            ['name' => 'Filosofía'],
            ['name' => 'Política'],
            ['name' => 'Negocios'],
            ['name' => 'Autoayuda']
        ];
        foreach ($arrayGenders as $gender) {
            Genders::create($gender);
        }
    }
}
