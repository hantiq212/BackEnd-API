<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Division;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        $divisions = [
            'Mobile Apps', 'QA', 'Full Stack',
            'Backend', 'Frontend', 'UI/UX Designer'
        ];

        foreach ($divisions as $division) {
            Division::create([
                'id' => Str::uuid(),
                'name' => $division,
            ]);
        }
    }
}
