<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        // Universities
        $uni1 = (string) Str::uuid();
        $uni2 = (string) Str::uuid();
        $uni3 = (string) Str::uuid();

        DB::table('universities')->insert([
            ['id' => $uni1, 'name' => 'Tashkent State Technical University', 'admin_id' => Str::uuid(), 'location' => 'Tashkent, Uzbekistan', 'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['id' => $uni2, 'name' => 'Westminster International University', 'admin_id' => Str::uuid(), 'location' => 'Tashkent, Uzbekistan', 'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['id' => $uni3, 'name' => 'Turin Polytechnic University',         'admin_id' => Str::uuid(), 'location' => 'Tashkent, Uzbekistan', 'is_active' => false, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Users
        $u1 = (string) Str::uuid(); $u2 = (string) Str::uuid(); $u3 = (string) Str::uuid();
        $u4 = (string) Str::uuid(); $u5 = (string) Str::uuid();
        $ut1 = (string) Str::uuid(); $ut2 = (string) Str::uuid();
        $ue1 = (string) Str::uuid(); $ue2 = (string) Str::uuid();
        $usa = (string) Str::uuid();

        DB::table('users')->insert([
            ['user_id' => $u1,  'role' => 'student',     'email' => 'ali.karimov@student.com',     'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $u2,  'role' => 'student',     'email' => 'malika.yusupova@student.com', 'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $u3,  'role' => 'student',     'email' => 'bobur.rashidov@student.com',  'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $u4,  'role' => 'student',     'email' => 'dilnoza.tosheva@student.com', 'is_active' => false, 'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $u5,  'role' => 'student',     'email' => 'jasur.nazarov@student.com',   'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $ut1, 'role' => 'teacher',     'email' => 'prof.ismoilov@university.com','is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $ut2, 'role' => 'teacher',     'email' => 'dr.hamidova@university.com',  'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $ue1, 'role' => 'employer',    'email' => 'hr@uzinnotech.com',            'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $ue2, 'role' => 'employer',    'email' => 'jobs@epam.com',                'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
            ['user_id' => $usa, 'role' => 'super_admin', 'email' => 'admin@candid.com',             'is_active' => true,  'created_at' => $now, 'updated_at' => $now],
        ]);

        // Students
        $s1 = (string) Str::uuid(); $s2 = (string) Str::uuid(); $s3 = (string) Str::uuid();
        $s4 = (string) Str::uuid(); $s5 = (string) Str::uuid();

        DB::table('student')->insert([
            ['student_id' => $s1, 'user_id' => $u1, 'university_id' => $uni1, 'first_name' => 'Ali',     'last_name' => 'Karimov',  'email' => 'ali.karimov@student.com',     'created_at' => $now, 'updated_at' => $now],
            ['student_id' => $s2, 'user_id' => $u2, 'university_id' => $uni1, 'first_name' => 'Malika',  'last_name' => 'Yusupova', 'email' => 'malika.yusupova@student.com', 'created_at' => $now, 'updated_at' => $now],
            ['student_id' => $s3, 'user_id' => $u3, 'university_id' => $uni2, 'first_name' => 'Bobur',   'last_name' => 'Rashidov', 'email' => 'bobur.rashidov@student.com',  'created_at' => $now, 'updated_at' => $now],
            ['student_id' => $s4, 'user_id' => $u4, 'university_id' => $uni2, 'first_name' => 'Dilnoza', 'last_name' => 'Tosheva',  'email' => 'dilnoza.tosheva@student.com', 'created_at' => $now, 'updated_at' => $now],
            ['student_id' => $s5, 'user_id' => $u5, 'university_id' => $uni3, 'first_name' => 'Jasur',   'last_name' => 'Nazarov',  'email' => 'jasur.nazarov@student.com',   'created_at' => $now, 'updated_at' => $now],
        ]);

        // Teachers
        $t1 = (string) Str::uuid(); $t2 = (string) Str::uuid();

        DB::table('teachers')->insert([
            ['teacher_id' => $t1, 'user_id' => $ut1, 'university_id' => $uni1, 'name' => 'Prof. Ismoilov Behruz', 'email' => 'prof.ismoilov@university.com', 'specialty' => 'Computer Science',    'is_verified' => true,  'created_at' => $now, 'updated_at' => $now],
            ['teacher_id' => $t2, 'user_id' => $ut2, 'university_id' => $uni2, 'name' => 'Dr. Hamidova Nodira',  'email' => 'dr.hamidova@university.com',  'specialty' => 'Software Engineering', 'is_verified' => false, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Employers
        $e1 = (string) Str::uuid(); $e2 = (string) Str::uuid();

        DB::table('employers')->insert([
            ['id' => $e1, 'name' => 'Sherzod Nazarov', 'email' => 'hr@uzinnotech.com',  'company' => 'UzInnoTech',     'password' => bcrypt('password'), 'created_at' => $now, 'updated_at' => $now],
            ['id' => $e2, 'name' => 'Kamola Mirzaeva', 'email' => 'jobs@epam.com',      'company' => 'EPAM Uzbekistan','password' => bcrypt('password'), 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Projects
        $p1 = (string) Str::uuid(); $p2 = (string) Str::uuid(); $p3 = (string) Str::uuid();

        DB::table('projects')->insert([
            ['id' => $p1, 'title' => 'AI-based Student Performance Tracker', 'description' => 'A machine learning system to predict student academic performance.', 'student_id' => $s1, 'teacher_id' => $t1, 'university_id' => $uni1, 'is_approved' => true,  'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $p2, 'title' => 'E-Commerce Platform for Local Crafts',  'description' => 'An online marketplace connecting Uzbek artisans with global buyers.', 'student_id' => $s2, 'teacher_id' => $t1, 'university_id' => $uni1, 'is_approved' => false, 'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
            ['id' => $p3, 'title' => 'Smart City Traffic Management System',  'description' => 'IoT-based system to optimize traffic flow in urban areas.',           'student_id' => $s3, 'teacher_id' => $t2, 'university_id' => $uni2, 'is_approved' => true,  'is_active' => true, 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Vacancies (employer_id references users.user_id)
        DB::table('vacancies')->insert([
            ['id' => Str::uuid(), 'employer_id' => $ue1, 'company' => 'UzInnoTech',      'description' => 'Junior backend developer with Node.js experience.',        'location' => 'Tashkent', 'mode' => 'hybrid',  'type' => 'job',        'salary' => 1500, 'is_expired' => false, 'start_date' => now()->addDays(1),   'end_date' => now()->addDays(30),  'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'employer_id' => $ue1, 'company' => 'UzInnoTech',      'description' => 'Summer internship for CS students. React preferred.',       'location' => 'Tashkent', 'mode' => 'offline', 'type' => 'internship', 'salary' => 500,  'is_expired' => false, 'start_date' => now()->addDays(5),   'end_date' => now()->addDays(60),  'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'employer_id' => $ue2, 'company' => 'EPAM Uzbekistan', 'description' => 'Senior Python developer for data engineering team.',        'location' => 'Remote',   'mode' => 'online',  'type' => 'job',        'salary' => 3000, 'is_expired' => false, 'start_date' => now(),               'end_date' => now()->addDays(45),  'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'employer_id' => $ue2, 'company' => 'EPAM Uzbekistan', 'description' => 'DevOps internship — position expired.',                    'location' => 'Tashkent', 'mode' => 'hybrid',  'type' => 'internship', 'salary' => 600,  'is_expired' => true,  'start_date' => now()->subDays(60),  'end_date' => now()->subDays(10),  'created_at' => $now, 'updated_at' => $now],
        ]);

        // University Admin
        $ua1 = (string) Str::uuid();
        DB::table('universityadmin')->insert([
            ['admin_id' => $ua1, 'university_id' => $uni1, 'name' => 'Admin Toshmatov', 'email' => 'admin@tdtu.uz', 'password' => bcrypt('password'), 'created_at' => $now, 'updated_at' => $now],
        ]);

        // Recommendations
        DB::table('recommendations')->insert([
            ['id' => Str::uuid(), 'student_id' => $s1, 'university_id' => $uni1, 'university_admin_id' => $ua1, 'teacher_id' => $t1, 'status' => 'done',      'content' => 'Ali is an outstanding student with excellent analytical skills.',       'is_teacher_signed' => true,  'is_terminated' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'student_id' => $s2, 'university_id' => $uni1, 'university_admin_id' => $ua1, 'teacher_id' => $t1, 'status' => 'preparing', 'content' => 'Malika demonstrates exceptional problem-solving abilities.',            'is_teacher_signed' => false, 'is_terminated' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'student_id' => $s3, 'university_id' => $uni2, 'university_admin_id' => $ua1, 'teacher_id' => $t2, 'status' => 'pending',   'content' => null,                                                                     'is_teacher_signed' => false, 'is_terminated' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'student_id' => $s4, 'university_id' => $uni2, 'university_admin_id' => $ua1, 'teacher_id' => $t2, 'status' => 'submitting','content' => 'Dilnoza shows great potential and dedication to her studies.',          'is_teacher_signed' => true,  'is_terminated' => false, 'created_at' => $now, 'updated_at' => $now],
            ['id' => Str::uuid(), 'student_id' => $s5, 'university_id' => $uni3, 'university_admin_id' => $ua1, 'teacher_id' => $t1, 'status' => 'pending',   'content' => null,                                                                     'is_teacher_signed' => false, 'is_terminated' => true,  'created_at' => $now, 'updated_at' => $now],
        ]);

        $this->command->info('Sample data seeded successfully!');
    }
}
