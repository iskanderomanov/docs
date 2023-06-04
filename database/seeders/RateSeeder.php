<?php

namespace Database\Seeders;

use App\Http\Enums\UserTypes;
use App\Models\Rate;
use App\Models\User;
use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teachers = User::where('user_type', UserTypes::TEACHER_TYPE->value)->where('is_in_state', true)->get();

        foreach ($teachers as $teacher) {
            $rate = 1;
            Rate::create([
                'user_id' => $teacher->id,
                'rate' => $rate,
                'rate_type' => 1,
            ]);
        }

        foreach ($teachers as $key => $teacher) {
            if($key % 2 === 0) {
                $rate = rand(0.1, 0.95);
                Rate::create([
                    'user_id' => $teacher->id,
                    'rate' => $rate,
                    'rate_type' => 2,
                ]);
            }
        }
        $teachers = User::where('user_type', UserTypes::TEACHER_TYPE->value)->where('is_in_state', false)->get();

        foreach ($teachers as $teacher) {
            $rate = rand(0.1, 0.95);
            Rate::create([
                'user_id' => $teacher->id,
                'rate' => $rate,
                'rate_type' => 3,
            ]);
        }
    }
}
