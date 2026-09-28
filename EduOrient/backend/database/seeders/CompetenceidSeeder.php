<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompetenceidSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('candidat_competence')->insert(array (
            0 => 
            array (
                'id' => 1,
                'candidat_id' => 2,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 5,
            ),
            1 => 
            array (
                'id' => 2,
                'candidat_id' => 3,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 29,
            ),
            2 => 
            array (
                'id' => 3,
                'candidat_id' => 3,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 7,
            ),
            3 => 
            array (
                'id' => 4,
                'candidat_id' => 3,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 51,
            ),
            4 => 
            array (
                'id' => 5,
                'candidat_id' => 4,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 36,
            ),
            5 => 
            array (
                'id' => 6,
                'candidat_id' => 4,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 57,
            ),
            6 => 
            array (
                'id' => 7,
                'candidat_id' => 6,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 5,
            ),
            7 => 
            array (
                'id' => 8,
                'candidat_id' => 6,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 18,
            ),
            8 => 
            array (
                'id' => 9,
                'candidat_id' => 6,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 27,
            ),
            9 => 
            array (
                'id' => 10,
                'candidat_id' => 6,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'level' => 'beginner',
                'competence_id' => 6,
            ),
            10 => 
            array (
                'id' => 11,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 26,
            ),
            11 => 
            array (
                'id' => 12,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 69,
            ),
            12 => 
            array (
                'id' => 13,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 57,
            ),
            13 => 
            array (
                'id' => 14,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 10,
            ),
            14 => 
            array (
                'id' => 15,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 40,
            ),
            15 => 
            array (
                'id' => 16,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 17,
            ),
            16 => 
            array (
                'id' => 17,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 73,
            ),
            17 => 
            array (
                'id' => 18,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 61,
            ),
            18 => 
            array (
                'id' => 19,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 25,
            ),
            19 => 
            array (
                'id' => 20,
                'candidat_id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 54,
            ),
            20 => 
            array (
                'id' => 21,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 50,
            ),
            21 => 
            array (
                'id' => 22,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 10,
            ),
            22 => 
            array (
                'id' => 23,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 49,
            ),
            23 => 
            array (
                'id' => 24,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 36,
            ),
            24 => 
            array (
                'id' => 25,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 23,
            ),
            25 => 
            array (
                'id' => 26,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 27,
            ),
            26 => 
            array (
                'id' => 27,
                'candidat_id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 2,
            ),
            27 => 
            array (
                'id' => 28,
                'candidat_id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 63,
            ),
            28 => 
            array (
                'id' => 29,
                'candidat_id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 54,
            ),
            29 => 
            array (
                'id' => 30,
                'candidat_id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 33,
            ),
            30 => 
            array (
                'id' => 31,
                'candidat_id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 64,
            ),
            31 => 
            array (
                'id' => 32,
                'candidat_id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 46,
            ),
            32 => 
            array (
                'id' => 33,
                'candidat_id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 3,
            ),
            33 => 
            array (
                'id' => 34,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 40,
            ),
            34 => 
            array (
                'id' => 35,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 4,
            ),
            35 => 
            array (
                'id' => 36,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 41,
            ),
            36 => 
            array (
                'id' => 37,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 2,
            ),
            37 => 
            array (
                'id' => 38,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 49,
            ),
            38 => 
            array (
                'id' => 39,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 20,
            ),
            39 => 
            array (
                'id' => 40,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 58,
            ),
            40 => 
            array (
                'id' => 41,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 47,
            ),
            41 => 
            array (
                'id' => 42,
                'candidat_id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 12,
            ),
            42 => 
            array (
                'id' => 43,
                'candidat_id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 47,
            ),
            43 => 
            array (
                'id' => 44,
                'candidat_id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 4,
            ),
            44 => 
            array (
                'id' => 45,
                'candidat_id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 27,
            ),
            45 => 
            array (
                'id' => 46,
                'candidat_id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 55,
            ),
            46 => 
            array (
                'id' => 47,
                'candidat_id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 72,
            ),
            47 => 
            array (
                'id' => 48,
                'candidat_id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 58,
            ),
            48 => 
            array (
                'id' => 49,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 38,
            ),
            49 => 
            array (
                'id' => 50,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 4,
            ),
            50 => 
            array (
                'id' => 51,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 25,
            ),
            51 => 
            array (
                'id' => 52,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 28,
            ),
            52 => 
            array (
                'id' => 53,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 2,
            ),
            53 => 
            array (
                'id' => 54,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 52,
            ),
            54 => 
            array (
                'id' => 55,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 47,
            ),
            55 => 
            array (
                'id' => 56,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 5,
            ),
            56 => 
            array (
                'id' => 57,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 24,
            ),
            57 => 
            array (
                'id' => 58,
                'candidat_id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 30,
            ),
            58 => 
            array (
                'id' => 59,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'beginner',
                'competence_id' => 44,
            ),
            59 => 
            array (
                'id' => 60,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'expert',
                'competence_id' => 74,
            ),
            60 => 
            array (
                'id' => 61,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 15,
            ),
            61 => 
            array (
                'id' => 62,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'level' => 'intermediate',
                'competence_id' => 2,
            ),
            62 => 
            array (
                'id' => 63,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 32,
            ),
            63 => 
            array (
                'id' => 64,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 7,
            ),
            64 => 
            array (
                'id' => 65,
                'candidat_id' => 18,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 8,
            ),
            65 => 
            array (
                'id' => 66,
                'candidat_id' => 19,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 4,
            ),
            66 => 
            array (
                'id' => 67,
                'candidat_id' => 19,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 74,
            ),
            67 => 
            array (
                'id' => 68,
                'candidat_id' => 19,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 73,
            ),
            68 => 
            array (
                'id' => 69,
                'candidat_id' => 19,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 37,
            ),
            69 => 
            array (
                'id' => 70,
                'candidat_id' => 19,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 36,
            ),
            70 => 
            array (
                'id' => 71,
                'candidat_id' => 19,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 61,
            ),
            71 => 
            array (
                'id' => 72,
                'candidat_id' => 20,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 3,
            ),
            72 => 
            array (
                'id' => 73,
                'candidat_id' => 20,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 19,
            ),
            73 => 
            array (
                'id' => 74,
                'candidat_id' => 20,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 49,
            ),
            74 => 
            array (
                'id' => 75,
                'candidat_id' => 20,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 2,
            ),
            75 => 
            array (
                'id' => 76,
                'candidat_id' => 20,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 1,
            ),
            76 => 
            array (
                'id' => 77,
                'candidat_id' => 20,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 31,
            ),
            77 => 
            array (
                'id' => 78,
                'candidat_id' => 21,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 63,
            ),
            78 => 
            array (
                'id' => 79,
                'candidat_id' => 21,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 12,
            ),
            79 => 
            array (
                'id' => 80,
                'candidat_id' => 21,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 49,
            ),
            80 => 
            array (
                'id' => 81,
                'candidat_id' => 21,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 59,
            ),
            81 => 
            array (
                'id' => 82,
                'candidat_id' => 21,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 64,
            ),
            82 => 
            array (
                'id' => 83,
                'candidat_id' => 21,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 66,
            ),
            83 => 
            array (
                'id' => 84,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 15,
            ),
            84 => 
            array (
                'id' => 85,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 64,
            ),
            85 => 
            array (
                'id' => 86,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 22,
            ),
            86 => 
            array (
                'id' => 87,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 25,
            ),
            87 => 
            array (
                'id' => 88,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 33,
            ),
            88 => 
            array (
                'id' => 89,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 47,
            ),
            89 => 
            array (
                'id' => 90,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 10,
            ),
            90 => 
            array (
                'id' => 91,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 59,
            ),
            91 => 
            array (
                'id' => 92,
                'candidat_id' => 22,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 53,
            ),
            92 => 
            array (
                'id' => 93,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 58,
            ),
            93 => 
            array (
                'id' => 94,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 54,
            ),
            94 => 
            array (
                'id' => 95,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 21,
            ),
            95 => 
            array (
                'id' => 96,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 3,
            ),
            96 => 
            array (
                'id' => 97,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 68,
            ),
            97 => 
            array (
                'id' => 98,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 5,
            ),
            98 => 
            array (
                'id' => 99,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 33,
            ),
            99 => 
            array (
                'id' => 100,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 30,
            ),
            100 => 
            array (
                'id' => 101,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 66,
            ),
            101 => 
            array (
                'id' => 102,
                'candidat_id' => 23,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 29,
            ),
            102 => 
            array (
                'id' => 103,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 61,
            ),
            103 => 
            array (
                'id' => 104,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 24,
            ),
            104 => 
            array (
                'id' => 105,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 33,
            ),
            105 => 
            array (
                'id' => 106,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 10,
            ),
            106 => 
            array (
                'id' => 107,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 20,
            ),
            107 => 
            array (
                'id' => 108,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 26,
            ),
            108 => 
            array (
                'id' => 109,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 15,
            ),
            109 => 
            array (
                'id' => 110,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 68,
            ),
            110 => 
            array (
                'id' => 111,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 12,
            ),
            111 => 
            array (
                'id' => 112,
                'candidat_id' => 24,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 72,
            ),
            112 => 
            array (
                'id' => 113,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 53,
            ),
            113 => 
            array (
                'id' => 114,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 40,
            ),
            114 => 
            array (
                'id' => 115,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 66,
            ),
            115 => 
            array (
                'id' => 116,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'expert',
                'competence_id' => 74,
            ),
            116 => 
            array (
                'id' => 117,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'beginner',
                'competence_id' => 65,
            ),
            117 => 
            array (
                'id' => 118,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'level' => 'intermediate',
                'competence_id' => 19,
            ),
            118 => 
            array (
                'id' => 119,
                'candidat_id' => 25,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 18,
            ),
            119 => 
            array (
                'id' => 120,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 67,
            ),
            120 => 
            array (
                'id' => 121,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'beginner',
                'competence_id' => 16,
            ),
            121 => 
            array (
                'id' => 122,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 34,
            ),
            122 => 
            array (
                'id' => 123,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 63,
            ),
            123 => 
            array (
                'id' => 124,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 11,
            ),
            124 => 
            array (
                'id' => 125,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 7,
            ),
            125 => 
            array (
                'id' => 126,
                'candidat_id' => 26,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 28,
            ),
            126 => 
            array (
                'id' => 127,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 24,
            ),
            127 => 
            array (
                'id' => 128,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 22,
            ),
            128 => 
            array (
                'id' => 129,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 20,
            ),
            129 => 
            array (
                'id' => 130,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'beginner',
                'competence_id' => 69,
            ),
            130 => 
            array (
                'id' => 131,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 71,
            ),
            131 => 
            array (
                'id' => 132,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'beginner',
                'competence_id' => 51,
            ),
            132 => 
            array (
                'id' => 133,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 55,
            ),
            133 => 
            array (
                'id' => 134,
                'candidat_id' => 27,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'beginner',
                'competence_id' => 38,
            ),
            134 => 
            array (
                'id' => 135,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 20,
            ),
            135 => 
            array (
                'id' => 136,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 61,
            ),
            136 => 
            array (
                'id' => 137,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 30,
            ),
            137 => 
            array (
                'id' => 138,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 5,
            ),
            138 => 
            array (
                'id' => 139,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'intermediate',
                'competence_id' => 28,
            ),
            139 => 
            array (
                'id' => 140,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'beginner',
                'competence_id' => 10,
            ),
            140 => 
            array (
                'id' => 141,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'expert',
                'competence_id' => 25,
            ),
            141 => 
            array (
                'id' => 142,
                'candidat_id' => 28,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'level' => 'beginner',
                'competence_id' => 2,
            ),
            142 => 
            array (
                'id' => 143,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 34,
            ),
            143 => 
            array (
                'id' => 144,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 65,
            ),
            144 => 
            array (
                'id' => 145,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 27,
            ),
            145 => 
            array (
                'id' => 146,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 8,
            ),
            146 => 
            array (
                'id' => 147,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 64,
            ),
            147 => 
            array (
                'id' => 148,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 4,
            ),
            148 => 
            array (
                'id' => 149,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 54,
            ),
            149 => 
            array (
                'id' => 150,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 56,
            ),
            150 => 
            array (
                'id' => 151,
                'candidat_id' => 29,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 46,
            ),
            151 => 
            array (
                'id' => 152,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 3,
            ),
            152 => 
            array (
                'id' => 153,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 22,
            ),
            153 => 
            array (
                'id' => 154,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 66,
            ),
            154 => 
            array (
                'id' => 155,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 23,
            ),
            155 => 
            array (
                'id' => 156,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 21,
            ),
            156 => 
            array (
                'id' => 157,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 53,
            ),
            157 => 
            array (
                'id' => 158,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 10,
            ),
            158 => 
            array (
                'id' => 159,
                'candidat_id' => 30,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 25,
            ),
            159 => 
            array (
                'id' => 160,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 31,
            ),
            160 => 
            array (
                'id' => 161,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 29,
            ),
            161 => 
            array (
                'id' => 162,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 2,
            ),
            162 => 
            array (
                'id' => 163,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 50,
            ),
            163 => 
            array (
                'id' => 164,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 4,
            ),
            164 => 
            array (
                'id' => 165,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 48,
            ),
            165 => 
            array (
                'id' => 166,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 11,
            ),
            166 => 
            array (
                'id' => 167,
                'candidat_id' => 31,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 9,
            ),
            167 => 
            array (
                'id' => 168,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 70,
            ),
            168 => 
            array (
                'id' => 169,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 53,
            ),
            169 => 
            array (
                'id' => 170,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 38,
            ),
            170 => 
            array (
                'id' => 171,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 62,
            ),
            171 => 
            array (
                'id' => 172,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 6,
            ),
            172 => 
            array (
                'id' => 173,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 42,
            ),
            173 => 
            array (
                'id' => 174,
                'candidat_id' => 32,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 1,
            ),
            174 => 
            array (
                'id' => 175,
                'candidat_id' => 33,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 46,
            ),
            175 => 
            array (
                'id' => 176,
                'candidat_id' => 33,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 36,
            ),
            176 => 
            array (
                'id' => 177,
                'candidat_id' => 33,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 44,
            ),
            177 => 
            array (
                'id' => 178,
                'candidat_id' => 33,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 66,
            ),
            178 => 
            array (
                'id' => 179,
                'candidat_id' => 33,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 35,
            ),
            179 => 
            array (
                'id' => 180,
                'candidat_id' => 33,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 13,
            ),
            180 => 
            array (
                'id' => 181,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 1,
            ),
            181 => 
            array (
                'id' => 182,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 21,
            ),
            182 => 
            array (
                'id' => 183,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 33,
            ),
            183 => 
            array (
                'id' => 184,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 61,
            ),
            184 => 
            array (
                'id' => 185,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 18,
            ),
            185 => 
            array (
                'id' => 186,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 46,
            ),
            186 => 
            array (
                'id' => 187,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 41,
            ),
            187 => 
            array (
                'id' => 188,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 53,
            ),
            188 => 
            array (
                'id' => 189,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 12,
            ),
            189 => 
            array (
                'id' => 190,
                'candidat_id' => 34,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 64,
            ),
            190 => 
            array (
                'id' => 191,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 6,
            ),
            191 => 
            array (
                'id' => 192,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 7,
            ),
            192 => 
            array (
                'id' => 193,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 20,
            ),
            193 => 
            array (
                'id' => 194,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 43,
            ),
            194 => 
            array (
                'id' => 195,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 32,
            ),
            195 => 
            array (
                'id' => 196,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 60,
            ),
            196 => 
            array (
                'id' => 197,
                'candidat_id' => 35,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 55,
            ),
            197 => 
            array (
                'id' => 198,
                'candidat_id' => 36,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 10,
            ),
            198 => 
            array (
                'id' => 199,
                'candidat_id' => 36,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'intermediate',
                'competence_id' => 41,
            ),
            199 => 
            array (
                'id' => 200,
                'candidat_id' => 36,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 5,
            ),
            200 => 
            array (
                'id' => 201,
                'candidat_id' => 36,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'beginner',
                'competence_id' => 46,
            ),
            201 => 
            array (
                'id' => 202,
                'candidat_id' => 36,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 20,
            ),
            202 => 
            array (
                'id' => 203,
                'candidat_id' => 36,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'level' => 'expert',
                'competence_id' => 49,
            ),
            203 => 
            array (
                'id' => 204,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 32,
            ),
            204 => 
            array (
                'id' => 205,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 57,
            ),
            205 => 
            array (
                'id' => 206,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 24,
            ),
            206 => 
            array (
                'id' => 207,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 12,
            ),
            207 => 
            array (
                'id' => 208,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 50,
            ),
            208 => 
            array (
                'id' => 209,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 43,
            ),
            209 => 
            array (
                'id' => 210,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 61,
            ),
            210 => 
            array (
                'id' => 211,
                'candidat_id' => 37,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 1,
            ),
            211 => 
            array (
                'id' => 212,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 74,
            ),
            212 => 
            array (
                'id' => 213,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 57,
            ),
            213 => 
            array (
                'id' => 214,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 36,
            ),
            214 => 
            array (
                'id' => 215,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 52,
            ),
            215 => 
            array (
                'id' => 216,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 56,
            ),
            216 => 
            array (
                'id' => 217,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 53,
            ),
            217 => 
            array (
                'id' => 218,
                'candidat_id' => 38,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 59,
            ),
            218 => 
            array (
                'id' => 219,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 13,
            ),
            219 => 
            array (
                'id' => 220,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 4,
            ),
            220 => 
            array (
                'id' => 221,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 68,
            ),
            221 => 
            array (
                'id' => 222,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 70,
            ),
            222 => 
            array (
                'id' => 223,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 51,
            ),
            223 => 
            array (
                'id' => 224,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 71,
            ),
            224 => 
            array (
                'id' => 225,
                'candidat_id' => 39,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 32,
            ),
            225 => 
            array (
                'id' => 226,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 71,
            ),
            226 => 
            array (
                'id' => 227,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 24,
            ),
            227 => 
            array (
                'id' => 228,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 22,
            ),
            228 => 
            array (
                'id' => 229,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 10,
            ),
            229 => 
            array (
                'id' => 230,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 61,
            ),
            230 => 
            array (
                'id' => 231,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 7,
            ),
            231 => 
            array (
                'id' => 232,
                'candidat_id' => 40,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 64,
            ),
            232 => 
            array (
                'id' => 233,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 64,
            ),
            233 => 
            array (
                'id' => 234,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 12,
            ),
            234 => 
            array (
                'id' => 235,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 55,
            ),
            235 => 
            array (
                'id' => 236,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 20,
            ),
            236 => 
            array (
                'id' => 237,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 16,
            ),
            237 => 
            array (
                'id' => 238,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 57,
            ),
            238 => 
            array (
                'id' => 239,
                'candidat_id' => 41,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 63,
            ),
            239 => 
            array (
                'id' => 240,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 30,
            ),
            240 => 
            array (
                'id' => 241,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 53,
            ),
            241 => 
            array (
                'id' => 242,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 47,
            ),
            242 => 
            array (
                'id' => 243,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 6,
            ),
            243 => 
            array (
                'id' => 244,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 13,
            ),
            244 => 
            array (
                'id' => 245,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 19,
            ),
            245 => 
            array (
                'id' => 246,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 68,
            ),
            246 => 
            array (
                'id' => 247,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 38,
            ),
            247 => 
            array (
                'id' => 248,
                'candidat_id' => 42,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 24,
            ),
            248 => 
            array (
                'id' => 249,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 9,
            ),
            249 => 
            array (
                'id' => 250,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 22,
            ),
            250 => 
            array (
                'id' => 251,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 70,
            ),
            251 => 
            array (
                'id' => 252,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 1,
            ),
            252 => 
            array (
                'id' => 253,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 13,
            ),
            253 => 
            array (
                'id' => 254,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 21,
            ),
            254 => 
            array (
                'id' => 255,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 43,
            ),
            255 => 
            array (
                'id' => 256,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 33,
            ),
            256 => 
            array (
                'id' => 257,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 30,
            ),
            257 => 
            array (
                'id' => 258,
                'candidat_id' => 43,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 61,
            ),
            258 => 
            array (
                'id' => 259,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 15,
            ),
            259 => 
            array (
                'id' => 260,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 38,
            ),
            260 => 
            array (
                'id' => 261,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 21,
            ),
            261 => 
            array (
                'id' => 262,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 69,
            ),
            262 => 
            array (
                'id' => 263,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 27,
            ),
            263 => 
            array (
                'id' => 264,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'expert',
                'competence_id' => 1,
            ),
            264 => 
            array (
                'id' => 265,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'intermediate',
                'competence_id' => 40,
            ),
            265 => 
            array (
                'id' => 266,
                'candidat_id' => 44,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'level' => 'beginner',
                'competence_id' => 70,
            ),
            266 => 
            array (
                'id' => 267,
                'candidat_id' => 45,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 21,
            ),
            267 => 
            array (
                'id' => 268,
                'candidat_id' => 45,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 48,
            ),
            268 => 
            array (
                'id' => 269,
                'candidat_id' => 45,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 74,
            ),
            269 => 
            array (
                'id' => 270,
                'candidat_id' => 45,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 30,
            ),
            270 => 
            array (
                'id' => 271,
                'candidat_id' => 45,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 32,
            ),
            271 => 
            array (
                'id' => 272,
                'candidat_id' => 45,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 51,
            ),
            272 => 
            array (
                'id' => 273,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 31,
            ),
            273 => 
            array (
                'id' => 274,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 42,
            ),
            274 => 
            array (
                'id' => 275,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 29,
            ),
            275 => 
            array (
                'id' => 276,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 70,
            ),
            276 => 
            array (
                'id' => 277,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 71,
            ),
            277 => 
            array (
                'id' => 278,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 48,
            ),
            278 => 
            array (
                'id' => 279,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 16,
            ),
            279 => 
            array (
                'id' => 280,
                'candidat_id' => 46,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 63,
            ),
            280 => 
            array (
                'id' => 281,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 19,
            ),
            281 => 
            array (
                'id' => 282,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 49,
            ),
            282 => 
            array (
                'id' => 283,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 32,
            ),
            283 => 
            array (
                'id' => 284,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 37,
            ),
            284 => 
            array (
                'id' => 285,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 64,
            ),
            285 => 
            array (
                'id' => 286,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 13,
            ),
            286 => 
            array (
                'id' => 287,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 72,
            ),
            287 => 
            array (
                'id' => 288,
                'candidat_id' => 47,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 52,
            ),
            288 => 
            array (
                'id' => 289,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 22,
            ),
            289 => 
            array (
                'id' => 290,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 11,
            ),
            290 => 
            array (
                'id' => 291,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 57,
            ),
            291 => 
            array (
                'id' => 292,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 7,
            ),
            292 => 
            array (
                'id' => 293,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 43,
            ),
            293 => 
            array (
                'id' => 294,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 8,
            ),
            294 => 
            array (
                'id' => 295,
                'candidat_id' => 48,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 49,
            ),
            295 => 
            array (
                'id' => 296,
                'candidat_id' => 49,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 48,
            ),
            296 => 
            array (
                'id' => 297,
                'candidat_id' => 49,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 4,
            ),
            297 => 
            array (
                'id' => 298,
                'candidat_id' => 49,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 29,
            ),
            298 => 
            array (
                'id' => 299,
                'candidat_id' => 49,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 15,
            ),
            299 => 
            array (
                'id' => 300,
                'candidat_id' => 49,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 37,
            ),
            300 => 
            array (
                'id' => 301,
                'candidat_id' => 49,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 50,
            ),
            301 => 
            array (
                'id' => 302,
                'candidat_id' => 50,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 46,
            ),
            302 => 
            array (
                'id' => 303,
                'candidat_id' => 50,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 57,
            ),
            303 => 
            array (
                'id' => 304,
                'candidat_id' => 50,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 74,
            ),
            304 => 
            array (
                'id' => 305,
                'candidat_id' => 50,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 14,
            ),
            305 => 
            array (
                'id' => 306,
                'candidat_id' => 50,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 35,
            ),
            306 => 
            array (
                'id' => 307,
                'candidat_id' => 50,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 37,
            ),
            307 => 
            array (
                'id' => 308,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 68,
            ),
            308 => 
            array (
                'id' => 309,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 73,
            ),
            309 => 
            array (
                'id' => 310,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 21,
            ),
            310 => 
            array (
                'id' => 311,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 8,
            ),
            311 => 
            array (
                'id' => 312,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 9,
            ),
            312 => 
            array (
                'id' => 313,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 53,
            ),
            313 => 
            array (
                'id' => 314,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 43,
            ),
            314 => 
            array (
                'id' => 315,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 34,
            ),
            315 => 
            array (
                'id' => 316,
                'candidat_id' => 51,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 35,
            ),
            316 => 
            array (
                'id' => 317,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 19,
            ),
            317 => 
            array (
                'id' => 318,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 44,
            ),
            318 => 
            array (
                'id' => 319,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 53,
            ),
            319 => 
            array (
                'id' => 320,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 58,
            ),
            320 => 
            array (
                'id' => 321,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 36,
            ),
            321 => 
            array (
                'id' => 322,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 43,
            ),
            322 => 
            array (
                'id' => 323,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'expert',
                'competence_id' => 42,
            ),
            323 => 
            array (
                'id' => 324,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 47,
            ),
            324 => 
            array (
                'id' => 325,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'beginner',
                'competence_id' => 69,
            ),
            325 => 
            array (
                'id' => 326,
                'candidat_id' => 52,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'level' => 'intermediate',
                'competence_id' => 10,
            ),
            326 => 
            array (
                'id' => 327,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 16,
            ),
            327 => 
            array (
                'id' => 328,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 53,
            ),
            328 => 
            array (
                'id' => 329,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 30,
            ),
            329 => 
            array (
                'id' => 330,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 51,
            ),
            330 => 
            array (
                'id' => 331,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 73,
            ),
            331 => 
            array (
                'id' => 332,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 69,
            ),
            332 => 
            array (
                'id' => 333,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 31,
            ),
            333 => 
            array (
                'id' => 334,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 8,
            ),
            334 => 
            array (
                'id' => 335,
                'candidat_id' => 53,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 28,
            ),
            335 => 
            array (
                'id' => 336,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 23,
            ),
            336 => 
            array (
                'id' => 337,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 64,
            ),
            337 => 
            array (
                'id' => 338,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 8,
            ),
            338 => 
            array (
                'id' => 339,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 10,
            ),
            339 => 
            array (
                'id' => 340,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 61,
            ),
            340 => 
            array (
                'id' => 341,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 56,
            ),
            341 => 
            array (
                'id' => 342,
                'candidat_id' => 54,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 66,
            ),
            342 => 
            array (
                'id' => 343,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 24,
            ),
            343 => 
            array (
                'id' => 344,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 53,
            ),
            344 => 
            array (
                'id' => 345,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 11,
            ),
            345 => 
            array (
                'id' => 346,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 42,
            ),
            346 => 
            array (
                'id' => 347,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 5,
            ),
            347 => 
            array (
                'id' => 348,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 38,
            ),
            348 => 
            array (
                'id' => 349,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 73,
            ),
            349 => 
            array (
                'id' => 350,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 55,
            ),
            350 => 
            array (
                'id' => 351,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 62,
            ),
            351 => 
            array (
                'id' => 352,
                'candidat_id' => 55,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 69,
            ),
            352 => 
            array (
                'id' => 353,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 59,
            ),
            353 => 
            array (
                'id' => 354,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 68,
            ),
            354 => 
            array (
                'id' => 355,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 48,
            ),
            355 => 
            array (
                'id' => 356,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 46,
            ),
            356 => 
            array (
                'id' => 357,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 13,
            ),
            357 => 
            array (
                'id' => 358,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 24,
            ),
            358 => 
            array (
                'id' => 359,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 67,
            ),
            359 => 
            array (
                'id' => 360,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 29,
            ),
            360 => 
            array (
                'id' => 361,
                'candidat_id' => 56,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 14,
            ),
            361 => 
            array (
                'id' => 362,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 35,
            ),
            362 => 
            array (
                'id' => 363,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 45,
            ),
            363 => 
            array (
                'id' => 364,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 50,
            ),
            364 => 
            array (
                'id' => 365,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 17,
            ),
            365 => 
            array (
                'id' => 366,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 74,
            ),
            366 => 
            array (
                'id' => 367,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 68,
            ),
            367 => 
            array (
                'id' => 368,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 59,
            ),
            368 => 
            array (
                'id' => 369,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 56,
            ),
            369 => 
            array (
                'id' => 370,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 44,
            ),
            370 => 
            array (
                'id' => 371,
                'candidat_id' => 57,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 69,
            ),
            371 => 
            array (
                'id' => 372,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 55,
            ),
            372 => 
            array (
                'id' => 373,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 69,
            ),
            373 => 
            array (
                'id' => 374,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 48,
            ),
            374 => 
            array (
                'id' => 375,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 67,
            ),
            375 => 
            array (
                'id' => 376,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 23,
            ),
            376 => 
            array (
                'id' => 377,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 59,
            ),
            377 => 
            array (
                'id' => 378,
                'candidat_id' => 58,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 2,
            ),
            378 => 
            array (
                'id' => 379,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 67,
            ),
            379 => 
            array (
                'id' => 380,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 52,
            ),
            380 => 
            array (
                'id' => 381,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 28,
            ),
            381 => 
            array (
                'id' => 382,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 25,
            ),
            382 => 
            array (
                'id' => 383,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 54,
            ),
            383 => 
            array (
                'id' => 384,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 9,
            ),
            384 => 
            array (
                'id' => 385,
                'candidat_id' => 59,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'beginner',
                'competence_id' => 14,
            ),
            385 => 
            array (
                'id' => 386,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 27,
            ),
            386 => 
            array (
                'id' => 387,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 55,
            ),
            387 => 
            array (
                'id' => 388,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 41,
            ),
            388 => 
            array (
                'id' => 389,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 62,
            ),
            389 => 
            array (
                'id' => 390,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'expert',
                'competence_id' => 7,
            ),
            390 => 
            array (
                'id' => 391,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 12,
            ),
            391 => 
            array (
                'id' => 392,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'level' => 'intermediate',
                'competence_id' => 52,
            ),
            392 => 
            array (
                'id' => 393,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'intermediate',
                'competence_id' => 65,
            ),
            393 => 
            array (
                'id' => 394,
                'candidat_id' => 60,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'intermediate',
                'competence_id' => 23,
            ),
            394 => 
            array (
                'id' => 395,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'beginner',
                'competence_id' => 44,
            ),
            395 => 
            array (
                'id' => 396,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'intermediate',
                'competence_id' => 21,
            ),
            396 => 
            array (
                'id' => 397,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'beginner',
                'competence_id' => 15,
            ),
            397 => 
            array (
                'id' => 398,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'beginner',
                'competence_id' => 60,
            ),
            398 => 
            array (
                'id' => 399,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'intermediate',
                'competence_id' => 54,
            ),
            399 => 
            array (
                'id' => 400,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'beginner',
                'competence_id' => 33,
            ),
            400 => 
            array (
                'id' => 401,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'expert',
                'competence_id' => 40,
            ),
            401 => 
            array (
                'id' => 402,
                'candidat_id' => 61,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'level' => 'intermediate',
                'competence_id' => 24,
            ),
            402 => 
            array (
                'id' => 403,
                'candidat_id' => 2,
                'created_at' => '2026-05-02 20:34:40',
                'updated_at' => '2026-05-02 20:34:40',
                'level' => 'beginner',
                'competence_id' => 46,
            ),
            403 => 
            array (
                'id' => 404,
                'candidat_id' => 2,
                'created_at' => '2026-05-02 20:34:44',
                'updated_at' => '2026-05-02 20:34:44',
                'level' => 'beginner',
                'competence_id' => 51,
            ),
            404 => 
            array (
                'id' => 405,
                'candidat_id' => 2,
                'created_at' => '2026-05-13 09:54:44',
                'updated_at' => '2026-05-13 09:54:44',
                'level' => 'beginner',
                'competence_id' => 24,
            ),
            405 => 
            array (
                'id' => 406,
                'candidat_id' => 2,
                'created_at' => '2026-05-13 11:17:12',
                'updated_at' => '2026-05-13 11:17:12',
                'level' => 'beginner',
                'competence_id' => 12,
            ),
            406 => 
            array (
                'id' => 407,
                'candidat_id' => 2,
                'created_at' => '2026-05-17 19:37:20',
                'updated_at' => '2026-05-17 19:37:20',
                'level' => 'beginner',
                'competence_id' => 4,
            ),
            407 => 
            array (
                'id' => 408,
                'candidat_id' => 2,
                'created_at' => '2026-05-17 19:37:20',
                'updated_at' => '2026-05-17 19:37:20',
                'level' => 'beginner',
                'competence_id' => 11,
            ),
            408 => 
            array (
                'id' => 409,
                'candidat_id' => 2,
                'created_at' => '2026-05-17 19:37:20',
                'updated_at' => '2026-05-17 19:37:20',
                'level' => 'beginner',
                'competence_id' => 42,
            ),
            409 => 
            array (
                'id' => 410,
                'candidat_id' => 2,
                'created_at' => '2026-05-17 19:37:20',
                'updated_at' => '2026-05-17 19:37:20',
                'level' => 'beginner',
                'competence_id' => 2,
            ),
            410 => 
            array (
                'id' => 411,
                'candidat_id' => 2,
                'created_at' => '2026-05-17 19:37:20',
                'updated_at' => '2026-05-17 19:37:20',
                'level' => 'beginner',
                'competence_id' => 7,
            ),
            411 => 
            array (
                'id' => 412,
                'candidat_id' => 2,
                'created_at' => '2026-05-17 19:37:20',
                'updated_at' => '2026-05-17 19:37:20',
                'level' => 'beginner',
                'competence_id' => 36,
            ),
            412 => 
            array (
                'id' => 413,
                'candidat_id' => 2,
                'competence_id' => 75,
                'level' => NULL,
                'created_at' => '2026-05-02 20:35:06',
                'updated_at' => '2026-05-02 20:35:06',
            ),
        ));
        DB::table('offre_competence')->insert(array (
            0 => 
            array (
                'id' => 1,
                'offre_id' => 2,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 29,
            ),
            1 => 
            array (
                'id' => 2,
                'offre_id' => 2,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 5,
            ),
            2 => 
            array (
                'id' => 3,
                'offre_id' => 2,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 51,
            ),
            3 => 
            array (
                'id' => 4,
                'offre_id' => 3,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 29,
            ),
            4 => 
            array (
                'id' => 5,
                'offre_id' => 3,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 51,
            ),
            5 => 
            array (
                'id' => 6,
                'offre_id' => 4,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 24,
            ),
            6 => 
            array (
                'id' => 7,
                'offre_id' => 4,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 6,
            ),
            7 => 
            array (
                'id' => 8,
                'offre_id' => 4,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 51,
            ),
            8 => 
            array (
                'id' => 9,
                'offre_id' => 5,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 35,
            ),
            9 => 
            array (
                'id' => 10,
                'offre_id' => 5,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 17,
            ),
            10 => 
            array (
                'id' => 11,
                'offre_id' => 5,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 43,
            ),
            11 => 
            array (
                'id' => 12,
                'offre_id' => 5,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 32,
            ),
            12 => 
            array (
                'id' => 13,
                'offre_id' => 6,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 8,
            ),
            13 => 
            array (
                'id' => 14,
                'offre_id' => 6,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 39,
            ),
            14 => 
            array (
                'id' => 15,
                'offre_id' => 6,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 54,
            ),
            15 => 
            array (
                'id' => 16,
                'offre_id' => 6,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'competence_id' => 50,
            ),
            16 => 
            array (
                'id' => 17,
                'offre_id' => 6,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 30,
            ),
            17 => 
            array (
                'id' => 18,
                'offre_id' => 6,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 4,
            ),
            18 => 
            array (
                'id' => 19,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 51,
            ),
            19 => 
            array (
                'id' => 20,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 11,
            ),
            20 => 
            array (
                'id' => 21,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 9,
            ),
            21 => 
            array (
                'id' => 22,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 6,
            ),
            22 => 
            array (
                'id' => 23,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 28,
            ),
            23 => 
            array (
                'id' => 24,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 53,
            ),
            24 => 
            array (
                'id' => 25,
                'offre_id' => 7,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 37,
            ),
            25 => 
            array (
                'id' => 26,
                'offre_id' => 8,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 63,
            ),
            26 => 
            array (
                'id' => 27,
                'offre_id' => 8,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 8,
            ),
            27 => 
            array (
                'id' => 28,
                'offre_id' => 8,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 47,
            ),
            28 => 
            array (
                'id' => 29,
                'offre_id' => 8,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 72,
            ),
            29 => 
            array (
                'id' => 30,
                'offre_id' => 8,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 31,
            ),
            30 => 
            array (
                'id' => 31,
                'offre_id' => 8,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 41,
            ),
            31 => 
            array (
                'id' => 32,
                'offre_id' => 9,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 5,
            ),
            32 => 
            array (
                'id' => 33,
                'offre_id' => 9,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 57,
            ),
            33 => 
            array (
                'id' => 34,
                'offre_id' => 9,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 36,
            ),
            34 => 
            array (
                'id' => 35,
                'offre_id' => 9,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 24,
            ),
            35 => 
            array (
                'id' => 36,
                'offre_id' => 9,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 4,
            ),
            36 => 
            array (
                'id' => 37,
                'offre_id' => 9,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 15,
            ),
            37 => 
            array (
                'id' => 38,
                'offre_id' => 10,
                'created_at' => '2026-04-25 00:02:05',
                'updated_at' => '2026-04-25 00:02:05',
                'competence_id' => 31,
            ),
            38 => 
            array (
                'id' => 39,
                'offre_id' => 10,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 58,
            ),
            39 => 
            array (
                'id' => 40,
                'offre_id' => 10,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 42,
            ),
            40 => 
            array (
                'id' => 41,
                'offre_id' => 10,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 18,
            ),
            41 => 
            array (
                'id' => 42,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 16,
            ),
            42 => 
            array (
                'id' => 43,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 72,
            ),
            43 => 
            array (
                'id' => 44,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 68,
            ),
            44 => 
            array (
                'id' => 45,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 8,
            ),
            45 => 
            array (
                'id' => 46,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 41,
            ),
            46 => 
            array (
                'id' => 47,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 26,
            ),
            47 => 
            array (
                'id' => 48,
                'offre_id' => 11,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 73,
            ),
            48 => 
            array (
                'id' => 49,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 19,
            ),
            49 => 
            array (
                'id' => 50,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 58,
            ),
            50 => 
            array (
                'id' => 51,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 64,
            ),
            51 => 
            array (
                'id' => 52,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 35,
            ),
            52 => 
            array (
                'id' => 53,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 73,
            ),
            53 => 
            array (
                'id' => 54,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 36,
            ),
            54 => 
            array (
                'id' => 55,
                'offre_id' => 12,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 65,
            ),
            55 => 
            array (
                'id' => 56,
                'offre_id' => 14,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 5,
            ),
            56 => 
            array (
                'id' => 57,
                'offre_id' => 14,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 15,
            ),
            57 => 
            array (
                'id' => 58,
                'offre_id' => 14,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 39,
            ),
            58 => 
            array (
                'id' => 59,
                'offre_id' => 14,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 49,
            ),
            59 => 
            array (
                'id' => 60,
                'offre_id' => 15,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 6,
            ),
            60 => 
            array (
                'id' => 61,
                'offre_id' => 15,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 26,
            ),
            61 => 
            array (
                'id' => 62,
                'offre_id' => 15,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 12,
            ),
            62 => 
            array (
                'id' => 63,
                'offre_id' => 15,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 9,
            ),
            63 => 
            array (
                'id' => 64,
                'offre_id' => 15,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 51,
            ),
            64 => 
            array (
                'id' => 65,
                'offre_id' => 15,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 46,
            ),
            65 => 
            array (
                'id' => 66,
                'offre_id' => 16,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 58,
            ),
            66 => 
            array (
                'id' => 67,
                'offre_id' => 16,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 68,
            ),
            67 => 
            array (
                'id' => 68,
                'offre_id' => 16,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 34,
            ),
            68 => 
            array (
                'id' => 69,
                'offre_id' => 16,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 61,
            ),
            69 => 
            array (
                'id' => 70,
                'offre_id' => 16,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 32,
            ),
            70 => 
            array (
                'id' => 71,
                'offre_id' => 16,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 38,
            ),
            71 => 
            array (
                'id' => 72,
                'offre_id' => 17,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 12,
            ),
            72 => 
            array (
                'id' => 73,
                'offre_id' => 17,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 20,
            ),
            73 => 
            array (
                'id' => 74,
                'offre_id' => 17,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 14,
            ),
            74 => 
            array (
                'id' => 75,
                'offre_id' => 17,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 4,
            ),
            75 => 
            array (
                'id' => 76,
                'offre_id' => 17,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 74,
            ),
            76 => 
            array (
                'id' => 77,
                'offre_id' => 17,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 50,
            ),
            77 => 
            array (
                'id' => 78,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 39,
            ),
            78 => 
            array (
                'id' => 79,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 7,
            ),
            79 => 
            array (
                'id' => 80,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 19,
            ),
            80 => 
            array (
                'id' => 81,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 58,
            ),
            81 => 
            array (
                'id' => 82,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 74,
            ),
            82 => 
            array (
                'id' => 83,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 25,
            ),
            83 => 
            array (
                'id' => 84,
                'offre_id' => 18,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 16,
            ),
            84 => 
            array (
                'id' => 85,
                'offre_id' => 19,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 21,
            ),
            85 => 
            array (
                'id' => 86,
                'offre_id' => 19,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 63,
            ),
            86 => 
            array (
                'id' => 87,
                'offre_id' => 19,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 11,
            ),
            87 => 
            array (
                'id' => 88,
                'offre_id' => 19,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 27,
            ),
            88 => 
            array (
                'id' => 89,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 65,
            ),
            89 => 
            array (
                'id' => 90,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 6,
            ),
            90 => 
            array (
                'id' => 91,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 34,
            ),
            91 => 
            array (
                'id' => 92,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 25,
            ),
            92 => 
            array (
                'id' => 93,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 38,
            ),
            93 => 
            array (
                'id' => 94,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 44,
            ),
            94 => 
            array (
                'id' => 95,
                'offre_id' => 21,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 22,
            ),
            95 => 
            array (
                'id' => 96,
                'offre_id' => 22,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 39,
            ),
            96 => 
            array (
                'id' => 97,
                'offre_id' => 22,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 57,
            ),
            97 => 
            array (
                'id' => 98,
                'offre_id' => 22,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 7,
            ),
            98 => 
            array (
                'id' => 99,
                'offre_id' => 22,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 1,
            ),
            99 => 
            array (
                'id' => 100,
                'offre_id' => 22,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 6,
            ),
            100 => 
            array (
                'id' => 101,
                'offre_id' => 22,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 52,
            ),
            101 => 
            array (
                'id' => 102,
                'offre_id' => 23,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 28,
            ),
            102 => 
            array (
                'id' => 103,
                'offre_id' => 23,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 59,
            ),
            103 => 
            array (
                'id' => 104,
                'offre_id' => 23,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 67,
            ),
            104 => 
            array (
                'id' => 105,
                'offre_id' => 23,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 2,
            ),
            105 => 
            array (
                'id' => 106,
                'offre_id' => 23,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 53,
            ),
            106 => 
            array (
                'id' => 107,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 48,
            ),
            107 => 
            array (
                'id' => 108,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 18,
            ),
            108 => 
            array (
                'id' => 109,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 71,
            ),
            109 => 
            array (
                'id' => 110,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 15,
            ),
            110 => 
            array (
                'id' => 111,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 63,
            ),
            111 => 
            array (
                'id' => 112,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 36,
            ),
            112 => 
            array (
                'id' => 113,
                'offre_id' => 24,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 58,
            ),
            113 => 
            array (
                'id' => 114,
                'offre_id' => 25,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 2,
            ),
            114 => 
            array (
                'id' => 115,
                'offre_id' => 25,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 9,
            ),
            115 => 
            array (
                'id' => 116,
                'offre_id' => 25,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 43,
            ),
            116 => 
            array (
                'id' => 117,
                'offre_id' => 25,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 51,
            ),
            117 => 
            array (
                'id' => 118,
                'offre_id' => 26,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 45,
            ),
            118 => 
            array (
                'id' => 119,
                'offre_id' => 26,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 29,
            ),
            119 => 
            array (
                'id' => 120,
                'offre_id' => 26,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 4,
            ),
            120 => 
            array (
                'id' => 121,
                'offre_id' => 26,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 35,
            ),
            121 => 
            array (
                'id' => 122,
                'offre_id' => 26,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 15,
            ),
            122 => 
            array (
                'id' => 123,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 47,
            ),
            123 => 
            array (
                'id' => 124,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 74,
            ),
            124 => 
            array (
                'id' => 125,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 51,
            ),
            125 => 
            array (
                'id' => 126,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 30,
            ),
            126 => 
            array (
                'id' => 127,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 57,
            ),
            127 => 
            array (
                'id' => 128,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 32,
            ),
            128 => 
            array (
                'id' => 129,
                'offre_id' => 27,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 19,
            ),
            129 => 
            array (
                'id' => 130,
                'offre_id' => 28,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 39,
            ),
            130 => 
            array (
                'id' => 131,
                'offre_id' => 28,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 46,
            ),
            131 => 
            array (
                'id' => 132,
                'offre_id' => 28,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 57,
            ),
            132 => 
            array (
                'id' => 133,
                'offre_id' => 28,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 63,
            ),
            133 => 
            array (
                'id' => 134,
                'offre_id' => 28,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 24,
            ),
            134 => 
            array (
                'id' => 135,
                'offre_id' => 29,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 29,
            ),
            135 => 
            array (
                'id' => 136,
                'offre_id' => 29,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 23,
            ),
            136 => 
            array (
                'id' => 137,
                'offre_id' => 29,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 38,
            ),
            137 => 
            array (
                'id' => 138,
                'offre_id' => 29,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 55,
            ),
            138 => 
            array (
                'id' => 139,
                'offre_id' => 29,
                'created_at' => '2026-04-25 00:02:06',
                'updated_at' => '2026-04-25 00:02:06',
                'competence_id' => 30,
            ),
            139 => 
            array (
                'id' => 140,
                'offre_id' => 33,
                'created_at' => '2026-05-07 18:25:27',
                'updated_at' => '2026-05-07 18:25:27',
                'competence_id' => 1,
            ),
            140 => 
            array (
                'id' => 141,
                'offre_id' => 33,
                'created_at' => '2026-05-07 18:25:27',
                'updated_at' => '2026-05-07 18:25:27',
                'competence_id' => 2,
            ),
            141 => 
            array (
                'id' => 142,
                'offre_id' => 33,
                'created_at' => '2026-05-07 18:25:27',
                'updated_at' => '2026-05-07 18:25:27',
                'competence_id' => 5,
            ),
        ));
        DB::table('recruteur_competence')->insert(array (
            0 => 
            array (
                'id' => 1,
                'recruteur_id' => 7,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 18,
            ),
            1 => 
            array (
                'id' => 2,
                'recruteur_id' => 7,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 27,
            ),
            2 => 
            array (
                'id' => 3,
                'recruteur_id' => 7,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 51,
            ),
            3 => 
            array (
                'id' => 4,
                'recruteur_id' => 7,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 57,
            ),
            4 => 
            array (
                'id' => 5,
                'recruteur_id' => 8,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 29,
            ),
            5 => 
            array (
                'id' => 6,
                'recruteur_id' => 8,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 5,
            ),
            6 => 
            array (
                'id' => 7,
                'recruteur_id' => 11,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 24,
            ),
            7 => 
            array (
                'id' => 8,
                'recruteur_id' => 11,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'competence_id' => 6,
            ),
            8 => 
            array (
                'id' => 9,
                'recruteur_id' => 77,
                'created_at' => '2026-05-02 17:55:29',
                'updated_at' => '2026-05-02 17:55:29',
                'competence_id' => 50,
            ),
            9 => 
            array (
                'id' => 10,
                'recruteur_id' => 77,
                'created_at' => '2026-05-02 17:55:29',
                'updated_at' => '2026-05-02 17:55:29',
                'competence_id' => 54,
            ),
            10 => 
            array (
                'id' => 11,
                'recruteur_id' => 77,
                'created_at' => '2026-05-02 17:55:29',
                'updated_at' => '2026-05-02 17:55:29',
                'competence_id' => 30,
            ),
        ));
        DB::table('projet_competence')->insert(array (
            0 => 
            array (
                'id' => 1,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 2,
                'competence_id' => 5,
            ),
            1 => 
            array (
                'id' => 2,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 2,
                'competence_id' => 4,
            ),
            2 => 
            array (
                'id' => 3,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 2,
                'competence_id' => 51,
            ),
            3 => 
            array (
                'id' => 4,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 2,
                'competence_id' => 11,
            ),
            4 => 
            array (
                'id' => 5,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 3,
                'competence_id' => 51,
            ),
            5 => 
            array (
                'id' => 6,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 3,
                'competence_id' => 24,
            ),
            6 => 
            array (
                'id' => 7,
                'created_at' => '2026-04-25 00:01:56',
                'updated_at' => '2026-04-25 00:01:56',
                'projet_id' => 3,
                'competence_id' => 42,
            ),
            7 => 
            array (
                'id' => 8,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 4,
                'competence_id' => 61,
            ),
            8 => 
            array (
                'id' => 9,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 4,
                'competence_id' => 17,
            ),
            9 => 
            array (
                'id' => 10,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 4,
                'competence_id' => 10,
            ),
            10 => 
            array (
                'id' => 11,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 4,
                'competence_id' => 73,
            ),
            11 => 
            array (
                'id' => 12,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 5,
                'competence_id' => 27,
            ),
            12 => 
            array (
                'id' => 13,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 5,
                'competence_id' => 49,
            ),
            13 => 
            array (
                'id' => 14,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 5,
                'competence_id' => 23,
            ),
            14 => 
            array (
                'id' => 15,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 6,
                'competence_id' => 54,
            ),
            15 => 
            array (
                'id' => 16,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 6,
                'competence_id' => 64,
            ),
            16 => 
            array (
                'id' => 17,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 6,
                'competence_id' => 46,
            ),
            17 => 
            array (
                'id' => 18,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 6,
                'competence_id' => 33,
            ),
            18 => 
            array (
                'id' => 19,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 7,
                'competence_id' => 3,
            ),
            19 => 
            array (
                'id' => 20,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 7,
                'competence_id' => 63,
            ),
            20 => 
            array (
                'id' => 21,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 7,
                'competence_id' => 64,
            ),
            21 => 
            array (
                'id' => 22,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 8,
                'competence_id' => 49,
            ),
            22 => 
            array (
                'id' => 23,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 8,
                'competence_id' => 47,
            ),
            23 => 
            array (
                'id' => 24,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 9,
                'competence_id' => 55,
            ),
            24 => 
            array (
                'id' => 25,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 9,
                'competence_id' => 58,
            ),
            25 => 
            array (
                'id' => 26,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 9,
                'competence_id' => 72,
            ),
            26 => 
            array (
                'id' => 27,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 9,
                'competence_id' => 4,
            ),
            27 => 
            array (
                'id' => 28,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 10,
                'competence_id' => 30,
            ),
            28 => 
            array (
                'id' => 29,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 10,
                'competence_id' => 5,
            ),
            29 => 
            array (
                'id' => 30,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 10,
                'competence_id' => 38,
            ),
            30 => 
            array (
                'id' => 31,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 10,
                'competence_id' => 25,
            ),
            31 => 
            array (
                'id' => 32,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 11,
                'competence_id' => 30,
            ),
            32 => 
            array (
                'id' => 33,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 11,
                'competence_id' => 47,
            ),
            33 => 
            array (
                'id' => 34,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 11,
                'competence_id' => 28,
            ),
            34 => 
            array (
                'id' => 35,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 11,
                'competence_id' => 52,
            ),
            35 => 
            array (
                'id' => 36,
                'created_at' => '2026-04-25 00:01:57',
                'updated_at' => '2026-04-25 00:01:57',
                'projet_id' => 11,
                'competence_id' => 5,
            ),
            36 => 
            array (
                'id' => 37,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 12,
                'competence_id' => 32,
            ),
            37 => 
            array (
                'id' => 38,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 12,
                'competence_id' => 44,
            ),
            38 => 
            array (
                'id' => 39,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 12,
                'competence_id' => 2,
            ),
            39 => 
            array (
                'id' => 40,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 12,
                'competence_id' => 7,
            ),
            40 => 
            array (
                'id' => 41,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 12,
                'competence_id' => 15,
            ),
            41 => 
            array (
                'id' => 42,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 13,
                'competence_id' => 44,
            ),
            42 => 
            array (
                'id' => 43,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 13,
                'competence_id' => 2,
            ),
            43 => 
            array (
                'id' => 44,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 13,
                'competence_id' => 15,
            ),
            44 => 
            array (
                'id' => 45,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 13,
                'competence_id' => 7,
            ),
            45 => 
            array (
                'id' => 46,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 14,
                'competence_id' => 15,
            ),
            46 => 
            array (
                'id' => 47,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 14,
                'competence_id' => 7,
            ),
            47 => 
            array (
                'id' => 48,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 14,
                'competence_id' => 44,
            ),
            48 => 
            array (
                'id' => 49,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 14,
                'competence_id' => 8,
            ),
            49 => 
            array (
                'id' => 50,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 14,
                'competence_id' => 2,
            ),
            50 => 
            array (
                'id' => 51,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 15,
                'competence_id' => 36,
            ),
            51 => 
            array (
                'id' => 52,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 15,
                'competence_id' => 37,
            ),
            52 => 
            array (
                'id' => 53,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 15,
                'competence_id' => 74,
            ),
            53 => 
            array (
                'id' => 54,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 15,
                'competence_id' => 61,
            ),
            54 => 
            array (
                'id' => 55,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 16,
                'competence_id' => 37,
            ),
            55 => 
            array (
                'id' => 56,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 16,
                'competence_id' => 74,
            ),
            56 => 
            array (
                'id' => 57,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 16,
                'competence_id' => 4,
            ),
            57 => 
            array (
                'id' => 58,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 16,
                'competence_id' => 73,
            ),
            58 => 
            array (
                'id' => 59,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 16,
                'competence_id' => 61,
            ),
            59 => 
            array (
                'id' => 60,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 17,
                'competence_id' => 37,
            ),
            60 => 
            array (
                'id' => 61,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 17,
                'competence_id' => 74,
            ),
            61 => 
            array (
                'id' => 62,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 17,
                'competence_id' => 61,
            ),
            62 => 
            array (
                'id' => 63,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 17,
                'competence_id' => 4,
            ),
            63 => 
            array (
                'id' => 64,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 17,
                'competence_id' => 36,
            ),
            64 => 
            array (
                'id' => 65,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 18,
                'competence_id' => 2,
            ),
            65 => 
            array (
                'id' => 66,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 18,
                'competence_id' => 3,
            ),
            66 => 
            array (
                'id' => 67,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 18,
                'competence_id' => 31,
            ),
            67 => 
            array (
                'id' => 68,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 18,
                'competence_id' => 1,
            ),
            68 => 
            array (
                'id' => 69,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 18,
                'competence_id' => 49,
            ),
            69 => 
            array (
                'id' => 70,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 19,
                'competence_id' => 64,
            ),
            70 => 
            array (
                'id' => 71,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 19,
                'competence_id' => 49,
            ),
            71 => 
            array (
                'id' => 72,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 19,
                'competence_id' => 59,
            ),
            72 => 
            array (
                'id' => 73,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 20,
                'competence_id' => 59,
            ),
            73 => 
            array (
                'id' => 74,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 20,
                'competence_id' => 15,
            ),
            74 => 
            array (
                'id' => 75,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 20,
                'competence_id' => 64,
            ),
            75 => 
            array (
                'id' => 76,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 21,
                'competence_id' => 21,
            ),
            76 => 
            array (
                'id' => 77,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 21,
                'competence_id' => 33,
            ),
            77 => 
            array (
                'id' => 78,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 21,
                'competence_id' => 58,
            ),
            78 => 
            array (
                'id' => 79,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 21,
                'competence_id' => 66,
            ),
            79 => 
            array (
                'id' => 80,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 21,
                'competence_id' => 30,
            ),
            80 => 
            array (
                'id' => 81,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 22,
                'competence_id' => 3,
            ),
            81 => 
            array (
                'id' => 82,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 22,
                'competence_id' => 33,
            ),
            82 => 
            array (
                'id' => 83,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 22,
                'competence_id' => 29,
            ),
            83 => 
            array (
                'id' => 84,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 22,
                'competence_id' => 54,
            ),
            84 => 
            array (
                'id' => 85,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 23,
                'competence_id' => 72,
            ),
            85 => 
            array (
                'id' => 86,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 23,
                'competence_id' => 68,
            ),
            86 => 
            array (
                'id' => 87,
                'created_at' => '2026-04-25 00:01:58',
                'updated_at' => '2026-04-25 00:01:58',
                'projet_id' => 23,
                'competence_id' => 15,
            ),
            87 => 
            array (
                'id' => 88,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 24,
                'competence_id' => 74,
            ),
            88 => 
            array (
                'id' => 89,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 24,
                'competence_id' => 66,
            ),
            89 => 
            array (
                'id' => 90,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 24,
                'competence_id' => 53,
            ),
            90 => 
            array (
                'id' => 91,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 24,
                'competence_id' => 19,
            ),
            91 => 
            array (
                'id' => 92,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 25,
                'competence_id' => 7,
            ),
            92 => 
            array (
                'id' => 93,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 25,
                'competence_id' => 16,
            ),
            93 => 
            array (
                'id' => 94,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 25,
                'competence_id' => 67,
            ),
            94 => 
            array (
                'id' => 95,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 26,
                'competence_id' => 71,
            ),
            95 => 
            array (
                'id' => 96,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 26,
                'competence_id' => 55,
            ),
            96 => 
            array (
                'id' => 97,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 27,
                'competence_id' => 38,
            ),
            97 => 
            array (
                'id' => 98,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 27,
                'competence_id' => 69,
            ),
            98 => 
            array (
                'id' => 99,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 27,
                'competence_id' => 51,
            ),
            99 => 
            array (
                'id' => 100,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 28,
                'competence_id' => 22,
            ),
            100 => 
            array (
                'id' => 101,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 28,
                'competence_id' => 38,
            ),
            101 => 
            array (
                'id' => 102,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 28,
                'competence_id' => 24,
            ),
            102 => 
            array (
                'id' => 103,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 28,
                'competence_id' => 20,
            ),
            103 => 
            array (
                'id' => 104,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 29,
                'competence_id' => 61,
            ),
            104 => 
            array (
                'id' => 105,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 29,
                'competence_id' => 28,
            ),
            105 => 
            array (
                'id' => 106,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 29,
                'competence_id' => 5,
            ),
            106 => 
            array (
                'id' => 107,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 29,
                'competence_id' => 20,
            ),
            107 => 
            array (
                'id' => 108,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 30,
                'competence_id' => 10,
            ),
            108 => 
            array (
                'id' => 109,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 30,
                'competence_id' => 20,
            ),
            109 => 
            array (
                'id' => 110,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 30,
                'competence_id' => 25,
            ),
            110 => 
            array (
                'id' => 111,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 30,
                'competence_id' => 61,
            ),
            111 => 
            array (
                'id' => 112,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 30,
                'competence_id' => 2,
            ),
            112 => 
            array (
                'id' => 113,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 31,
                'competence_id' => 20,
            ),
            113 => 
            array (
                'id' => 114,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 31,
                'competence_id' => 61,
            ),
            114 => 
            array (
                'id' => 115,
                'created_at' => '2026-04-25 00:01:59',
                'updated_at' => '2026-04-25 00:01:59',
                'projet_id' => 31,
                'competence_id' => 5,
            ),
            115 => 
            array (
                'id' => 116,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 32,
                'competence_id' => 46,
            ),
            116 => 
            array (
                'id' => 117,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 32,
                'competence_id' => 54,
            ),
            117 => 
            array (
                'id' => 118,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 33,
                'competence_id' => 22,
            ),
            118 => 
            array (
                'id' => 119,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 33,
                'competence_id' => 25,
            ),
            119 => 
            array (
                'id' => 120,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 33,
                'competence_id' => 3,
            ),
            120 => 
            array (
                'id' => 121,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 33,
                'competence_id' => 21,
            ),
            121 => 
            array (
                'id' => 122,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 34,
                'competence_id' => 9,
            ),
            122 => 
            array (
                'id' => 123,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 34,
                'competence_id' => 2,
            ),
            123 => 
            array (
                'id' => 124,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 34,
                'competence_id' => 4,
            ),
            124 => 
            array (
                'id' => 125,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 34,
                'competence_id' => 11,
            ),
            125 => 
            array (
                'id' => 126,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 34,
                'competence_id' => 50,
            ),
            126 => 
            array (
                'id' => 127,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 35,
                'competence_id' => 62,
            ),
            127 => 
            array (
                'id' => 128,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 35,
                'competence_id' => 1,
            ),
            128 => 
            array (
                'id' => 129,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 35,
                'competence_id' => 70,
            ),
            129 => 
            array (
                'id' => 130,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 35,
                'competence_id' => 42,
            ),
            130 => 
            array (
                'id' => 131,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 36,
                'competence_id' => 53,
            ),
            131 => 
            array (
                'id' => 132,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 36,
                'competence_id' => 38,
            ),
            132 => 
            array (
                'id' => 133,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 36,
                'competence_id' => 70,
            ),
            133 => 
            array (
                'id' => 134,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 37,
                'competence_id' => 46,
            ),
            134 => 
            array (
                'id' => 135,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 37,
                'competence_id' => 44,
            ),
            135 => 
            array (
                'id' => 136,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 37,
                'competence_id' => 36,
            ),
            136 => 
            array (
                'id' => 137,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 37,
                'competence_id' => 13,
            ),
            137 => 
            array (
                'id' => 138,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 38,
                'competence_id' => 36,
            ),
            138 => 
            array (
                'id' => 139,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 38,
                'competence_id' => 66,
            ),
            139 => 
            array (
                'id' => 140,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 39,
                'competence_id' => 35,
            ),
            140 => 
            array (
                'id' => 141,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 39,
                'competence_id' => 44,
            ),
            141 => 
            array (
                'id' => 142,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 39,
                'competence_id' => 13,
            ),
            142 => 
            array (
                'id' => 143,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 39,
                'competence_id' => 46,
            ),
            143 => 
            array (
                'id' => 144,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 39,
                'competence_id' => 66,
            ),
            144 => 
            array (
                'id' => 145,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 40,
                'competence_id' => 21,
            ),
            145 => 
            array (
                'id' => 146,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 40,
                'competence_id' => 1,
            ),
            146 => 
            array (
                'id' => 147,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 40,
                'competence_id' => 46,
            ),
            147 => 
            array (
                'id' => 148,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 41,
                'competence_id' => 6,
            ),
            148 => 
            array (
                'id' => 149,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 41,
                'competence_id' => 55,
            ),
            149 => 
            array (
                'id' => 150,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 41,
                'competence_id' => 20,
            ),
            150 => 
            array (
                'id' => 151,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 41,
                'competence_id' => 7,
            ),
            151 => 
            array (
                'id' => 152,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 41,
                'competence_id' => 43,
            ),
            152 => 
            array (
                'id' => 153,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 42,
                'competence_id' => 20,
            ),
            153 => 
            array (
                'id' => 154,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 42,
                'competence_id' => 60,
            ),
            154 => 
            array (
                'id' => 155,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 42,
                'competence_id' => 32,
            ),
            155 => 
            array (
                'id' => 156,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 42,
                'competence_id' => 43,
            ),
            156 => 
            array (
                'id' => 157,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 42,
                'competence_id' => 7,
            ),
            157 => 
            array (
                'id' => 158,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 43,
                'competence_id' => 41,
            ),
            158 => 
            array (
                'id' => 159,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 43,
                'competence_id' => 49,
            ),
            159 => 
            array (
                'id' => 160,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 43,
                'competence_id' => 46,
            ),
            160 => 
            array (
                'id' => 161,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 43,
                'competence_id' => 20,
            ),
            161 => 
            array (
                'id' => 162,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 43,
                'competence_id' => 5,
            ),
            162 => 
            array (
                'id' => 163,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 44,
                'competence_id' => 5,
            ),
            163 => 
            array (
                'id' => 164,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 44,
                'competence_id' => 49,
            ),
            164 => 
            array (
                'id' => 165,
                'created_at' => '2026-04-25 00:02:00',
                'updated_at' => '2026-04-25 00:02:00',
                'projet_id' => 44,
                'competence_id' => 46,
            ),
            165 => 
            array (
                'id' => 166,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 45,
                'competence_id' => 24,
            ),
            166 => 
            array (
                'id' => 167,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 45,
                'competence_id' => 61,
            ),
            167 => 
            array (
                'id' => 168,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 45,
                'competence_id' => 50,
            ),
            168 => 
            array (
                'id' => 169,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 45,
                'competence_id' => 43,
            ),
            169 => 
            array (
                'id' => 170,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 45,
                'competence_id' => 12,
            ),
            170 => 
            array (
                'id' => 171,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 46,
                'competence_id' => 36,
            ),
            171 => 
            array (
                'id' => 172,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 46,
                'competence_id' => 59,
            ),
            172 => 
            array (
                'id' => 173,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 46,
                'competence_id' => 56,
            ),
            173 => 
            array (
                'id' => 174,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 47,
                'competence_id' => 59,
            ),
            174 => 
            array (
                'id' => 175,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 47,
                'competence_id' => 36,
            ),
            175 => 
            array (
                'id' => 176,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 47,
                'competence_id' => 57,
            ),
            176 => 
            array (
                'id' => 177,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 47,
                'competence_id' => 56,
            ),
            177 => 
            array (
                'id' => 178,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 47,
                'competence_id' => 74,
            ),
            178 => 
            array (
                'id' => 179,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 48,
                'competence_id' => 70,
            ),
            179 => 
            array (
                'id' => 180,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 48,
                'competence_id' => 68,
            ),
            180 => 
            array (
                'id' => 181,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 48,
                'competence_id' => 51,
            ),
            181 => 
            array (
                'id' => 182,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 49,
                'competence_id' => 61,
            ),
            182 => 
            array (
                'id' => 183,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 49,
                'competence_id' => 10,
            ),
            183 => 
            array (
                'id' => 184,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 49,
                'competence_id' => 64,
            ),
            184 => 
            array (
                'id' => 185,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 49,
                'competence_id' => 22,
            ),
            185 => 
            array (
                'id' => 186,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 50,
                'competence_id' => 24,
            ),
            186 => 
            array (
                'id' => 187,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 50,
                'competence_id' => 61,
            ),
            187 => 
            array (
                'id' => 188,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 50,
                'competence_id' => 71,
            ),
            188 => 
            array (
                'id' => 189,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 51,
                'competence_id' => 7,
            ),
            189 => 
            array (
                'id' => 190,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 51,
                'competence_id' => 24,
            ),
            190 => 
            array (
                'id' => 191,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 51,
                'competence_id' => 64,
            ),
            191 => 
            array (
                'id' => 192,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 52,
                'competence_id' => 20,
            ),
            192 => 
            array (
                'id' => 193,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 52,
                'competence_id' => 12,
            ),
            193 => 
            array (
                'id' => 194,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 52,
                'competence_id' => 57,
            ),
            194 => 
            array (
                'id' => 195,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 53,
                'competence_id' => 64,
            ),
            195 => 
            array (
                'id' => 196,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 53,
                'competence_id' => 55,
            ),
            196 => 
            array (
                'id' => 197,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 53,
                'competence_id' => 12,
            ),
            197 => 
            array (
                'id' => 198,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 54,
                'competence_id' => 53,
            ),
            198 => 
            array (
                'id' => 199,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 54,
                'competence_id' => 68,
            ),
            199 => 
            array (
                'id' => 200,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 54,
                'competence_id' => 47,
            ),
            200 => 
            array (
                'id' => 201,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 54,
                'competence_id' => 6,
            ),
            201 => 
            array (
                'id' => 202,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 55,
                'competence_id' => 38,
            ),
            202 => 
            array (
                'id' => 203,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 55,
                'competence_id' => 6,
            ),
            203 => 
            array (
                'id' => 204,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 55,
                'competence_id' => 53,
            ),
            204 => 
            array (
                'id' => 205,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 55,
                'competence_id' => 13,
            ),
            205 => 
            array (
                'id' => 206,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 56,
                'competence_id' => 30,
            ),
            206 => 
            array (
                'id' => 207,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 56,
                'competence_id' => 6,
            ),
            207 => 
            array (
                'id' => 208,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 56,
                'competence_id' => 24,
            ),
            208 => 
            array (
                'id' => 209,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 56,
                'competence_id' => 47,
            ),
            209 => 
            array (
                'id' => 210,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 57,
                'competence_id' => 30,
            ),
            210 => 
            array (
                'id' => 211,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 57,
                'competence_id' => 43,
            ),
            211 => 
            array (
                'id' => 212,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 57,
                'competence_id' => 1,
            ),
            212 => 
            array (
                'id' => 213,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 57,
                'competence_id' => 13,
            ),
            213 => 
            array (
                'id' => 214,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 58,
                'competence_id' => 1,
            ),
            214 => 
            array (
                'id' => 215,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 58,
                'competence_id' => 61,
            ),
            215 => 
            array (
                'id' => 216,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 58,
                'competence_id' => 43,
            ),
            216 => 
            array (
                'id' => 217,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 59,
                'competence_id' => 70,
            ),
            217 => 
            array (
                'id' => 218,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 59,
                'competence_id' => 61,
            ),
            218 => 
            array (
                'id' => 219,
                'created_at' => '2026-04-25 00:02:01',
                'updated_at' => '2026-04-25 00:02:01',
                'projet_id' => 59,
                'competence_id' => 1,
            ),
            219 => 
            array (
                'id' => 220,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 60,
                'competence_id' => 15,
            ),
            220 => 
            array (
                'id' => 221,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 60,
                'competence_id' => 69,
            ),
            221 => 
            array (
                'id' => 222,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 61,
                'competence_id' => 40,
            ),
            222 => 
            array (
                'id' => 223,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 61,
                'competence_id' => 1,
            ),
            223 => 
            array (
                'id' => 224,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 62,
                'competence_id' => 32,
            ),
            224 => 
            array (
                'id' => 225,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 62,
                'competence_id' => 30,
            ),
            225 => 
            array (
                'id' => 226,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 62,
                'competence_id' => 74,
            ),
            226 => 
            array (
                'id' => 227,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 62,
                'competence_id' => 48,
            ),
            227 => 
            array (
                'id' => 228,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 62,
                'competence_id' => 51,
            ),
            228 => 
            array (
                'id' => 229,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 63,
                'competence_id' => 63,
            ),
            229 => 
            array (
                'id' => 230,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 63,
                'competence_id' => 48,
            ),
            230 => 
            array (
                'id' => 231,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 63,
                'competence_id' => 70,
            ),
            231 => 
            array (
                'id' => 232,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 64,
                'competence_id' => 32,
            ),
            232 => 
            array (
                'id' => 233,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 64,
                'competence_id' => 64,
            ),
            233 => 
            array (
                'id' => 234,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 64,
                'competence_id' => 72,
            ),
            234 => 
            array (
                'id' => 235,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 65,
                'competence_id' => 13,
            ),
            235 => 
            array (
                'id' => 236,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 65,
                'competence_id' => 52,
            ),
            236 => 
            array (
                'id' => 237,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 66,
                'competence_id' => 32,
            ),
            237 => 
            array (
                'id' => 238,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 66,
                'competence_id' => 72,
            ),
            238 => 
            array (
                'id' => 239,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 66,
                'competence_id' => 37,
            ),
            239 => 
            array (
                'id' => 240,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 66,
                'competence_id' => 13,
            ),
            240 => 
            array (
                'id' => 241,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 66,
                'competence_id' => 52,
            ),
            241 => 
            array (
                'id' => 242,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 67,
                'competence_id' => 11,
            ),
            242 => 
            array (
                'id' => 243,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 67,
                'competence_id' => 57,
            ),
            243 => 
            array (
                'id' => 244,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 67,
                'competence_id' => 8,
            ),
            244 => 
            array (
                'id' => 245,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 67,
                'competence_id' => 7,
            ),
            245 => 
            array (
                'id' => 246,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 68,
                'competence_id' => 7,
            ),
            246 => 
            array (
                'id' => 247,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 68,
                'competence_id' => 22,
            ),
            247 => 
            array (
                'id' => 248,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 68,
                'competence_id' => 43,
            ),
            248 => 
            array (
                'id' => 249,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 68,
                'competence_id' => 11,
            ),
            249 => 
            array (
                'id' => 250,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 69,
                'competence_id' => 11,
            ),
            250 => 
            array (
                'id' => 251,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 69,
                'competence_id' => 22,
            ),
            251 => 
            array (
                'id' => 252,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 69,
                'competence_id' => 43,
            ),
            252 => 
            array (
                'id' => 253,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 69,
                'competence_id' => 49,
            ),
            253 => 
            array (
                'id' => 254,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 70,
                'competence_id' => 29,
            ),
            254 => 
            array (
                'id' => 255,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 70,
                'competence_id' => 37,
            ),
            255 => 
            array (
                'id' => 256,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 71,
                'competence_id' => 74,
            ),
            256 => 
            array (
                'id' => 257,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 71,
                'competence_id' => 14,
            ),
            257 => 
            array (
                'id' => 258,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 71,
                'competence_id' => 57,
            ),
            258 => 
            array (
                'id' => 259,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 71,
                'competence_id' => 37,
            ),
            259 => 
            array (
                'id' => 260,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 72,
                'competence_id' => 21,
            ),
            260 => 
            array (
                'id' => 261,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 72,
                'competence_id' => 8,
            ),
            261 => 
            array (
                'id' => 262,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 72,
                'competence_id' => 9,
            ),
            262 => 
            array (
                'id' => 263,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 72,
                'competence_id' => 68,
            ),
            263 => 
            array (
                'id' => 264,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 73,
                'competence_id' => 43,
            ),
            264 => 
            array (
                'id' => 265,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 73,
                'competence_id' => 44,
            ),
            265 => 
            array (
                'id' => 266,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 74,
                'competence_id' => 44,
            ),
            266 => 
            array (
                'id' => 267,
                'created_at' => '2026-04-25 00:02:02',
                'updated_at' => '2026-04-25 00:02:02',
                'projet_id' => 74,
                'competence_id' => 53,
            ),
            267 => 
            array (
                'id' => 268,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 75,
                'competence_id' => 51,
            ),
            268 => 
            array (
                'id' => 269,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 75,
                'competence_id' => 8,
            ),
            269 => 
            array (
                'id' => 270,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 75,
                'competence_id' => 30,
            ),
            270 => 
            array (
                'id' => 271,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 75,
                'competence_id' => 53,
            ),
            271 => 
            array (
                'id' => 272,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 75,
                'competence_id' => 73,
            ),
            272 => 
            array (
                'id' => 273,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 76,
                'competence_id' => 53,
            ),
            273 => 
            array (
                'id' => 274,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 76,
                'competence_id' => 30,
            ),
            274 => 
            array (
                'id' => 275,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 76,
                'competence_id' => 28,
            ),
            275 => 
            array (
                'id' => 276,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 76,
                'competence_id' => 73,
            ),
            276 => 
            array (
                'id' => 277,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 77,
                'competence_id' => 8,
            ),
            277 => 
            array (
                'id' => 278,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 77,
                'competence_id' => 56,
            ),
            278 => 
            array (
                'id' => 279,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 77,
                'competence_id' => 66,
            ),
            279 => 
            array (
                'id' => 280,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 78,
                'competence_id' => 11,
            ),
            280 => 
            array (
                'id' => 281,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 78,
                'competence_id' => 62,
            ),
            281 => 
            array (
                'id' => 282,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 78,
                'competence_id' => 42,
            ),
            282 => 
            array (
                'id' => 283,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 79,
                'competence_id' => 14,
            ),
            283 => 
            array (
                'id' => 284,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 79,
                'competence_id' => 46,
            ),
            284 => 
            array (
                'id' => 285,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 80,
                'competence_id' => 13,
            ),
            285 => 
            array (
                'id' => 286,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 80,
                'competence_id' => 68,
            ),
            286 => 
            array (
                'id' => 287,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 80,
                'competence_id' => 24,
            ),
            287 => 
            array (
                'id' => 288,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 80,
                'competence_id' => 59,
            ),
            288 => 
            array (
                'id' => 289,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 80,
                'competence_id' => 14,
            ),
            289 => 
            array (
                'id' => 290,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 81,
                'competence_id' => 45,
            ),
            290 => 
            array (
                'id' => 291,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 81,
                'competence_id' => 17,
            ),
            291 => 
            array (
                'id' => 292,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 81,
                'competence_id' => 35,
            ),
            292 => 
            array (
                'id' => 293,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 82,
                'competence_id' => 69,
            ),
            293 => 
            array (
                'id' => 294,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 82,
                'competence_id' => 56,
            ),
            294 => 
            array (
                'id' => 295,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 83,
                'competence_id' => 69,
            ),
            295 => 
            array (
                'id' => 296,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 83,
                'competence_id' => 67,
            ),
            296 => 
            array (
                'id' => 297,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 84,
                'competence_id' => 55,
            ),
            297 => 
            array (
                'id' => 298,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 84,
                'competence_id' => 2,
            ),
            298 => 
            array (
                'id' => 299,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 84,
                'competence_id' => 23,
            ),
            299 => 
            array (
                'id' => 300,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 84,
                'competence_id' => 59,
            ),
            300 => 
            array (
                'id' => 301,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 85,
                'competence_id' => 25,
            ),
            301 => 
            array (
                'id' => 302,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 85,
                'competence_id' => 14,
            ),
            302 => 
            array (
                'id' => 303,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 85,
                'competence_id' => 54,
            ),
            303 => 
            array (
                'id' => 304,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 85,
                'competence_id' => 28,
            ),
            304 => 
            array (
                'id' => 305,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 85,
                'competence_id' => 52,
            ),
            305 => 
            array (
                'id' => 306,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 86,
                'competence_id' => 14,
            ),
            306 => 
            array (
                'id' => 307,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 86,
                'competence_id' => 28,
            ),
            307 => 
            array (
                'id' => 308,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 87,
                'competence_id' => 52,
            ),
            308 => 
            array (
                'id' => 309,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 87,
                'competence_id' => 14,
            ),
            309 => 
            array (
                'id' => 310,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 87,
                'competence_id' => 28,
            ),
            310 => 
            array (
                'id' => 311,
                'created_at' => '2026-04-25 00:02:03',
                'updated_at' => '2026-04-25 00:02:03',
                'projet_id' => 87,
                'competence_id' => 9,
            ),
            311 => 
            array (
                'id' => 312,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 90,
                'competence_id' => 27,
            ),
            312 => 
            array (
                'id' => 313,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 90,
                'competence_id' => 65,
            ),
            313 => 
            array (
                'id' => 314,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 90,
                'competence_id' => 55,
            ),
            314 => 
            array (
                'id' => 315,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 90,
                'competence_id' => 41,
            ),
            315 => 
            array (
                'id' => 316,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 90,
                'competence_id' => 7,
            ),
            316 => 
            array (
                'id' => 317,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 91,
                'competence_id' => 33,
            ),
            317 => 
            array (
                'id' => 318,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 91,
                'competence_id' => 54,
            ),
            318 => 
            array (
                'id' => 319,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 91,
                'competence_id' => 40,
            ),
            319 => 
            array (
                'id' => 320,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 91,
                'competence_id' => 44,
            ),
            320 => 
            array (
                'id' => 321,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 91,
                'competence_id' => 60,
            ),
            321 => 
            array (
                'id' => 322,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 92,
                'competence_id' => 15,
            ),
            322 => 
            array (
                'id' => 323,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 92,
                'competence_id' => 33,
            ),
            323 => 
            array (
                'id' => 324,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 92,
                'competence_id' => 21,
            ),
            324 => 
            array (
                'id' => 325,
                'created_at' => '2026-04-25 00:02:04',
                'updated_at' => '2026-04-25 00:02:04',
                'projet_id' => 92,
                'competence_id' => 44,
            ),
            325 => 
            array (
                'id' => 326,
                'created_at' => '2026-05-06 20:15:29',
                'updated_at' => '2026-05-06 20:15:29',
                'projet_id' => 94,
                'competence_id' => 7,
            ),
            326 => 
            array (
                'id' => 327,
                'created_at' => '2026-05-06 20:15:29',
                'updated_at' => '2026-05-06 20:15:29',
                'projet_id' => 94,
                'competence_id' => 2,
            ),
            327 => 
            array (
                'id' => 328,
                'created_at' => '2026-05-06 20:15:29',
                'updated_at' => '2026-05-06 20:15:29',
                'projet_id' => 94,
                'competence_id' => 12,
            ),
            328 => 
            array (
                'id' => 329,
                'created_at' => '2026-05-06 20:15:29',
                'updated_at' => '2026-05-06 20:15:29',
                'projet_id' => 94,
                'competence_id' => 36,
            ),
        ));
    }
}

