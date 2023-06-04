<?php

namespace Database\Seeders;

use App\Http\Enums\UserTypes;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Преподаватели
        $teachers = [
            [
                'name' => 'Иван Иванов',
                'email' => 'ivan.ivanov@example.com',
                'is_time_keeper' => false,
                'is_in_state' => true,
                'position_id' => 1,
                'user_type' => UserTypes::TEACHER_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Анна Смирнова',
                'email' => 'anna.smirnova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 6,
                'user_type' => UserTypes::TEACHER_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Петр Петров',
                'email' => 'petr.petrov@example.com',
                'is_time_keeper' => false,
                'is_in_state' => true,
                'position_id' => 7,
                'user_type' => UserTypes::TEACHER_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Мария Сидорова',
                'email' => 'maria.sidorova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 4,
                'user_type' => UserTypes::TEACHER_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Алексей Николаев',
                'email' => 'alexey.nikolaev@example.com',
                'is_time_keeper' => false,
                'is_in_state' => true,
                'position_id' => 5,
                'user_type' => UserTypes::TEACHER_TYPE->value,
                'password' => bcrypt('password'),
            ],
        ];

        // Бухгалтеры
        $accountants = [
            [
                'name' => 'Елена Смирнова',
                'email' => 'elena.smirnova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::ACCOUNTING_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Ольга Иванова',
                'email' => 'olga.ivanova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::ACCOUNTING_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Сергей Петров',
                'email' => 'sergey.petrov@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::ACCOUNTING_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Наталья Сидорова',
                'email' => 'natalya.sidorova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::ACCOUNTING_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Дмитрий Николаев',
                'email' => 'dmitry.nikolaev@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::ACCOUNTING_TYPE->value,
                'password' => bcrypt('password'),
            ],
        ];

        // Отдел кадров
        $hrPersonnel = [
            [
                'name' => 'Алия Абдыкадырова',
                'email' => 'aliya.abdykadyrova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::HR_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Андрей Смирнов',
                'email' => 'andrey.smirnov@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::HR_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Екатерина Иванова',
                'email' => 'ekaterina.ivanova@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::HR_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Илья Сидоров',
                'email' => 'ilya.sidorov@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'position_id' => 0,
                'user_type' => UserTypes::HR_TYPE->value,
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Ксения Николаева',
                'email' => 'ksenia.nikolaeva@example.com',
                'is_time_keeper' => false,
                'is_in_state' => false,
                'user_type' => UserTypes::HR_TYPE->value,
                'password' => bcrypt('password'),
            ],
        ];

        // Вставка данных преподавателей
        foreach ($teachers as $teacher) {
            User::createUser($teacher);
        }

        // Вставка данных бухгалтеров
        foreach ($accountants as $accountant) {
            User::createUser($accountant);
        }

        // Вставка данных отдела кадров
        foreach ($hrPersonnel as $hr) {
            User::createUser($hr);
        }
    }
}
