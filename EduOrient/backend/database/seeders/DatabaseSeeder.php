<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Données importées — schéma UML (competences, projets, héritage users).
 * Généré par transform_legacy_seeder.php — sauvegarde : DatabaseSeeder.php.backup
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('PRAGMA foreign_keys = OFF');

        DB::table('users')->insert(array (
  0 => 
  array (
    'id' => 1,
    'name' => 'eya bakkari',
    'email' => 'admin@eduorient.tn',
    'email_verified_at' => '2026-05-02 19:37:54',
    'password' => '$2y$12$G/MUvFCQ/.PDfCScpkt28OKrVtp4ieu8hWnPtdlnFhXUSo5bvpcPS',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-05-02 19:59:56',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'admin',
  ),
  1 => 
  array (
    'id' => 2,
    'name' => 'Sarra Ben Mansour',
    'email' => 'sarra.mansour@eduorient.tn',
    'email_verified_at' => '2026-05-02 18:06:07',
    'password' => '$2y$12$.V.cV.BDbjDDcb3IXR0o8eM3Lip49.2b7NpIPRqEKR8q/nBeLhpx2',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:52',
    'updated_at' => '2026-05-07 16:53:13',
    'photo' => 'profile-photos/gH4JLzt1s3aPFCyK0U03VDoQMXWEFXbXmMTMnp18.jpg',
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  2 => 
  array (
    'id' => 3,
    'name' => 'Mohamed Trabelsi',
    'email' => 'mohamed.trabelsi@eduorient.tn',
    'email_verified_at' => NULL,
    'password' => '$2y$12$UfaUmxqRq/1jlgxjTck0..zbtX0nb73vnUfu2p3z.pRtET2Bub1tK',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:52',
    'updated_at' => '2026-04-25 00:01:52',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  3 => 
  array (
    'id' => 4,
    'name' => 'Yassine Dridi',
    'email' => 'yassine.dridi@eduorient.tn',
    'email_verified_at' => NULL,
    'password' => '$2y$12$pUccLXZ10hkC14SIiXAQ.u0rmdiTLn4VCxxFsggSXdsiKmdi8KWr6',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:53',
    'updated_at' => '2026-04-25 00:01:53',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  4 => 
  array (
    'id' => 5,
    'name' => 'Amel Majri',
    'email' => 'amel.majri@eduorient.tn',
    'email_verified_at' => NULL,
    'password' => '$2y$12$LHuLwUwZjdkI3mR7jnD0peq7BVMLIBYUsVDTWiZlHXV241Y89mPmW',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:53',
    'updated_at' => '2026-04-25 00:01:53',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  5 => 
  array (
    'id' => 6,
    'name' => 'Ines Chaabane',
    'email' => 'ines.chaabane@eduorient.tn',
    'email_verified_at' => NULL,
    'password' => '$2y$12$oUnGuNEdVP3iQWILW514V.ZrcBgxqaYV4LyWRtvy2uXoduad2lGnW',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:53',
    'updated_at' => '2026-04-25 00:01:53',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  6 => 
  array (
    'id' => 7,
    'name' => 'Oussama Jbeli',
    'email' => 'recrutement@instadeep.com',
    'email_verified_at' => '2026-05-02 21:10:02',
    'password' => '$2y$12$3phrWJM0Dh0isvwFHZntUu8rGbtjUsvAFUWgwsBzdjDlASCPTAUra',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:54',
    'updated_at' => '2026-05-02 21:10:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  7 => 
  array (
    'id' => 8,
    'name' => 'Marwa Kacem',
    'email' => 'rh@vermeg.com',
    'email_verified_at' => NULL,
    'password' => '$2y$12$mCQSpqP/MdINZ8Dg4XvZJOaN/Rc8jq6eqyqEeozuDHKesDyTlNsda',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:54',
    'updated_at' => '2026-04-25 00:01:54',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  8 => 
  array (
    'id' => 9,
    'name' => 'Bilel Zouari',
    'email' => 'talent@sagemcom.com',
    'email_verified_at' => NULL,
    'password' => '$2y$12$xx0U4gECIEJmhXgQClKX4O/2aeAxJHKyOkL05jEqpNmvmflIT/R4.',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:55',
    'updated_at' => '2026-04-25 00:01:55',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  9 => 
  array (
    'id' => 10,
    'name' => 'Sirine Hammami',
    'email' => 'carrieres@sofrecom.com',
    'email_verified_at' => NULL,
    'password' => '$2y$12$wkvL20/rjSFXRmNHwvI4buUuP/L26fRqUizJytadOEC4m41CXuG4W',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:55',
    'updated_at' => '2026-04-25 00:01:55',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  10 => 
  array (
    'id' => 11,
    'name' => 'Anis Gharbi',
    'email' => 'contact@talys.tn',
    'email_verified_at' => NULL,
    'password' => '$2y$12$GQXk.H9hDqGPnAcd3PxOZeemIbdGumM9VxU9pl0kZ34QrWwJgQDTK',
    'remember_token' => NULL,
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  11 => 
  array (
    'id' => 12,
    'name' => 'Mohamed Trabelsi',
    'email' => 'mohamed.trabelsi.1@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:56',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'tjASp7c8c7',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  12 => 
  array (
    'id' => 13,
    'name' => 'Fatma Nasraoui',
    'email' => 'fatma.nasraoui.2@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:57',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'g2no1VLFp0',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  13 => 
  array (
    'id' => 14,
    'name' => 'Ines Chebbi',
    'email' => 'ines.chebbi.3@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:57',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'AhPUsIYR61',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  14 => 
  array (
    'id' => 15,
    'name' => 'Ghada Abid',
    'email' => 'ghada.abid.4@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:57',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'OCwKbcjDFN',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  15 => 
  array (
    'id' => 16,
    'name' => 'Adnen Jlassi',
    'email' => 'adnen.jlassi.5@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:57',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'sNuSprjEeb',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  16 => 
  array (
    'id' => 17,
    'name' => 'Ahmed Gharbi',
    'email' => 'ahmed.gharbi.6@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:57',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'pHRcq1dbYT',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  17 => 
  array (
    'id' => 18,
    'name' => 'Maram Zouari',
    'email' => 'maram.zouari.7@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:57',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'hBX1qGdhlF',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  18 => 
  array (
    'id' => 19,
    'name' => 'Meriem Zrelli',
    'email' => 'meriem.zrelli.8@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '2ommCLsj5M',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  19 => 
  array (
    'id' => 20,
    'name' => 'Lamia Rezgui',
    'email' => 'lamia.rezgui.9@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'Ro55dpmzjM',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  20 => 
  array (
    'id' => 21,
    'name' => 'Maram Mansour',
    'email' => 'maram.mansour.10@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'WLmcuVAyls',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  21 => 
  array (
    'id' => 22,
    'name' => 'Emna Guediri',
    'email' => 'emna.guediri.11@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '8071QUEjAt',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  22 => 
  array (
    'id' => 23,
    'name' => 'Meriem Ben Ali',
    'email' => 'meriem.ben.ali.12@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'zGjnUjwXN6',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  23 => 
  array (
    'id' => 24,
    'name' => 'Meriem Khelifi',
    'email' => 'meriem.khelifi.13@outlook.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'wRdKEZBoTs',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  24 => 
  array (
    'id' => 25,
    'name' => 'Leila Mansour',
    'email' => 'leila.mansour.14@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:58',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'q62jze1W7D',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  25 => 
  array (
    'id' => 26,
    'name' => 'Aya Mezzi',
    'email' => 'aya.mezzi.15@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:59',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'fb6NpCQk2U',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  26 => 
  array (
    'id' => 27,
    'name' => 'Meriem Hamdi',
    'email' => 'meriem.hamdi.16@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:59',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'sAsCGmoQs5',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  27 => 
  array (
    'id' => 28,
    'name' => 'Lamia Zouari',
    'email' => 'lamia.zouari.17@gmail.com',
    'email_verified_at' => '2026-04-25 00:01:59',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'gny9Hh6QuJ',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  28 => 
  array (
    'id' => 29,
    'name' => 'Emna Majri',
    'email' => 'emna.majri.18@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '0t0UTmHmLO',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  29 => 
  array (
    'id' => 30,
    'name' => 'Chaima Ben Ali',
    'email' => 'chaima.ben.ali.19@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'uPYItjlii2',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  30 => 
  array (
    'id' => 31,
    'name' => 'Fatma Dridi',
    'email' => 'fatma.dridi.20@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'kQGNBFUKef',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  31 => 
  array (
    'id' => 32,
    'name' => 'Ghada Mezzi',
    'email' => 'ghada.mezzi.21@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'sEVXp2JY3i',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  32 => 
  array (
    'id' => 33,
    'name' => 'Mehdi Ben Ammar',
    'email' => 'mehdi.ben.ammar.22@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '49WzikEQuE',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  33 => 
  array (
    'id' => 34,
    'name' => 'Tarek Hamdi',
    'email' => 'tarek.hamdi.23@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '632UT3Bl0P',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  34 => 
  array (
    'id' => 35,
    'name' => 'Adnen Baccar',
    'email' => 'adnen.baccar.24@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'AqZw4MoGn1',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  35 => 
  array (
    'id' => 36,
    'name' => 'Wassim Turki',
    'email' => 'wassim.turki.25@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'b3FTIOFVP0',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  36 => 
  array (
    'id' => 37,
    'name' => 'Nour Ayadi',
    'email' => 'nour.ayadi.26@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:00',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'neq0IeDlrn',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  37 => 
  array (
    'id' => 38,
    'name' => 'Hedi Majri',
    'email' => 'hedi.majri.27@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'WasfqAMyQu',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  38 => 
  array (
    'id' => 39,
    'name' => 'Karim Majri',
    'email' => 'karim.majri.28@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'kJ7qLDM2II',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  39 => 
  array (
    'id' => 40,
    'name' => 'Ahmed Bouazizi',
    'email' => 'ahmed.bouazizi.29@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'wFdzwD4zQf',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  40 => 
  array (
    'id' => 41,
    'name' => 'Mehdi Mezzi',
    'email' => 'mehdi.mezzi.30@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '41MmXgRalS',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  41 => 
  array (
    'id' => 42,
    'name' => 'Chaima Chebbi',
    'email' => 'chaima.chebbi.31@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'JBqYvOBNYi',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  42 => 
  array (
    'id' => 43,
    'name' => 'Mehdi Ben Ammar',
    'email' => 'mehdi.ben.ammar.32@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'ScYdovkIrL',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  43 => 
  array (
    'id' => 44,
    'name' => 'Wassim Kacem',
    'email' => 'wassim.kacem.33@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:01',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'UNkNo0no3C',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  44 => 
  array (
    'id' => 45,
    'name' => 'Yassine Ferchichi',
    'email' => 'yassine.ferchichi.34@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'lKCDtvED8I',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  45 => 
  array (
    'id' => 46,
    'name' => 'Wassim Zrelli',
    'email' => 'wassim.zrelli.35@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 's4RRSxihn3',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  46 => 
  array (
    'id' => 47,
    'name' => 'Khaled Ferchichi',
    'email' => 'khaled.ferchichi.36@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'pkL61rECI6',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  47 => 
  array (
    'id' => 48,
    'name' => 'Adnen Baccar',
    'email' => 'adnen.baccar.37@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'niHzM4FlUm',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  48 => 
  array (
    'id' => 49,
    'name' => 'Zied Miled',
    'email' => 'zied.miled.38@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'PJ64kHxa9S',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  49 => 
  array (
    'id' => 50,
    'name' => 'Hedi Chebbi',
    'email' => 'hedi.chebbi.39@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'CEKa7K7UUr',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  50 => 
  array (
    'id' => 51,
    'name' => 'Sirine Bouazizi',
    'email' => 'sirine.bouazizi.40@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '7UqHc59KFy',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  51 => 
  array (
    'id' => 52,
    'name' => 'Khaled Zrelli',
    'email' => 'khaled.zrelli.41@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'jCPmjXJBdU',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  52 => 
  array (
    'id' => 53,
    'name' => 'Anis Zouari',
    'email' => 'anis.zouari.42@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:02',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'AvqmXiI4ID',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  53 => 
  array (
    'id' => 54,
    'name' => 'Amine Bouazizi',
    'email' => 'amine.bouazizi.43@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 't9rmK2zNvs',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  54 => 
  array (
    'id' => 55,
    'name' => 'Sirine Nasraoui',
    'email' => 'sirine.nasraoui.44@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'QsdD122JoN',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  55 => 
  array (
    'id' => 56,
    'name' => 'Karim Ben Romdhane',
    'email' => 'karim.ben.romdhane.45@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'mujzXZZkfo',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  56 => 
  array (
    'id' => 57,
    'name' => 'Chaima Ben Ali',
    'email' => 'chaima.ben.ali.46@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '6QXoo69DaW',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  57 => 
  array (
    'id' => 58,
    'name' => 'Zied Dridi',
    'email' => 'zied.dridi.47@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'XTAgDICvnK',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  58 => 
  array (
    'id' => 59,
    'name' => 'Mehdi Zrelli',
    'email' => 'mehdi.zrelli.48@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'ZVkwVaU7FL',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  59 => 
  array (
    'id' => 60,
    'name' => 'Sarra Baccar',
    'email' => 'sarra.baccar.49@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:03',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'SSwGoaP0ZD',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  60 => 
  array (
    'id' => 61,
    'name' => 'Fatma Trabelsi',
    'email' => 'fatma.trabelsi.50@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'yN4LrnYg3X',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'candidat',
  ),
  61 => 
  array (
    'id' => 62,
    'name' => 'Wassim Hamdi',
    'email' => 'wassim.hamdi.51@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'kCXAaQxQGc',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  62 => 
  array (
    'id' => 63,
    'name' => 'Sami Turki',
    'email' => 'sami.turki.52@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'obadzkKXcD',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  63 => 
  array (
    'id' => 64,
    'name' => 'Rania Majri',
    'email' => 'rania.majri.53@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'Kd2mWDo46M',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  64 => 
  array (
    'id' => 65,
    'name' => 'Nesrine Baccar',
    'email' => 'nesrine.baccar.54@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'CJ4ebTPxuh',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  65 => 
  array (
    'id' => 66,
    'name' => 'Sami Ben Ali',
    'email' => 'sami.ben.ali.55@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'BWZv3W7If9',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  66 => 
  array (
    'id' => 67,
    'name' => 'Yassine Baccar',
    'email' => 'yassine.baccar.56@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'BeUbi4wp2s',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  67 => 
  array (
    'id' => 68,
    'name' => 'Maram Nasraoui',
    'email' => 'maram.nasraoui.57@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'ZP0IhcSZvX',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  68 => 
  array (
    'id' => 69,
    'name' => 'Aya Hammami',
    'email' => 'aya.hammami.58@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => '2hK2pTK9BX',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  69 => 
  array (
    'id' => 70,
    'name' => 'Skander Chaabane',
    'email' => 'skander.chaabane.59@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'bdiSWmXqHL',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  70 => 
  array (
    'id' => 71,
    'name' => 'Bilel Mezzi',
    'email' => 'bilel.mezzi.60@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 't9FCC2R4L4',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  71 => 
  array (
    'id' => 72,
    'name' => 'Leila Nasraoui',
    'email' => 'leila.nasraoui.61@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'cv89n6qCRv',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  72 => 
  array (
    'id' => 74,
    'name' => 'Ahmed Kraiem',
    'email' => 'ahmed.kraiem.63@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'Pe1R54EiiT',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  73 => 
  array (
    'id' => 75,
    'name' => 'Bilel Nasraoui',
    'email' => 'bilel.nasraoui.64@gmail.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'LEv3qGVzJZ',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  74 => 
  array (
    'id' => 76,
    'name' => 'Malek Guediri',
    'email' => 'malek.guediri.65@outlook.com',
    'email_verified_at' => '2026-04-25 00:02:04',
    'password' => '$2y$12$HAeZK9HtfAuRTMlGW.ZKW.rV.QGvyhYsjHnyQduYvp/f39BZpVLCK',
    'remember_token' => 'xqof0VSnY9',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  75 => 
  array (
    'id' => 77,
    'name' => 'test',
    'email' => 'abdennebimahamed@gmail.com',
    'email_verified_at' => '2026-05-02 17:58:59',
    'password' => '$2y$12$iJ.R62NDJ5QgZz84ZrkFXu6MNlYcekVHpMTVQbM34DBBeUkdoO9YK',
    'remember_token' => NULL,
    'created_at' => '2026-05-02 17:55:29',
    'updated_at' => '2026-05-02 17:58:59',
    'photo' => NULL,
    'preferences' => NULL,
    'role' => 'recruteur',
  ),
  76 => 
  array (
    'id' => 78,
    'name' => 'tested',
    'email' => 'test@gmail.com',
    'email_verified_at' => '2026-05-02 20:26:15',
    'password' => '$2y$12$fMwYFWYYABkufptpmco1x..lQR5eh2516QfkW/AiXgYf6d8OLn232',
    'remember_token' => NULL,
    'created_at' => '2026-05-02 20:25:53',
    'updated_at' => '2026-05-02 20:26:15',
    'photo' => 'profile-photos/fUCsBQfwtQgv706NDcbK7EDhmhJvyMfIF6PhiL0q.jpg',
    'preferences' => NULL,
    'role' => 'candidat',
  ),
));

        DB::table('candidats')->insert(array (
  0 => 
  array (
    'id' => 2,
    'bio' => 'Étudiante en génie logiciel, passionnée par le développement web.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Spécialité Génie Logiciel à ESPRIT',
    'created_at' => '2026-04-25 00:01:52',
    'updated_at' => '2026-04-25 00:01:56',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  1 => 
  array (
    'id' => 3,
    'bio' => 'Étudiant à l\'INSAT, orientation développement full stack.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Étudiant à l\'INSAT',
    'created_at' => '2026-04-25 00:01:52',
    'updated_at' => '2026-04-25 00:01:56',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  2 => 
  array (
    'id' => 4,
    'bio' => 'Formation FST, intérêt pour le mobile et le cloud.',
    'niveau_etude' => 'Master',
    'specialite' => 'FST',
    'created_at' => '2026-04-25 00:01:53',
    'updated_at' => '2026-04-25 00:01:56',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  3 => 
  array (
    'id' => 5,
    'bio' => 'Étudiante à l\'ISG, parcours systèmes d\'information.',
    'niveau_etude' => 'Licence',
    'specialite' => 'ISG',
    'created_at' => '2026-04-25 00:01:53',
    'updated_at' => '2026-04-25 00:01:53',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  4 => 
  array (
    'id' => 6,
    'bio' => 'Étudiante à ESPRIT, spécialisation data et web.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Spécialité Génie Logiciel à ESPRIT',
    'created_at' => '2026-04-25 00:01:54',
    'updated_at' => '2026-04-25 00:01:56',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  5 => 
  array (
    'id' => 12,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Eaque est animi sed temporibus non id.',
    'niveau_etude' => 'Master',
    'specialite' => 'Informatique ù INSAT',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => 'https://linkedin.com/in/mohamed-trabelsi',
    'portfolio_public' => 0,
  ),
  6 => 
  array (
    'id' => 13,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Amet quia impedit rerum sunt dolorum culpa atque.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => 'https://linkedin.com/in/fatma-nasraoui',
    'portfolio_public' => 0,
  ),
  7 => 
  array (
    'id' => 14,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Nesciunt voluptatibus adipisci eos aliquam vitae deserunt consequuntur fuga.',
    'niveau_etude' => 'Master',
    'specialite' => 'Technologies numériques ù ISET Sidi Bouzid',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => 'https://linkedin.com/in/ines-chebbi',
    'portfolio_public' => 0,
  ),
  8 => 
  array (
    'id' => 15,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Qui nesciunt voluptatum eum magnam voluptatum incidunt voluptatibus.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Informatique de gestion ù FSEG Sfax',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => 'https://linkedin.com/in/ghada-abid',
    'portfolio_public' => 0,
  ),
  9 => 
  array (
    'id' => 16,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Est quis soluta in nihil magnam rem aut molestias dolor qui nesciunt ipsam.',
    'niveau_etude' => 'Master',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  10 => 
  array (
    'id' => 17,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Quasi et placeat voluptatem aut perferendis est sed hic.',
    'niveau_etude' => 'Master',
    'specialite' => 'Génie logiciel ù ESPRIT',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  11 => 
  array (
    'id' => 18,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Inventore quasi illo quis error rerum optio.',
    'niveau_etude' => 'Master',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'linkedin' => 'https://linkedin.com/in/maram-zouari',
    'portfolio_public' => 0,
  ),
  12 => 
  array (
    'id' => 19,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Fuga velit eligendi fuga voluptates sunt et.',
    'niveau_etude' => 'Master',
    'specialite' => 'Informatique de gestion ù FSEG Sfax',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => 'https://linkedin.com/in/meriem-zrelli',
    'portfolio_public' => 0,
  ),
  13 => 
  array (
    'id' => 20,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Et quia inventore debitis quaerat sapiente eos qui magni architecto consectetur.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  14 => 
  array (
    'id' => 21,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Aut qui corporis nemo voluptatum ea tenetur quae in iusto fugiat non qui.',
    'niveau_etude' => 'Master',
    'specialite' => 'Génie informatique ù ENIT',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  15 => 
  array (
    'id' => 22,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Qui consequatur ex laudantium omnis et sed temporibus deleniti officiis quis quia.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => 'https://linkedin.com/in/emna-guediri',
    'portfolio_public' => 1,
  ),
  16 => 
  array (
    'id' => 23,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Est officia fugit officia optio dolorem eligendi omnis natus et.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => 'https://linkedin.com/in/meriem-ben-ali',
    'portfolio_public' => 0,
  ),
  17 => 
  array (
    'id' => 24,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Aut laborum molestias aspernatur ut dolores rerum molestias nulla ad qui at.',
    'niveau_etude' => 'Master',
    'specialite' => 'Génie logiciel ù ESPRIT',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => 'https://linkedin.com/in/meriem-khelifi',
    'portfolio_public' => 1,
  ),
  18 => 
  array (
    'id' => 25,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Incidunt dicta assumenda magni tenetur et ipsam.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  19 => 
  array (
    'id' => 26,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Id nulla et est molestiae consequatur et voluptatibus ipsum quia ipsum incidunt assumenda.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'linkedin' => 'https://linkedin.com/in/aya-mezzi',
    'portfolio_public' => 1,
  ),
  20 => 
  array (
    'id' => 27,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Dicta ratione repudiandae labore nesciunt culpa corrupti expedita nobis.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Génie informatique ù ENIT',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  21 => 
  array (
    'id' => 28,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exercitationem quidem corrupti amet omnis labore expedita.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Informatique de gestion ù FSEG Sfax',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  22 => 
  array (
    'id' => 29,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Projet universitaire FST : suivi des bus campus et notifications temps réel (API + Mobile). Ut consequatur distinctio veritatis voluptatem explicabo est asperiores molestias ut qui.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => 'https://linkedin.com/in/emna-majri',
    'portfolio_public' => 0,
  ),
  23 => 
  array (
    'id' => 30,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Voluptas velit sit voluptatem deserunt numquam itaque.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  24 => 
  array (
    'id' => 31,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Debitis voluptas autem fugit iure molestiae unde rerum natus consequatur pariatur amet et.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  25 => 
  array (
    'id' => 32,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Quo accusantium rem enim eum eos quasi sed.',
    'niveau_etude' => 'Master',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => 'https://linkedin.com/in/ghada-mezzi',
    'portfolio_public' => 0,
  ),
  26 => 
  array (
    'id' => 33,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Eos ullam repudiandae sed dolorem qui reiciendis eligendi incidunt cumque enim incidunt sit qui.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => 'https://linkedin.com/in/mehdi-ben-ammar',
    'portfolio_public' => 1,
  ),
  27 => 
  array (
    'id' => 34,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Magnam est iure natus est voluptas voluptatibus.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Génie informatique ù ENIT',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => 'https://linkedin.com/in/tarek-hamdi',
    'portfolio_public' => 0,
  ),
  28 => 
  array (
    'id' => 35,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Vero necessitatibus eveniet deleniti suscipit facilis sed.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => 'https://linkedin.com/in/adnen-baccar',
    'portfolio_public' => 1,
  ),
  29 => 
  array (
    'id' => 36,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Debitis repudiandae et modi commodi et adipisci eum veritatis doloribus.',
    'niveau_etude' => 'Master',
    'specialite' => 'Génie informatique ù ENIT',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  30 => 
  array (
    'id' => 37,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Earum et cupiditate harum rerum ducimus suscipit sequi sequi velit qui dolore omnis.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => 'https://linkedin.com/in/nour-ayadi',
    'portfolio_public' => 1,
  ),
  31 => 
  array (
    'id' => 38,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Veniam quia sit laborum illum ut saepe est et quaerat.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => 'https://linkedin.com/in/hedi-majri',
    'portfolio_public' => 1,
  ),
  32 => 
  array (
    'id' => 39,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Distinctio at optio voluptatibus non consequuntur quia totam nihil aut enim repellendus.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  33 => 
  array (
    'id' => 40,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Qui nisi accusamus aperiam id laboriosam deleniti repudiandae voluptates dolores fuga in beatae.',
    'niveau_etude' => 'Master',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => 'https://linkedin.com/in/ahmed-bouazizi',
    'portfolio_public' => 1,
  ),
  34 => 
  array (
    'id' => 41,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Laboriosam quibusdam commodi ea commodi non nihil quas sit quod voluptas.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => 'https://linkedin.com/in/mehdi-mezzi',
    'portfolio_public' => 1,
  ),
  35 => 
  array (
    'id' => 42,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Et qui incidunt omnis non autem labore rerum asperiores consequuntur libero.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Génie logiciel ù ESPRIT',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => 'https://linkedin.com/in/chaima-chebbi',
    'portfolio_public' => 0,
  ),
  36 => 
  array (
    'id' => 43,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Est eos ut ut fuga beatae nihil necessitatibus.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Informatique de gestion ù FSEG Sfax',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  37 => 
  array (
    'id' => 44,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Ex possimus beatae vel impedit fugit repellendus nesciunt eveniet nulla qui facilis nulla facere quis.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'linkedin' => 'https://linkedin.com/in/wassim-kacem',
    'portfolio_public' => 0,
  ),
  38 => 
  array (
    'id' => 45,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Assumenda debitis reprehenderit ea id eveniet est quam iusto voluptates.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/yassine-ferchichi',
    'portfolio_public' => 1,
  ),
  39 => 
  array (
    'id' => 46,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Esse vitae numquam eveniet commodi architecto autem perspiciatis aut voluptas.',
    'niveau_etude' => 'Master',
    'specialite' => 'Informatique de gestion ù FSEG Sfax',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  40 => 
  array (
    'id' => 47,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Non voluptas magni quas sequi aliquid dolorum dolore beatae unde necessitatibus.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Génie logiciel ù ESPRIT',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/khaled-ferchichi',
    'portfolio_public' => 1,
  ),
  41 => 
  array (
    'id' => 48,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. In qui eos consequatur eius sapiente dolorem et minima quam aliquid dignissimos quae eaque.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/adnen-baccar',
    'portfolio_public' => 0,
  ),
  42 => 
  array (
    'id' => 49,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Quasi sunt consectetur non rerum ut omnis ea ex.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Informatique ù INSAT',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/zied-miled',
    'portfolio_public' => 1,
  ),
  43 => 
  array (
    'id' => 50,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Qui sit et et dolores delectus labore esse tenetur ipsa nihil dignissimos.',
    'niveau_etude' => 'Master',
    'specialite' => 'Réseaux & télécom ù FST',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/hedi-chebbi',
    'portfolio_public' => 0,
  ),
  44 => 
  array (
    'id' => 51,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Accusamus rerum vel consectetur illo ex quidem in ex cum eum.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/sirine-bouazizi',
    'portfolio_public' => 0,
  ),
  45 => 
  array (
    'id' => 52,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Et quia quos molestias dolorum quod aut doloribus.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Génie informatique ù ENIT',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  46 => 
  array (
    'id' => 53,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Sint deleniti ad nobis quis harum aut tenetur voluptatem labore quod.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'linkedin' => 'https://linkedin.com/in/anis-zouari',
    'portfolio_public' => 0,
  ),
  47 => 
  array (
    'id' => 54,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Et est nihil incidunt ipsa vel excepturi.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Informatique ù INSAT',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => 'https://linkedin.com/in/amine-bouazizi',
    'portfolio_public' => 0,
  ),
  48 => 
  array (
    'id' => 55,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Molestiae itaque animi sit exercitationem sint eius.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Génie logiciel ù ESPRIT',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => NULL,
    'portfolio_public' => 1,
  ),
  49 => 
  array (
    'id' => 56,
    'bio' => 'Stages et PFE autour du Backend, du Frontend et du Mobile ; sensibilité aux enjeux Cloud. Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Quia aut dolorum eos eos et voluptas tempora.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => 'https://linkedin.com/in/karim-ben-romdhane',
    'portfolio_public' => 0,
  ),
  50 => 
  array (
    'id' => 57,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Vel autem minima aut doloribus sunt odio voluptatem dolore nobis.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Technologies numériques ù ISET Sidi Bouzid',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => 'https://linkedin.com/in/chaima-ben-ali',
    'portfolio_public' => 1,
  ),
  51 => 
  array (
    'id' => 58,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Iusto recusandae inventore corrupti enim earum dolores ea quae sint aut maxime.',
    'niveau_etude' => 'BTS',
    'specialite' => 'Informatique ù INSAT',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => 'https://linkedin.com/in/zied-dridi',
    'portfolio_public' => 0,
  ),
  52 => 
  array (
    'id' => 59,
    'bio' => 'Veille technologique sur l\'écosystème startup à Sfax, Tunis et Sousse. PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Vero numquam soluta consequatur architecto tempore harum et hic est.',
    'niveau_etude' => 'Ingénieur',
    'specialite' => 'Systèmes d\'information ù ISG',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
  53 => 
  array (
    'id' => 60,
    'bio' => 'Étudiant(e) en informatique, motivé(e) par les projets web et les APIs en contexte tunisien. Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Est architecto id fugit ipsam sint laborum quo.',
    'niveau_etude' => 'Licence',
    'specialite' => 'Développement web & Mobile ù ISET Sousse',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'linkedin' => 'https://linkedin.com/in/sarra-baccar',
    'portfolio_public' => 0,
  ),
  54 => 
  array (
    'id' => 61,
    'bio' => 'Participation à des projets tutorés (ISET, FST, ESPRIT) et intérêt pour l\'emploi local. Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Id eligendi voluptatem voluptate modi ducimus rerum hic.',
    'niveau_etude' => 'Master',
    'specialite' => 'Génie informatique ù ENIT',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'linkedin' => 'https://linkedin.com/in/fatma-trabelsi',
    'portfolio_public' => 0,
  ),
  55 => 
  array (
    'id' => 78,
    'bio' => 'candidate en 2 eme anne licence',
    'niveau_etude' => 'LICENCE',
    'specialite' => 'mdw',
    'created_at' => '2026-05-02 20:25:53',
    'updated_at' => '2026-05-02 20:25:53',
    'linkedin' => NULL,
    'portfolio_public' => 0,
  ),
));

        DB::table('recruteurs')->insert(array (
  0 => 
  array (
    'id' => 7,
    'entreprise' => 'Instadeep',
    'poste' => 'Responsable recrutement technique',
    'created_at' => '2026-04-25 00:01:54',
    'updated_at' => '2026-04-25 00:01:54',
    'site_web' => NULL,
    'ville' => 'Tunis',
    'gouvernorat' => 'Tunis',
    'description' => 'Instadeep est une entreprise d\'intelligence artificielle et de R&D appliquée au secteur de la santé et de la logistique. Données de démonstration EduOrient.',
  ),
  1 => 
  array (
    'id' => 8,
    'entreprise' => 'Vermeg',
    'poste' => 'Recruteur IT',
    'created_at' => '2026-04-25 00:01:54',
    'updated_at' => '2026-04-25 00:01:54',
    'site_web' => NULL,
    'ville' => 'Tunis',
    'gouvernorat' => 'Tunis',
    'description' => 'Vermeg conçoit des solutions logicielles pour les services financiers et l\'assurance en Tunisie et à l\'international. Données de démonstration EduOrient.',
  ),
  2 => 
  array (
    'id' => 9,
    'entreprise' => 'Sagemcom',
    'poste' => 'Chargé de recrutement',
    'created_at' => '2026-04-25 00:01:55',
    'updated_at' => '2026-04-25 00:01:55',
    'site_web' => NULL,
    'ville' => 'Sfax',
    'gouvernorat' => 'Sfax',
    'description' => 'Sagemcom développe des équipements et services connectés pour les opérateurs télécoms et les foyers. Données de démonstration EduOrient.',
  ),
  3 => 
  array (
    'id' => 10,
    'entreprise' => 'Sofrecom',
    'poste' => 'Responsable talents',
    'created_at' => '2026-04-25 00:01:55',
    'updated_at' => '2026-04-25 00:01:55',
    'site_web' => NULL,
    'ville' => 'Tunis',
    'gouvernorat' => 'Tunis',
    'description' => 'Sofrecom est un intégrateur de services numériques pour les télécoms et les entreprises. Données de démonstration EduOrient.',
  ),
  4 => 
  array (
    'id' => 11,
    'entreprise' => 'Talys',
    'poste' => 'Recruteur développeurs',
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
    'site_web' => NULL,
    'ville' => 'Sousse',
    'gouvernorat' => 'Sousse',
    'description' => 'Talys accompagne les entreprises en transformation digitale, développement web et cloud. Données de démonstration EduOrient.',
  ),
  5 => 
  array (
    'id' => 62,
    'entreprise' => 'STEG ù Direction SI',
    'poste' => 'Chargé de recrutement IT',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => NULL,
    'ville' => 'Centre urbain Nord',
    'gouvernorat' => 'Gabès',
    'description' => 'Et tempora cumque eum. Inventore nihil sunt non omnis numquam consequatur. Ducimus dolores asperiores vel distinctio. Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  6 => 
  array (
    'id' => 63,
    'entreprise' => 'Crystal System',
    'poste' => 'Talent Acquisition',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.crystal-system.tn',
    'ville' => 'Lac 2',
    'gouvernorat' => 'Tunis',
    'description' => 'Tempora corrupti deserunt ea corporis. Dolorum assumenda iste et nemo voluptatem et eum. Environnement startup à Sousse : stack moderne, déploiements fréquents, culture DevOps. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  7 => 
  array (
    'id' => 64,
    'entreprise' => 'Sopra Steria Tunisie',
    'poste' => 'Responsable carrières',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.sopra-steria-tunisie.tn',
    'ville' => 'Sfax',
    'gouvernorat' => 'Nabeul',
    'description' => 'Aut dolor optio velit sit dicta. In quis officiis debitis eum. Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  8 => 
  array (
    'id' => 65,
    'entreprise' => 'Steq Ingénierie',
    'poste' => 'Talent Acquisition',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.steq-ingenierie.tn',
    'ville' => 'Sousse',
    'gouvernorat' => 'Gabès',
    'description' => 'Quidem nobis consectetur quis in ea numquam mollitia. Nesciunt asperiores earum commodi officia quaerat et. Error numquam nulla officiis harum aut et et. Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  9 => 
  array (
    'id' => 66,
    'entreprise' => 'STEG ù Direction SI',
    'poste' => 'RH technique',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.steg-direction-si.tn',
    'ville' => 'Sfax',
    'gouvernorat' => 'Sousse',
    'description' => 'Eius id facere dolorem qui. Nihil aut similique ea sed et est. Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  10 => 
  array (
    'id' => 67,
    'entreprise' => 'Telnet Holding',
    'poste' => 'RH technique',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.telnet-holding.tn',
    'ville' => 'Tunis',
    'gouvernorat' => 'Sfax',
    'description' => 'Illum delectus officia et error accusantium explicabo reiciendis. Amet numquam cupiditate quisquam eos ut. Nulla distinctio dolores aut quia voluptates fugit eos. Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  11 => 
  array (
    'id' => 68,
    'entreprise' => 'Telnet Holding',
    'poste' => 'Responsable carrières',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.telnet-holding.tn',
    'ville' => 'Sfax',
    'gouvernorat' => 'Ben Arous',
    'description' => 'Temporibus facere impedit ex sapiente quaerat error. Facilis aut officiis quod quaerat. Reprehenderit quis sunt odit. Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  12 => 
  array (
    'id' => 69,
    'entreprise' => 'Banque Zitouna ù Digital',
    'poste' => 'Responsable carrières',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.banque-zitouna-digital.tn',
    'ville' => 'Lac 2',
    'gouvernorat' => 'Nabeul',
    'description' => 'Ut atque amet architecto fuga. Aut nostrum laboriosam repellat sed. Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  13 => 
  array (
    'id' => 70,
    'entreprise' => 'Medianet',
    'poste' => 'RH technique',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.medianet.tn',
    'ville' => 'Lac 2',
    'gouvernorat' => 'Sousse',
    'description' => 'Magnam enim omnis dolores aliquam vero numquam rerum. Sint dicta et et et. Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  14 => 
  array (
    'id' => 71,
    'entreprise' => 'Complys Tunisie',
    'poste' => 'Talent Acquisition',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.complys-tunisie.tn',
    'ville' => 'Sousse',
    'gouvernorat' => 'Ben Arous',
    'description' => 'Voluptas quo dolorem minus. Ea est maxime atque velit voluptatem vero harum. Nobis est ut aliquam dolor. Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  15 => 
  array (
    'id' => 72,
    'entreprise' => 'Complys Tunisie',
    'poste' => 'RH technique',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.complys-tunisie.tn',
    'ville' => 'Sfax',
    'gouvernorat' => 'Sousse',
    'description' => 'Officiis voluptate debitis alias ut aut vero qui. Neque vel excepturi enim fugiat ad qui. Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  16 => 
  array (
    'id' => 74,
    'entreprise' => 'Banque Zitouna ù Digital',
    'poste' => 'Responsable carrières',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.banque-zitouna-digital.tn',
    'ville' => 'Sousse',
    'gouvernorat' => 'Gabès',
    'description' => 'Suscipit voluptatibus ea et. Dolorem molestiae atque consequatur aspernatur. Natus facilis illum rerum ducimus modi provident. Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  17 => 
  array (
    'id' => 75,
    'entreprise' => 'Banque Zitouna ù Digital',
    'poste' => 'Responsable carrières',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => 'https://www.banque-zitouna-digital.tn',
    'ville' => 'Lac 2',
    'gouvernorat' => 'Ben Arous',
    'description' => 'Rerum delectus exercitationem fuga ut facilis accusantium illum aut. Est in repellat voluptates veritatis et dolores. Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  18 => 
  array (
    'id' => 76,
    'entreprise' => 'Softylis',
    'poste' => 'Chargé de recrutement IT',
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'site_web' => NULL,
    'ville' => 'Tunis',
    'gouvernorat' => 'Ben Arous',
    'description' => 'Voluptas quo molestias animi et voluptatum dolor sed. Omnis mollitia ex nobis ex ut adipisci et. Velit aut aut placeat quia eaque error doloremque. Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API. Activités autour du Backend, du Frontend, des APIs, du Cloud et du Mobile pour le marché tunisien.',
  ),
  19 => 
  array (
    'id' => 77,
    'entreprise' => 'baccari',
    'poste' => 'responsable recrutement',
    'created_at' => '2026-05-02 17:55:29',
    'updated_at' => '2026-05-02 17:55:29',
    'site_web' => NULL,
    'ville' => 'sidi bouzid',
    'gouvernorat' => 'Sidi Bouzid',
    'description' => 'rlbveljbvzlkef:nvlrjt;,fbdnglvk:htef',
  ),
));

        DB::table('competences')->insert(array (
  0 => 
  array (
    'id' => 1,
    'nom' => 'HTML5',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:50',
    'updated_at' => '2026-04-25 00:01:50',
  ),
  1 => 
  array (
    'id' => 2,
    'nom' => 'CSS3',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:50',
    'updated_at' => '2026-04-25 00:01:50',
  ),
  2 => 
  array (
    'id' => 3,
    'nom' => 'JavaScript (ES6+)',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:50',
    'updated_at' => '2026-04-25 00:01:50',
  ),
  3 => 
  array (
    'id' => 4,
    'nom' => 'TypeScript',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:50',
    'updated_at' => '2026-04-25 00:01:50',
  ),
  4 => 
  array (
    'id' => 5,
    'nom' => 'React.js',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:50',
    'updated_at' => '2026-04-25 00:01:50',
  ),
  5 => 
  array (
    'id' => 6,
    'nom' => 'Vue.js',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  6 => 
  array (
    'id' => 7,
    'nom' => 'Angular',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  7 => 
  array (
    'id' => 8,
    'nom' => 'Svelte',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  8 => 
  array (
    'id' => 9,
    'nom' => 'Next.js',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  9 => 
  array (
    'id' => 10,
    'nom' => 'Nuxt.js',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  10 => 
  array (
    'id' => 11,
    'nom' => 'Tailwind CSS',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  11 => 
  array (
    'id' => 12,
    'nom' => 'Bootstrap',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  12 => 
  array (
    'id' => 13,
    'nom' => 'Sass/SCSS',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  13 => 
  array (
    'id' => 14,
    'nom' => 'Material UI',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  14 => 
  array (
    'id' => 15,
    'nom' => 'DaisyUI',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  15 => 
  array (
    'id' => 16,
    'nom' => 'PHP',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  16 => 
  array (
    'id' => 17,
    'nom' => 'Node.js',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  17 => 
  array (
    'id' => 18,
    'nom' => 'Python',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  18 => 
  array (
    'id' => 19,
    'nom' => 'Java',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  19 => 
  array (
    'id' => 20,
    'nom' => 'C#',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  20 => 
  array (
    'id' => 21,
    'nom' => 'Go',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  21 => 
  array (
    'id' => 22,
    'nom' => 'Ruby',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  22 => 
  array (
    'id' => 23,
    'nom' => 'Rust',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  23 => 
  array (
    'id' => 24,
    'nom' => 'Laravel',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  24 => 
  array (
    'id' => 25,
    'nom' => 'Express.js',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  25 => 
  array (
    'id' => 26,
    'nom' => 'NestJS',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  26 => 
  array (
    'id' => 27,
    'nom' => 'Django',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  27 => 
  array (
    'id' => 28,
    'nom' => 'Flask',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  28 => 
  array (
    'id' => 29,
    'nom' => 'Spring Boot',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  29 => 
  array (
    'id' => 30,
    'nom' => 'ASP.NET Core',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  30 => 
  array (
    'id' => 31,
    'nom' => 'REST API',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  31 => 
  array (
    'id' => 32,
    'nom' => 'GraphQL',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  32 => 
  array (
    'id' => 33,
    'nom' => 'WebSockets',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  33 => 
  array (
    'id' => 34,
    'nom' => 'gRPC',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  34 => 
  array (
    'id' => 35,
    'nom' => 'React Native',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  35 => 
  array (
    'id' => 36,
    'nom' => 'Flutter',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  36 => 
  array (
    'id' => 37,
    'nom' => 'Expo',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  37 => 
  array (
    'id' => 38,
    'nom' => 'Ionic',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  38 => 
  array (
    'id' => 39,
    'nom' => 'Kotlin (Android)',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  39 => 
  array (
    'id' => 40,
    'nom' => 'Swift (iOS)',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  40 => 
  array (
    'id' => 41,
    'nom' => 'Objective-C',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  41 => 
  array (
    'id' => 42,
    'nom' => 'MySQL',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  42 => 
  array (
    'id' => 43,
    'nom' => 'PostgreSQL',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  43 => 
  array (
    'id' => 44,
    'nom' => 'MariaDB',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  44 => 
  array (
    'id' => 45,
    'nom' => 'SQL Server',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  45 => 
  array (
    'id' => 46,
    'nom' => 'SQLite',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  46 => 
  array (
    'id' => 47,
    'nom' => 'MongoDB',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  47 => 
  array (
    'id' => 48,
    'nom' => 'Firebase Firestore',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  48 => 
  array (
    'id' => 49,
    'nom' => 'Redis',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  49 => 
  array (
    'id' => 50,
    'nom' => 'Cassandra',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  50 => 
  array (
    'id' => 51,
    'nom' => 'Docker',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  51 => 
  array (
    'id' => 52,
    'nom' => 'Kubernetes',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  52 => 
  array (
    'id' => 53,
    'nom' => 'Git',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  53 => 
  array (
    'id' => 54,
    'nom' => 'GitHub Actions',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  54 => 
  array (
    'id' => 55,
    'nom' => 'GitLab CI/CD',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  55 => 
  array (
    'id' => 56,
    'nom' => 'Jenkins',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  56 => 
  array (
    'id' => 57,
    'nom' => 'AWS',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  57 => 
  array (
    'id' => 58,
    'nom' => 'Google Cloud (GCP)',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  58 => 
  array (
    'id' => 59,
    'nom' => 'Azure',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  59 => 
  array (
    'id' => 60,
    'nom' => 'Vercel',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  60 => 
  array (
    'id' => 61,
    'nom' => 'Netlify',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  61 => 
  array (
    'id' => 62,
    'nom' => 'TensorFlow',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  62 => 
  array (
    'id' => 63,
    'nom' => 'PyTorch',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  63 => 
  array (
    'id' => 64,
    'nom' => 'Scikit-learn',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  64 => 
  array (
    'id' => 65,
    'nom' => 'Pandas',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  65 => 
  array (
    'id' => 66,
    'nom' => 'NumPy',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  66 => 
  array (
    'id' => 67,
    'nom' => 'Machine Learning',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  67 => 
  array (
    'id' => 68,
    'nom' => 'Deep Learning',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  68 => 
  array (
    'id' => 69,
    'nom' => 'NLP (Natural Language Processing)',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  69 => 
  array (
    'id' => 70,
    'nom' => 'Figma',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  70 => 
  array (
    'id' => 71,
    'nom' => 'Adobe XD',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  71 => 
  array (
    'id' => 72,
    'nom' => 'Jest',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  72 => 
  array (
    'id' => 73,
    'nom' => 'Cypress',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  73 => 
  array (
    'id' => 74,
    'nom' => 'Postman (API Testing)',
    'categorie' => 'Technique',
    'created_at' => '2026-04-25 00:01:51',
    'updated_at' => '2026-04-25 00:01:51',
  ),
  74 => 
  array (
    'id' => 75,
    'nom' => 'Anglais',
    'categorie' => 'Langue',
    'created_at' => '2026-04-25 00:01:50',
    'updated_at' => '2026-04-25 00:01:50',
  ),
));

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

        DB::table('projets')->insert(array (
  0 => 
  array (
    'id' => 2,
    'candidat_id' => 2,
    'titre' => 'Dashboard analytique ù React.js & TypeScript',
    'description' => 'Projet tutoré ESPRIT : visualisation de données pour un laboratoire à Tunis. Composants React, appels API, déploiement Docker pour la démo. Cloud-ready.',
    'lien_github' => 'https://github.com/demo-pfe/dashboard-react-ts',
    'lien_demo' => 'https://demo-pfe.tn/sarra-dashboard',
    'date_debut' => '2025-11-01 00:00:00',
    'date_fin' => '2026-03-25 00:01:56',
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
    'image' => NULL,
  ),
  1 => 
  array (
    'id' => 3,
    'candidat_id' => 2,
    'titre' => 'CI/CD & conteneurisation ù API stages (Tunisie)',
    'description' => 'Mise en place GitHub Actions, images Docker et documentation pour une API de gestion des stages (contexte ISET / entreprises tunisiennes). DevOps, Backend, Mobile (client léger).',
    'lien_github' => 'https://github.com/demo-pfe/api-stages-docker',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-01 00:00:00',
    'date_fin' => '2026-03-25 00:01:56',
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
    'image' => NULL,
  ),
  2 => 
  array (
    'id' => 4,
    'candidat_id' => 12,
    'titre' => 'Microservices de facturation',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Dignissimos qui consectetur temporibus nam. Voluptatem quasi et adipisci consequuntur. Facilis velit autem est reprehenderit.',
    'lien_github' => 'https://github.com/repo-ughxfijcxa',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-03 22:13:45',
    'date_fin' => '2026-03-31 19:50:40',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  3 => 
  array (
    'id' => 5,
    'candidat_id' => 13,
    'titre' => 'Backend Laravel ù authentification & rôles',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Voluptatem et qui modi exercitationem perspiciatis. Qui voluptas et accusamus placeat quo.',
    'lien_github' => 'https://github.com/repo-izfi9oudsh',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-03 12:05:38',
    'date_fin' => '2026-04-21 15:12:46',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  4 => 
  array (
    'id' => 6,
    'candidat_id' => 14,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Itaque consequuntur non et repellendus et a qui. Et aliquid error aspernatur minus earum.',
    'lien_github' => 'https://github.com/repo-is5vlmdgca',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-02 22:45:38',
    'date_fin' => '2026-03-29 13:41:01',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  5 => 
  array (
    'id' => 7,
    'candidat_id' => 14,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Veniam dicta voluptatum tempora et illo iure. Sequi non ut magni labore consequuntur dolorum inventore. Sit neque modi sint et non eligendi.',
    'lien_github' => 'https://github.com/repo-fkdeytpgu0',
    'lien_demo' => 'https://demo-pfe.tn/repo-fkdeytpgu0',
    'date_debut' => '2026-01-20 05:59:19',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  6 => 
  array (
    'id' => 8,
    'candidat_id' => 15,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Provident veniam doloremque et odit cum delectus. Repellendus ratione minus minus ipsum.',
    'lien_github' => 'https://github.com/repo-yybretqfk7',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-24 23:53:51',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  7 => 
  array (
    'id' => 9,
    'candidat_id' => 16,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Atque aut et doloribus atque perspiciatis. Quaerat id consequatur non dolorem sit tempora eos. Corrupti eos laboriosam et ut.',
    'lien_github' => 'https://github.com/repo-1bmkbdqeur',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-06 08:53:34',
    'date_fin' => '2026-04-15 03:50:29',
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  8 => 
  array (
    'id' => 10,
    'candidat_id' => 17,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Asperiores libero aliquam magni. Et et temporibus molestias voluptatem et nam quisquam qui.',
    'lien_github' => 'https://github.com/repo-4jyyrdg43e',
    'lien_demo' => NULL,
    'date_debut' => '2025-12-07 10:56:51',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  9 => 
  array (
    'id' => 11,
    'candidat_id' => 17,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Consectetur magni omnis sit fugit vel. Officia enim dolores suscipit.',
    'lien_github' => 'https://github.com/repo-k9uzxoxc3t',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-24 18:51:37',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:57',
    'updated_at' => '2026-04-25 00:01:57',
    'image' => NULL,
  ),
  10 => 
  array (
    'id' => 12,
    'candidat_id' => 18,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Sit eos quia ipsam vero sit reiciendis. Quia et qui quis eaque non suscipit saepe.',
    'lien_github' => 'https://github.com/repo-2buqchl3i4',
    'lien_demo' => 'https://demo-pfe.tn/repo-2buqchl3i4',
    'date_debut' => '2025-07-18 14:09:54',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  11 => 
  array (
    'id' => 13,
    'candidat_id' => 18,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Vel dignissimos maiores non accusamus. Ad occaecati facere id voluptas a. In sequi ex voluptatem omnis possimus quis nam.',
    'lien_github' => 'https://github.com/repo-jqufzmggjo',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-13 07:37:27',
    'date_fin' => '2026-03-27 12:50:24',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  12 => 
  array (
    'id' => 14,
    'candidat_id' => 18,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Sint est amet dolorum sit ut. Ea sed quia consequatur soluta qui est laudantium corporis. Aspernatur est quisquam eius molestias qui.',
    'lien_github' => 'https://github.com/repo-xchu7meizp',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-08 14:20:19',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  13 => 
  array (
    'id' => 15,
    'candidat_id' => 19,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Aut iste aspernatur aliquid. Non quidem qui labore officiis.',
    'lien_github' => 'https://github.com/repo-ag5vq1nxdd',
    'lien_demo' => 'https://demo-pfe.tn/repo-ag5vq1nxdd',
    'date_debut' => '2026-02-10 00:52:32',
    'date_fin' => '2026-04-02 21:59:55',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  14 => 
  array (
    'id' => 16,
    'candidat_id' => 19,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Beatae explicabo et et atque. Molestias porro doloremque quod enim est. Cupiditate vero quia nesciunt enim cum quia eveniet.',
    'lien_github' => 'https://github.com/repo-jdlhidpbou',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-24 12:44:56',
    'date_fin' => '2026-03-31 16:26:36',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  15 => 
  array (
    'id' => 17,
    'candidat_id' => 19,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Voluptas eligendi iure dignissimos error accusantium id. Est vitae consectetur molestias hic voluptas autem et.',
    'lien_github' => 'https://github.com/repo-knrepcicxt',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-12 07:10:36',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  16 => 
  array (
    'id' => 18,
    'candidat_id' => 20,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Error porro error voluptas maxime omnis quis. Veritatis est eveniet ut qui.',
    'lien_github' => 'https://github.com/repo-eqzp1syxy3',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-26 06:13:18',
    'date_fin' => '2026-04-07 08:00:19',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  17 => 
  array (
    'id' => 19,
    'candidat_id' => 21,
    'titre' => 'Module Frontend React + design system',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Dolorem dicta et iste repellendus alias sint odit. Temporibus fuga est blanditiis odio. Sequi itaque et eligendi occaecati voluptatem.',
    'lien_github' => 'https://github.com/repo-vx1cjkpeqx',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-26 02:03:11',
    'date_fin' => '2026-03-25 02:08:55',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  18 => 
  array (
    'id' => 20,
    'candidat_id' => 22,
    'titre' => 'Microservices de facturation',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Omnis omnis voluptas harum aut quis et id. Et sequi dolor possimus quas.',
    'lien_github' => 'https://github.com/repo-7ftzfcohvd',
    'lien_demo' => 'https://demo-pfe.tn/repo-7ftzfcohvd',
    'date_debut' => '2025-08-14 21:28:42',
    'date_fin' => '2026-04-14 14:01:47',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  19 => 
  array (
    'id' => 21,
    'candidat_id' => 23,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Corrupti molestiae harum voluptatum. Ipsa occaecati numquam atque ut quisquam. Suscipit qui atque unde possimus repellendus rerum illo.',
    'lien_github' => 'https://github.com/repo-l1hkkzxt3y',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-07 21:30:22',
    'date_fin' => '2026-04-13 07:19:46',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  20 => 
  array (
    'id' => 22,
    'candidat_id' => 23,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Debitis voluptas veniam tenetur. Nisi consequatur ad sit omnis sit.',
    'lien_github' => 'https://github.com/repo-yc10stplx5',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-26 22:47:53',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  21 => 
  array (
    'id' => 23,
    'candidat_id' => 24,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Minima sunt blanditiis illum similique. Tempora eius est hic et molestiae dolorum. Dolores cumque rerum excepturi corrupti.',
    'lien_github' => 'https://github.com/repo-fz5mxikn2s',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-07 22:25:14',
    'date_fin' => '2026-04-05 13:33:58',
    'created_at' => '2026-04-25 00:01:58',
    'updated_at' => '2026-04-25 00:01:58',
    'image' => NULL,
  ),
  22 => 
  array (
    'id' => 24,
    'candidat_id' => 25,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Autem velit reprehenderit debitis mollitia eligendi ut. Non a eveniet officiis impedit autem eos voluptatem quibusdam. Illo tempora et eos.',
    'lien_github' => 'https://github.com/repo-4rrs84oib8',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-04 02:47:42',
    'date_fin' => '2026-04-14 04:32:39',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  23 => 
  array (
    'id' => 25,
    'candidat_id' => 26,
    'titre' => 'Application mobile de livraison',
    'description' => 'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Aut qui asperiores rerum consequatur. Est consequatur velit ipsum quos consequuntur illo molestias.',
    'lien_github' => 'https://github.com/repo-y7rtk9gcwd',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-28 02:18:38',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  24 => 
  array (
    'id' => 26,
    'candidat_id' => 27,
    'titre' => 'Microservices de facturation',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. At est nobis asperiores voluptate fuga nesciunt. Alias doloremque expedita quam qui quaerat. Soluta impedit ullam molestias eveniet mollitia illo.',
    'lien_github' => 'https://github.com/repo-icy6bwq9vm',
    'lien_demo' => 'https://demo-pfe.tn/repo-icy6bwq9vm',
    'date_debut' => '2025-09-30 16:59:58',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  25 => 
  array (
    'id' => 27,
    'candidat_id' => 27,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quibusdam quidem sint facilis at aliquam ab. Porro labore veniam consequuntur ducimus qui debitis.',
    'lien_github' => 'https://github.com/repo-tmfqnkdb2b',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-02 13:52:24',
    'date_fin' => '2026-04-06 23:19:31',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  26 => 
  array (
    'id' => 28,
    'candidat_id' => 27,
    'titre' => 'Backend Laravel ù authentification & rôles',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Consectetur esse ea rem officia incidunt est eos. Reprehenderit qui non rerum sed. Debitis quo eaque sed illum in doloremque delectus.',
    'lien_github' => 'https://github.com/repo-xcyoipggoa',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-09 09:51:49',
    'date_fin' => '2026-04-17 23:28:30',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  27 => 
  array (
    'id' => 29,
    'candidat_id' => 28,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Voluptates inventore et autem facere tenetur et dolor. Perferendis dignissimos eius explicabo expedita sequi.',
    'lien_github' => 'https://github.com/repo-iyfxh6egln',
    'lien_demo' => 'https://demo-pfe.tn/repo-iyfxh6egln',
    'date_debut' => '2025-06-27 13:36:18',
    'date_fin' => '2026-04-16 13:19:43',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  28 => 
  array (
    'id' => 30,
    'candidat_id' => 28,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ea et ullam ea. Dolores necessitatibus sapiente omnis reprehenderit nam. Ad aliquam sequi sit reiciendis consequuntur.',
    'lien_github' => 'https://github.com/repo-zx5frtrrd3',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-02 22:44:41',
    'date_fin' => '2026-04-19 22:48:32',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  29 => 
  array (
    'id' => 31,
    'candidat_id' => 28,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Labore nam aut sunt iusto in optio. Alias dolorem qui consequatur neque aut. Nemo dolore totam voluptatem voluptatem.',
    'lien_github' => 'https://github.com/repo-t2yv2cawal',
    'lien_demo' => 'https://demo-pfe.tn/repo-t2yv2cawal',
    'date_debut' => '2025-11-15 13:05:16',
    'date_fin' => '2026-03-28 22:13:44',
    'created_at' => '2026-04-25 00:01:59',
    'updated_at' => '2026-04-25 00:01:59',
    'image' => NULL,
  ),
  30 => 
  array (
    'id' => 32,
    'candidat_id' => 29,
    'titre' => 'Dashboard analytique temps réel',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quasi saepe neque aspernatur sunt eius nihil non. Fuga est et illo quis quidem nam et.',
    'lien_github' => 'https://github.com/repo-b30mprjcls',
    'lien_demo' => 'https://demo-pfe.tn/repo-b30mprjcls',
    'date_debut' => '2025-11-13 12:06:01',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  31 => 
  array (
    'id' => 33,
    'candidat_id' => 30,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quibusdam qui dolores ut voluptatem. Et commodi dolor recusandae beatae et.',
    'lien_github' => 'https://github.com/repo-xtcu8qpb5y',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-02 21:04:10',
    'date_fin' => '2026-04-04 18:25:00',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  32 => 
  array (
    'id' => 34,
    'candidat_id' => 31,
    'titre' => 'Microservices de facturation',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quis necessitatibus quas maxime labore enim architecto. Asperiores vel reprehenderit est ea vitae dolore ut.',
    'lien_github' => 'https://github.com/repo-0lhn2kgbkp',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-19 22:06:19',
    'date_fin' => '2026-03-26 01:41:40',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  33 => 
  array (
    'id' => 35,
    'candidat_id' => 32,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ut sit ad laboriosam recusandae explicabo dolor dignissimos. Sed qui sunt rerum cum voluptas distinctio qui laudantium. Cum dolorum blanditiis eum reprehenderit sit nam.',
    'lien_github' => 'https://github.com/repo-mkaeq6hnlr',
    'lien_demo' => 'https://demo-pfe.tn/repo-mkaeq6hnlr',
    'date_debut' => '2025-10-28 23:05:49',
    'date_fin' => '2026-03-30 18:47:29',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  34 => 
  array (
    'id' => 36,
    'candidat_id' => 32,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Rerum aut expedita suscipit repellat dolorem sed. Incidunt doloremque ipsa aut deleniti reprehenderit laboriosam. Distinctio facere ut omnis omnis.',
    'lien_github' => 'https://github.com/repo-ywmega4ijz',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-08 13:11:24',
    'date_fin' => '2026-03-27 08:27:16',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  35 => 
  array (
    'id' => 37,
    'candidat_id' => 33,
    'titre' => 'Backend Laravel ù authentification & rôles',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Non nobis in eaque saepe. Consequatur ex esse accusantium vitae vel aut vel. Ut et velit quidem esse ea et.',
    'lien_github' => 'https://github.com/repo-r9nx7eggul',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-31 03:29:44',
    'date_fin' => '2026-04-23 23:44:44',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  36 => 
  array (
    'id' => 38,
    'candidat_id' => 33,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Non et voluptatem itaque sed. Aut non labore qui rerum ut.',
    'lien_github' => 'https://github.com/repo-oath73hpov',
    'lien_demo' => 'https://demo-pfe.tn/repo-oath73hpov',
    'date_debut' => '2025-10-15 23:58:06',
    'date_fin' => '2026-03-28 07:17:55',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  37 => 
  array (
    'id' => 39,
    'candidat_id' => 33,
    'titre' => 'Application mobile de livraison',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Sit nostrum numquam quia nisi laborum nisi. Vero ut voluptas neque dignissimos non.',
    'lien_github' => 'https://github.com/repo-gkadddl5ur',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-12 12:34:02',
    'date_fin' => '2026-04-19 07:09:44',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  38 => 
  array (
    'id' => 40,
    'candidat_id' => 34,
    'titre' => 'Dashboard analytique temps réel',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ad aut est qui sed. Tempore ipsam voluptatem numquam numquam. Cum officia cumque et recusandae.',
    'lien_github' => 'https://github.com/repo-9dlt6sz5vw',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-28 17:52:25',
    'date_fin' => '2026-04-03 19:13:39',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  39 => 
  array (
    'id' => 41,
    'candidat_id' => 35,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Excepturi doloribus ut velit cupiditate. Harum eos adipisci sequi quo harum est.',
    'lien_github' => 'https://github.com/repo-mnfsr1yyey',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-13 16:31:19',
    'date_fin' => '2026-04-11 09:02:57',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  40 => 
  array (
    'id' => 42,
    'candidat_id' => 35,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Dolorem quia cupiditate veniam id reiciendis. Sit modi omnis voluptas ut. Inventore dolores dolorem dolor.',
    'lien_github' => 'https://github.com/repo-0yjeg9fabk',
    'lien_demo' => 'https://demo-pfe.tn/repo-0yjeg9fabk',
    'date_debut' => '2025-10-10 13:05:30',
    'date_fin' => '2026-04-15 16:28:55',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  41 => 
  array (
    'id' => 43,
    'candidat_id' => 36,
    'titre' => 'Microservices de facturation',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Laboriosam placeat tempore nam amet voluptatem. Quia cum ad qui magnam cupiditate aut occaecati. Ipsam ea quisquam expedita.',
    'lien_github' => 'https://github.com/repo-zl6v7fi2ot',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-04 17:27:22',
    'date_fin' => '2026-04-17 17:48:49',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  42 => 
  array (
    'id' => 44,
    'candidat_id' => 36,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Sapiente incidunt velit eveniet et et dignissimos. Eius est et iste perferendis ut rem. Voluptatem illum qui dolorum.',
    'lien_github' => 'https://github.com/repo-sdhkdnom0g',
    'lien_demo' => 'https://demo-pfe.tn/repo-sdhkdnom0g',
    'date_debut' => '2025-07-30 04:27:01',
    'date_fin' => '2026-04-13 13:47:59',
    'created_at' => '2026-04-25 00:02:00',
    'updated_at' => '2026-04-25 00:02:00',
    'image' => NULL,
  ),
  43 => 
  array (
    'id' => 45,
    'candidat_id' => 37,
    'titre' => 'Microservices de facturation',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Perspiciatis qui labore qui mollitia perferendis explicabo repellat. Sequi quos iure qui unde quaerat.',
    'lien_github' => 'https://github.com/repo-oxbzuhmerk',
    'lien_demo' => 'https://demo-pfe.tn/repo-oxbzuhmerk',
    'date_debut' => '2025-11-14 09:44:44',
    'date_fin' => '2026-04-03 02:01:29',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  44 => 
  array (
    'id' => 46,
    'candidat_id' => 38,
    'titre' => 'Dashboard analytique temps réel',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ut ut dolore laboriosam assumenda totam in. Itaque vitae sed quam facilis recusandae.',
    'lien_github' => 'https://github.com/repo-qqrzhqqjca',
    'lien_demo' => 'https://demo-pfe.tn/repo-qqrzhqqjca',
    'date_debut' => '2025-11-02 14:53:02',
    'date_fin' => '2026-03-29 03:18:07',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  45 => 
  array (
    'id' => 47,
    'candidat_id' => 38,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Qui id laboriosam aperiam ratione voluptas atque aut consequatur. Sint et error ab corporis tempore consequatur.',
    'lien_github' => 'https://github.com/repo-silnwavhqn',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-23 16:24:52',
    'date_fin' => '2026-03-25 23:48:11',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  46 => 
  array (
    'id' => 48,
    'candidat_id' => 39,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Minima voluptates veniam explicabo aut qui perspiciatis ut. Dolores ipsam et ex eaque.',
    'lien_github' => 'https://github.com/repo-ou05hp9zmp',
    'lien_demo' => 'https://demo-pfe.tn/repo-ou05hp9zmp',
    'date_debut' => '2025-08-20 07:44:10',
    'date_fin' => '2026-04-09 21:48:12',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  47 => 
  array (
    'id' => 49,
    'candidat_id' => 40,
    'titre' => 'Application mobile de livraison',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Qui dolores qui inventore nobis aspernatur accusantium nulla nostrum. Sequi eligendi quia provident molestiae.',
    'lien_github' => 'https://github.com/repo-xhrugl4kx3',
    'lien_demo' => 'https://demo-pfe.tn/repo-xhrugl4kx3',
    'date_debut' => '2026-02-05 14:01:33',
    'date_fin' => '2026-03-27 16:33:09',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  48 => 
  array (
    'id' => 50,
    'candidat_id' => 40,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ex mollitia repellendus doloremque est ducimus. A sunt quibusdam voluptates est libero dolores.',
    'lien_github' => 'https://github.com/repo-g3c9xucy1e',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-16 21:53:47',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  49 => 
  array (
    'id' => 51,
    'candidat_id' => 40,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Enim dolore dicta inventore ut expedita numquam. Veniam eos inventore suscipit. Laudantium sit ad quod sit.',
    'lien_github' => 'https://github.com/repo-cfzt0vhpei',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-24 12:53:02',
    'date_fin' => '2026-04-14 19:06:41',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  50 => 
  array (
    'id' => 52,
    'candidat_id' => 41,
    'titre' => 'Microservices de facturation',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Numquam expedita doloremque ut earum assumenda. Consequatur qui in in et dolorum eligendi dolores.',
    'lien_github' => 'https://github.com/repo-toq7jopp3f',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-03 19:58:30',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  51 => 
  array (
    'id' => 53,
    'candidat_id' => 41,
    'titre' => 'Backend Laravel ù authentification & rôles',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Aliquid incidunt odio pariatur assumenda voluptatibus est ea. Et deserunt atque in vel corrupti illo. Ad molestiae molestiae non doloribus explicabo eaque adipisci et.',
    'lien_github' => 'https://github.com/repo-muikxkgnru',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-13 00:40:48',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  52 => 
  array (
    'id' => 54,
    'candidat_id' => 42,
    'titre' => 'Intégration paiement & webhooks',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Aspernatur esse sequi dolorem sunt vel voluptatem dicta aperiam. Labore pariatur exercitationem inventore provident. Omnis et ipsa dolore quo nobis dolor distinctio.',
    'lien_github' => 'https://github.com/repo-qrmeglqkfv',
    'lien_demo' => 'https://demo-pfe.tn/repo-qrmeglqkfv',
    'date_debut' => '2025-07-04 08:47:49',
    'date_fin' => '2026-03-31 22:34:52',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  53 => 
  array (
    'id' => 55,
    'candidat_id' => 42,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Id sunt architecto ratione aut qui qui. Numquam temporibus perferendis dolorem aut omnis.',
    'lien_github' => 'https://github.com/repo-qrgmhbnx1m',
    'lien_demo' => 'https://demo-pfe.tn/repo-qrgmhbnx1m',
    'date_debut' => '2025-11-22 22:19:06',
    'date_fin' => '2026-04-05 15:48:39',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  54 => 
  array (
    'id' => 56,
    'candidat_id' => 42,
    'titre' => 'Microservices de facturation',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Placeat ducimus corrupti ipsam modi facere quas quis nisi. Sit nisi illo omnis est expedita molestiae.',
    'lien_github' => 'https://github.com/repo-z3egvehx7j',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-09 02:42:07',
    'date_fin' => '2026-04-04 02:49:57',
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  55 => 
  array (
    'id' => 57,
    'candidat_id' => 43,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Dolores et et et quia quae. Dolorem quia temporibus animi quisquam eaque est totam aspernatur.',
    'lien_github' => 'https://github.com/repo-q3iwwybsfe',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-01 07:20:06',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  56 => 
  array (
    'id' => 58,
    'candidat_id' => 43,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Mollitia at illo cum quia fugit non saepe. A nihil sint nihil illo quia dicta quis. Qui non voluptatibus saepe exercitationem corporis.',
    'lien_github' => 'https://github.com/repo-lvmqsdiabq',
    'lien_demo' => 'https://demo-pfe.tn/repo-lvmqsdiabq',
    'date_debut' => '2025-12-07 10:42:25',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  57 => 
  array (
    'id' => 59,
    'candidat_id' => 43,
    'titre' => 'Dashboard analytique temps réel',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Nihil ducimus sapiente dicta excepturi impedit. Id sequi voluptates rem voluptatum in unde possimus dolores.',
    'lien_github' => 'https://github.com/repo-baaemqel1n',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-03 07:41:48',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:01',
    'updated_at' => '2026-04-25 00:02:01',
    'image' => NULL,
  ),
  58 => 
  array (
    'id' => 60,
    'candidat_id' => 44,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Libero voluptatem et et et ratione rerum. Ut ea totam suscipit esse.',
    'lien_github' => 'https://github.com/repo-gftjofjnmv',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-16 20:08:44',
    'date_fin' => '2026-03-29 05:45:49',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  59 => 
  array (
    'id' => 61,
    'candidat_id' => 44,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ab sunt quia alias ut voluptatem dolores omnis. Consequatur dolor debitis doloribus et aliquid perspiciatis. Omnis et ipsa quaerat.',
    'lien_github' => 'https://github.com/repo-lx3flyfubi',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-26 16:49:18',
    'date_fin' => '2026-04-04 19:02:10',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  60 => 
  array (
    'id' => 62,
    'candidat_id' => 45,
    'titre' => 'Application mobile de livraison',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Doloribus ratione qui inventore accusamus sit laboriosam quasi. Temporibus exercitationem voluptate tempora voluptatem veritatis unde voluptas.',
    'lien_github' => 'https://github.com/repo-9qfb3mckuu',
    'lien_demo' => NULL,
    'date_debut' => '2026-02-04 04:57:11',
    'date_fin' => '2026-04-08 01:18:33',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  61 => 
  array (
    'id' => 63,
    'candidat_id' => 46,
    'titre' => 'Microservices de facturation',
    'description' => 'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quis ea id aut veritatis. Eum deserunt ea et in. Sed perspiciatis aut possimus distinctio consequatur sunt.',
    'lien_github' => 'https://github.com/repo-0fdmsownxg',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-15 05:52:06',
    'date_fin' => '2026-04-05 23:44:15',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  62 => 
  array (
    'id' => 64,
    'candidat_id' => 47,
    'titre' => 'Module Frontend React + design system',
    'description' => 'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quas qui et id quibusdam dolorem dolor aut. Quo quis sint quisquam suscipit quia eos asperiores molestiae. Non maiores nihil quo ratione perspiciatis.',
    'lien_github' => 'https://github.com/repo-xfh6um42ke',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-16 11:21:52',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  63 => 
  array (
    'id' => 65,
    'candidat_id' => 47,
    'titre' => 'Module Frontend React + design system',
    'description' => 'Projet universitaire FST : suivi des bus campus et notifications temps réel (API + Mobile). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Et voluptates et odit. Voluptatem et possimus facilis sint ut sunt alias. Corrupti autem sed excepturi voluptates.',
    'lien_github' => 'https://github.com/repo-dpnclltnvf',
    'lien_demo' => NULL,
    'date_debut' => '2025-12-11 22:39:36',
    'date_fin' => '2026-04-15 12:16:10',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  64 => 
  array (
    'id' => 66,
    'candidat_id' => 47,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Fugiat maiores vel id quo illum quia exercitationem. Nam voluptatem id dolor accusamus mollitia.',
    'lien_github' => 'https://github.com/repo-infg0mepa8',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-29 23:50:11',
    'date_fin' => '2026-04-23 20:53:34',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  65 => 
  array (
    'id' => 67,
    'candidat_id' => 48,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Mollitia aliquam quos eos nam. Voluptatem hic vel adipisci cumque unde.',
    'lien_github' => 'https://github.com/repo-5yvbvrfzze',
    'lien_demo' => 'https://demo-pfe.tn/repo-5yvbvrfzze',
    'date_debut' => '2026-01-30 08:11:19',
    'date_fin' => '2026-04-06 16:57:01',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  66 => 
  array (
    'id' => 68,
    'candidat_id' => 48,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Est nulla vel similique consectetur placeat. Nihil sit optio tenetur omnis.',
    'lien_github' => 'https://github.com/repo-ioxd80kvle',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-14 15:38:47',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  67 => 
  array (
    'id' => 69,
    'candidat_id' => 48,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Voluptas laboriosam magni eum tenetur nobis. Quod sed fugit enim magnam sit vitae mollitia.',
    'lien_github' => 'https://github.com/repo-chj4yvtbza',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-05 15:37:03',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  68 => 
  array (
    'id' => 70,
    'candidat_id' => 49,
    'titre' => 'Backend Laravel ù authentification & rôles',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Qui est mollitia amet. Aspernatur maiores deserunt qui ut quia dicta nobis. Ipsa necessitatibus et aut ipsam voluptate ut quo.',
    'lien_github' => 'https://github.com/repo-6an8m3exrd',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-30 06:18:00',
    'date_fin' => '2026-03-29 13:44:09',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  69 => 
  array (
    'id' => 71,
    'candidat_id' => 50,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Réalisé dans le cadre d\'un projet tutoré à l\'ISET Sidi Bouzid : gestion des stages et des conventions. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Minima facere possimus ut quo aut. Sint repudiandae ex aut corporis modi.',
    'lien_github' => 'https://github.com/repo-20hboxhjbu',
    'lien_demo' => NULL,
    'date_debut' => '2025-08-13 10:24:38',
    'date_fin' => '2026-04-22 23:59:45',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  70 => 
  array (
    'id' => 72,
    'candidat_id' => 51,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Nisi dolor illum id occaecati. Quia et facere praesentium.',
    'lien_github' => 'https://github.com/repo-8gmlqcv561',
    'lien_demo' => 'https://demo-pfe.tn/repo-8gmlqcv561',
    'date_debut' => '2025-09-25 05:32:25',
    'date_fin' => '2026-04-21 13:51:51',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  71 => 
  array (
    'id' => 73,
    'candidat_id' => 52,
    'titre' => 'Application mobile de livraison',
    'description' => 'Défi national innovation : solution e-santé pour un centre à Nabeul (API sécurisée). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Et non molestiae a nisi. Voluptatem totam unde et ducimus. Nobis quis culpa aut et aliquid numquam.',
    'lien_github' => 'https://github.com/repo-5ezerftjao',
    'lien_demo' => 'https://demo-pfe.tn/repo-5ezerftjao',
    'date_debut' => '2025-10-26 20:24:13',
    'date_fin' => '2026-04-07 13:18:52',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  72 => 
  array (
    'id' => 74,
    'candidat_id' => 52,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Et voluptatum autem recusandae similique reiciendis. In qui eius blanditiis adipisci aliquid.',
    'lien_github' => 'https://github.com/repo-q6wwwtyhwc',
    'lien_demo' => 'https://demo-pfe.tn/repo-q6wwwtyhwc',
    'date_debut' => '2025-11-28 18:57:50',
    'date_fin' => '2026-04-10 09:18:25',
    'created_at' => '2026-04-25 00:02:02',
    'updated_at' => '2026-04-25 00:02:02',
    'image' => NULL,
  ),
  73 => 
  array (
    'id' => 75,
    'candidat_id' => 53,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Facilis molestiae voluptatem quos quis deserunt deleniti suscipit. Perferendis ab voluptate facilis nesciunt et.',
    'lien_github' => 'https://github.com/repo-rdkqvoy0b1',
    'lien_demo' => NULL,
    'date_debut' => '2026-01-09 12:07:07',
    'date_fin' => '2026-04-15 21:24:05',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  74 => 
  array (
    'id' => 76,
    'candidat_id' => 53,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Collaboration avec un cabinet comptable à Bizerte : portail client et exports comptables. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Ut praesentium amet explicabo corrupti qui. Enim ab rerum odio illum facere. Vel nisi magnam soluta maiores.',
    'lien_github' => 'https://github.com/repo-zxwm5w9fzo',
    'lien_demo' => NULL,
    'date_debut' => '2025-06-30 06:08:04',
    'date_fin' => '2026-03-25 23:44:50',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  75 => 
  array (
    'id' => 77,
    'candidat_id' => 54,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Hackathon « Tunis Smart City » : prototype Frontend + Backend exposant des données ouvertes. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Corrupti voluptas illo quis voluptas quia. Praesentium necessitatibus et ipsa sed omnis quibusdam delectus. Rerum nemo quae nihil.',
    'lien_github' => 'https://github.com/repo-ofndzsdbif',
    'lien_demo' => 'https://demo-pfe.tn/repo-ofndzsdbif',
    'date_debut' => '2025-09-25 06:31:47',
    'date_fin' => '2026-04-06 01:45:43',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  76 => 
  array (
    'id' => 78,
    'candidat_id' => 55,
    'titre' => 'Module Frontend React + design system',
    'description' => 'Plateforme pour une association à Kairouan : collecte en ligne et suivi des bénéficiaires. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Mollitia qui quia animi. In nobis possimus omnis quia consequuntur non fugit ut.',
    'lien_github' => 'https://github.com/repo-zpnafwx1je',
    'lien_demo' => NULL,
    'date_debut' => '2025-09-07 11:24:02',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  77 => 
  array (
    'id' => 79,
    'candidat_id' => 56,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Enim dolorem fugiat doloribus doloremque esse illum. Animi sed ut praesentium numquam repellendus.',
    'lien_github' => 'https://github.com/repo-0ykxjp8rnb',
    'lien_demo' => NULL,
    'date_debut' => '2025-07-09 17:34:04',
    'date_fin' => '2026-04-17 10:45:03',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  78 => 
  array (
    'id' => 80,
    'candidat_id' => 56,
    'titre' => 'Backend Laravel ù authentification & rôles',
    'description' => 'Projet universitaire FST : suivi des bus campus et notifications temps réel (API + Mobile). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Vitae ab doloremque distinctio rem odio doloribus voluptate dolorum. Ut quis debitis rem fugiat fugit earum. Dolorem adipisci sunt tempora dolores sed.',
    'lien_github' => 'https://github.com/repo-phbpe4fiw3',
    'lien_demo' => 'https://demo-pfe.tn/repo-phbpe4fiw3',
    'date_debut' => '2026-01-19 21:13:05',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  79 => 
  array (
    'id' => 81,
    'candidat_id' => 57,
    'titre' => 'API REST de gestion des stages',
    'description' => 'Application pour une ONG à Gabès : sensibilisation environnementale et cartographie. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Unde neque molestiae aut deleniti dolor. Eos in facere id reiciendis error fugit.',
    'lien_github' => 'https://github.com/repo-d6ppqrav4y',
    'lien_demo' => 'https://demo-pfe.tn/repo-d6ppqrav4y',
    'date_debut' => '2025-08-01 18:52:29',
    'date_fin' => '2026-03-30 11:29:49',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  80 => 
  array (
    'id' => 82,
    'candidat_id' => 57,
    'titre' => 'API REST de gestion des stages',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Aut similique amet eum suscipit tempore dolor dolorem earum. Molestiae quod porro cumque quis.',
    'lien_github' => 'https://github.com/repo-qxvlrgdswt',
    'lien_demo' => 'https://demo-pfe.tn/repo-qxvlrgdswt',
    'date_debut' => '2025-06-26 23:27:25',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  81 => 
  array (
    'id' => 83,
    'candidat_id' => 58,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Maiores est aut eos aut nisi id eum. Ut aut reiciendis ea sit officia.',
    'lien_github' => 'https://github.com/repo-1vptxuccgw',
    'lien_demo' => NULL,
    'date_debut' => '2025-11-27 14:08:13',
    'date_fin' => '2026-03-29 05:49:45',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  82 => 
  array (
    'id' => 84,
    'candidat_id' => 58,
    'titre' => 'Plateforme e-learning (SPA)',
    'description' => 'Stage à Tunis ù Les Berges du Lac : intégration d\'un module de paiement pour une fintech locale. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Quas velit sit ratione qui minima aspernatur nobis. Ut laborum labore illum incidunt harum magnam temporibus voluptatem.',
    'lien_github' => 'https://github.com/repo-e5ibr0yf1f',
    'lien_demo' => 'https://demo-pfe.tn/repo-e5ibr0yf1f',
    'date_debut' => '2026-01-29 22:28:36',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  83 => 
  array (
    'id' => 85,
    'candidat_id' => 59,
    'titre' => 'Microservices de facturation',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Qui officia qui repellendus eos qui. Pariatur quibusdam inventore perspiciatis nobis cupiditate et quas.',
    'lien_github' => 'https://github.com/repo-cmy2nl1kfz',
    'lien_demo' => NULL,
    'date_debut' => '2025-12-12 00:52:04',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  84 => 
  array (
    'id' => 86,
    'candidat_id' => 59,
    'titre' => 'Dashboard analytique temps réel',
    'description' => 'Contexte : startup tech à Sfax, besoin d\'une API et d\'un tableau de bord pour suivre les livraisons. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Et ad et vitae quibusdam nesciunt. Ut eligendi itaque ipsum totam omnis. Et voluptate qui dignissimos iure nulla eligendi aperiam.',
    'lien_github' => 'https://github.com/repo-cgxiort1g4',
    'lien_demo' => NULL,
    'date_debut' => '2025-12-09 03:04:09',
    'date_fin' => '2026-03-26 16:02:12',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  85 => 
  array (
    'id' => 87,
    'candidat_id' => 59,
    'titre' => 'Dashboard analytique temps réel',
    'description' => 'Cahier des charges fourni par une PME de Monastir : gestion de stock et facturation Cloud. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Voluptatem omnis eos nostrum deserunt. Molestias maiores ut unde facilis.',
    'lien_github' => 'https://github.com/repo-mb0tvcblgb',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-20 23:13:14',
    'date_fin' => '2026-04-13 10:56:09',
    'created_at' => '2026-04-25 00:02:03',
    'updated_at' => '2026-04-25 00:02:03',
    'image' => NULL,
  ),
  86 => 
  array (
    'id' => 90,
    'candidat_id' => 60,
    'titre' => 'Portail recruteur ù matching compétences',
    'description' => 'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Laboriosam praesentium temporibus dolorem. Qui debitis dolorem nesciunt perferendis minus autem architecto.',
    'lien_github' => 'https://github.com/repo-ma6ifjpiho',
    'lien_demo' => NULL,
    'date_debut' => '2025-10-11 18:20:39',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'image' => NULL,
  ),
  87 => 
  array (
    'id' => 91,
    'candidat_id' => 61,
    'titre' => 'Application mobile de livraison',
    'description' => 'Projet de fin d\'études sur le transport en Tunisie : optimisation des lignes et réservation Mobile. Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Neque nostrum tempora et libero est. Eum non odit deserunt accusamus nesciunt quas reiciendis ut. Impedit perferendis rerum repellendus.',
    'lien_github' => 'https://github.com/repo-dvcrpsvurn',
    'lien_demo' => 'https://demo-pfe.tn/repo-dvcrpsvurn',
    'date_debut' => '2025-09-20 23:06:56',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'image' => NULL,
  ),
  88 => 
  array (
    'id' => 92,
    'candidat_id' => 61,
    'titre' => 'CI/CD et observabilité (stack Cloud)',
    'description' => 'PFE à l\'ESPRIT : application de covoiturage inter-villes (TunisùSousseùSfax). Exposition d\'une API REST (JWT), logique Backend, interface Frontend responsive. Déploiement Cloud (Docker), tests automatisés, documentation OpenAPI. Couverture Mobile (PWA) et bonnes pratiques DevOps (CI/CD). Mots-clés : API, Backend, Frontend, Cloud, Mobile. Vel dolorem reiciendis molestiae in quis ut quos. Enim nihil quasi repudiandae omnis ut et necessitatibus. Fuga fuga facilis qui in ad molestiae magni.',
    'lien_github' => 'https://github.com/repo-ihvqyaqwme',
    'lien_demo' => 'https://demo-pfe.tn/repo-ihvqyaqwme',
    'date_debut' => '2025-07-22 18:10:55',
    'date_fin' => NULL,
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
    'image' => NULL,
  ),
  89 => 
  array (
    'id' => 94,
    'candidat_id' => 2,
    'titre' => 'Test Projet',
    'description' => 'test',
    'lien_github' => 'https://github.com',
    'lien_demo' => 'https://demo.com',
    'date_debut' => '2026-01-01 00:00:00',
    'date_fin' => '2026-03-01 00:00:00',
    'created_at' => '2026-05-06 20:15:29',
    'updated_at' => '2026-05-06 20:15:29',
    'image' => 'project-images/DQxZw50ji4EnkLqsoSieQWZQ7Tk546SaKrrTgaDQ.png',
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

        DB::table('projet_images')->insert(array (
  0 => 
  array (
    'id' => 4,
    'image_path' => 'projects/nVKOHzVWjUlYzoiBUr1VTqZW4RVgpiSQXZwZPAT7.png',
    'created_at' => '2026-05-06 20:15:29',
    'updated_at' => '2026-05-06 20:15:29',
    'projet_id' => 94,
  ),
  1 => 
  array (
    'id' => 5,
    'image_path' => 'projects/4Os17jdqfQNIsuePYoGHxJvzePVYfH76Pbri7m6K.png',
    'created_at' => '2026-05-06 20:15:29',
    'updated_at' => '2026-05-06 20:15:29',
    'projet_id' => 94,
  ),
  2 => 
  array (
    'id' => 6,
    'image_path' => 'projects/D3feCAsaLtcb5Ni4klwcZV19EC2wEQON2CgpHgpk.png',
    'created_at' => '2026-05-06 20:15:29',
    'updated_at' => '2026-05-06 20:15:29',
    'projet_id' => 94,
  ),
));

        DB::table('offres')->insert(array (
  0 => 
  array (
    'id' => 2,
    'recruteur_id' => 8,
    'titre' => 'PFE / Stage ù Développement full stack',
    'description' => 'Applications Java Spring et interfaces React au sein de nos squads assurance.',
    'type' => 'stage',
    'lieu' => 'Les Berges du Lac',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
  ),
  1 => 
  array (
    'id' => 3,
    'recruteur_id' => 8,
    'titre' => 'Emploi ù Développeur Java confirmé',
    'description' => 'Poste CDI orienté backend microservices.',
    'type' => 'emploi',
    'lieu' => 'Tunis',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
  ),
  2 => 
  array (
    'id' => 4,
    'recruteur_id' => 11,
    'titre' => 'Stage ù Développeur web Laravel / Vue',
    'description' => 'Conception d\'API Laravel et SPA Vue.js pour clients régionaux.',
    'type' => 'stage',
    'lieu' => 'Hybride',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:01:56',
    'updated_at' => '2026-04-25 00:01:56',
  ),
  3 => 
  array (
    'id' => 5,
    'recruteur_id' => 65,
    'titre' => 'Développeur Python / Django',
    'description' => 'Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Excepturi et quia fugiat aspernatur. Laboriosam aliquid eum sunt delectus reprehenderit. Quia cum dicta placeat aut perspiciatis dolore officia.',
    'type' => 'stage',
    'lieu' => 'Bizerte',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
  ),
  4 => 
  array (
    'id' => 6,
    'recruteur_id' => 64,
    'titre' => 'Développeur React / TypeScript',
    'description' => 'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Consequatur ex architecto sapiente eveniet. Eaque dolorem voluptatibus fugiat eum illo dolores qui. In vitae quis velit corporis totam sint exercitationem.',
    'type' => 'emploi',
    'lieu' => 'Tunis',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:04',
    'updated_at' => '2026-04-25 00:02:04',
  ),
  5 => 
  array (
    'id' => 7,
    'recruteur_id' => 65,
    'titre' => 'Stage sécurité & qualité API',
    'description' => 'Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). In saepe non vitae nihil facere qui. Tempora et id iure vel qui nihil. Cupiditate ea dolore eaque asperiores pariatur debitis.',
    'type' => 'emploi',
    'lieu' => 'Sfax',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:05',
    'updated_at' => '2026-04-25 00:02:05',
  ),
  6 => 
  array (
    'id' => 8,
    'recruteur_id' => 70,
    'titre' => 'Intégrateur Web ù Full stack',
    'description' => 'Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Ipsa consequatur aut dolor dolorem architecto est tempora. Quos laborum dolores ut consequuntur. Illo facere voluptate quaerat fuga.',
    'type' => 'emploi',
    'lieu' => 'Sousse',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:05',
    'updated_at' => '2026-04-25 00:02:05',
  ),
  7 => 
  array (
    'id' => 9,
    'recruteur_id' => 71,
    'titre' => 'Stage Laravel / Vue.js',
    'description' => 'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Molestiae veniam et vel qui in ea quis. Eum quia hic aut mollitia beatae delectus cupiditate.',
    'type' => 'stage',
    'lieu' => 'Bizerte',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:05',
    'updated_at' => '2026-04-25 00:02:05',
  ),
  8 => 
  array (
    'id' => 10,
    'recruteur_id' => 62,
    'titre' => 'Stage Frontend ù Design system',
    'description' => 'Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Explicabo maxime dicta quod odio. Unde dolor ea quibusdam quis sint qui.',
    'type' => 'stage',
    'lieu' => 'Bizerte',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:05',
    'updated_at' => '2026-04-25 00:02:05',
  ),
  9 => 
  array (
    'id' => 11,
    'recruteur_id' => 66,
    'titre' => 'Stage DevOps & Cloud (AWS)',
    'description' => 'Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Dignissimos aspernatur et quis nulla mollitia quia. Officia aspernatur nemo recusandae sit in. Unde eum maiores non magni accusantium aut.',
    'type' => 'emploi',
    'lieu' => 'Sfax',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-05-07 17:59:52',
  ),
  10 => 
  array (
    'id' => 12,
    'recruteur_id' => 75,
    'titre' => 'Ingénieur logiciel Java / Spring Boot',
    'description' => 'Mission en mode agile pour le secteur public (administration tunisienne) : exigences API fortes. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Reprehenderit quia quia mollitia sunt excepturi aliquid. Voluptatem magnam autem fuga maiores quidem et quibusdam. Sed laboriosam aut et.',
    'type' => 'stage',
    'lieu' => 'Tunis',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  11 => 
  array (
    'id' => 14,
    'recruteur_id' => 71,
    'titre' => 'Ingénieur Backend Node.js',
    'description' => 'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Iusto ut inventore animi unde aspernatur. Sit aut velit repellat quod omnis.',
    'type' => 'stage',
    'lieu' => 'Sousse',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  12 => 
  array (
    'id' => 15,
    'recruteur_id' => 68,
    'titre' => 'Ingénieur données & Backend',
    'description' => 'Environnement startup à Sousse : stack moderne, déploiements fréquents, culture DevOps. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Aut enim sit atque qui voluptatem rerum. Voluptatem officia amet atque reprehenderit enim autem. Dolores qui eligendi qui quis iusto libero ut.',
    'type' => 'stage',
    'lieu' => 'Remote (Tunisie)',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  13 => 
  array (
    'id' => 16,
    'recruteur_id' => 67,
    'titre' => 'Développeur Mobile Flutter',
    'description' => 'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Sequi ipsa voluptatem et ducimus. Nemo commodi in vel dolores et exercitationem est. Rerum molestiae sit earum at minus.',
    'type' => 'stage',
    'lieu' => 'Nabeul',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  14 => 
  array (
    'id' => 17,
    'recruteur_id' => 63,
    'titre' => 'Développeur Angular ù applications métier',
    'description' => 'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Culpa corrupti dolor quae et quidem et libero. Praesentium aut aut vero vitae sapiente voluptatem quia. Veritatis sunt suscipit labore in quibusdam.',
    'type' => 'stage',
    'lieu' => 'Sousse',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  15 => 
  array (
    'id' => 18,
    'recruteur_id' => 72,
    'titre' => 'Ingénieur logiciel Java / Spring Boot',
    'description' => 'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Odit non reprehenderit omnis est. Reiciendis reprehenderit libero voluptatem quia possimus dolores rerum.',
    'type' => 'stage',
    'lieu' => 'Bizerte',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  16 => 
  array (
    'id' => 19,
    'recruteur_id' => 62,
    'titre' => 'Développeur Python / Django',
    'description' => 'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Doloribus magnam consequuntur porro voluptas recusandae ea voluptas placeat. Sequi consequatur porro provident exercitationem maiores cum.',
    'type' => 'stage',
    'lieu' => 'Sousse',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  17 => 
  array (
    'id' => 21,
    'recruteur_id' => 68,
    'titre' => 'Développeur Angular ù applications métier',
    'description' => 'Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Eos consequatur culpa at vel corporis mollitia quod. Velit nostrum pariatur similique et magni. Magnam dolorum assumenda possimus eum ipsum aperiam pariatur.',
    'type' => 'stage',
    'lieu' => 'Hybride ù Tunis',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  18 => 
  array (
    'id' => 22,
    'recruteur_id' => 75,
    'titre' => 'Développeur Angular ù applications métier',
    'description' => 'Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Sint dolore est nobis dolorem eos. Autem voluptatem aut commodi in. Sed eveniet fuga voluptatum ipsa modi consequuntur et.',
    'type' => 'stage',
    'lieu' => 'Monastir',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  19 => 
  array (
    'id' => 23,
    'recruteur_id' => 68,
    'titre' => 'Intégrateur Web ù Full stack',
    'description' => 'Environnement startup à Sousse : stack moderne, déploiements fréquents, culture DevOps. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Numquam deleniti et officiis libero et. Fugit molestias autem sapiente iste animi nihil nobis. Modi consequatur et sequi aut dolorem.',
    'type' => 'stage',
    'lieu' => 'Tunis',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  20 => 
  array (
    'id' => 24,
    'recruteur_id' => 63,
    'titre' => 'Stage Frontend ù Design system',
    'description' => 'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Occaecati quae autem excepturi. Repellat rerum nihil veniam iusto numquam. Quia sit eligendi error consequuntur praesentium sint.',
    'type' => 'emploi',
    'lieu' => 'Nabeul',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  21 => 
  array (
    'id' => 25,
    'recruteur_id' => 68,
    'titre' => 'Ingénieur données & Backend',
    'description' => 'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Aut distinctio dolor harum accusantium ea consequatur quod illo. Numquam ducimus earum corrupti et ullam.',
    'type' => 'emploi',
    'lieu' => 'Sousse',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  22 => 
  array (
    'id' => 26,
    'recruteur_id' => 74,
    'titre' => 'Stage Laravel / Vue.js',
    'description' => 'Vous rejoignez la direction technique à Sfax, en lien avec les équipes Cloud du siège. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Quia ipsam suscipit reiciendis dolorem nam. Earum nulla molestiae aperiam voluptas natus. Dolorum ut est quibusdam.',
    'type' => 'stage',
    'lieu' => 'Les Berges du Lac',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  23 => 
  array (
    'id' => 27,
    'recruteur_id' => 67,
    'titre' => 'Stage Frontend ù Design system',
    'description' => 'Équipe basée à Tunis ; projets pour clients en Tunisie et Maghreb. Télétravail partiel possible. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Adipisci in officia eaque laudantium maiores. Maiores reiciendis fugiat sunt iste voluptatibus.',
    'type' => 'stage',
    'lieu' => 'Gabès',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  24 => 
  array (
    'id' => 28,
    'recruteur_id' => 67,
    'titre' => 'Stage DevOps & Cloud (AWS)',
    'description' => 'Produits SaaS utilisés par des banques et assurances en Tunisie ; conformité et qualité API. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Alias tenetur esse vel ab animi non. Tempore commodi sunt voluptatem et qui aliquam ex non. Et et ut atque quia voluptatem est.',
    'type' => 'stage',
    'lieu' => 'Remote (Tunisie)',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  25 => 
  array (
    'id' => 29,
    'recruteur_id' => 70,
    'titre' => 'Développeur Mobile Flutter',
    'description' => 'Projet Mobile grand public : forte volumétrie, monitoring et scalabilité sur Cloud AWS. Stack : Frontend (SPA), Backend (API REST), déploiement Cloud, sensibilisation Mobile (PWA). Et voluptatem dolores voluptatem qui quas magni. Suscipit dolore possimus dolor officia.',
    'type' => 'stage',
    'lieu' => 'Gabès',
    'is_active' => 1,
    'created_at' => '2026-04-25 00:02:06',
    'updated_at' => '2026-04-25 00:02:06',
  ),
  26 => 
  array (
    'id' => 33,
    'recruteur_id' => 7,
    'titre' => 'Développeur Fullstack',
    'description' => 'Nous cherchons un stagiaire pour le projet ProLink...',
    'type' => 'stage',
    'lieu' => 'Sidi Bouzid',
    'is_active' => 1,
    'created_at' => '2026-05-07 18:25:27',
    'updated_at' => '2026-05-07 18:25:27',
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

        DB::table('conversations')->insert(array (
  0 => 
  array (
    'id' => 1,
    'candidat_id' => 2,
    'recruteur_id' => 7,
    'last_message_at' => '2026-05-07 15:50:04',
    'created_at' => '2026-05-02 20:36:13',
    'updated_at' => '2026-05-07 15:50:04',
  ),
  1 => 
  array (
    'id' => 2,
    'candidat_id' => 2,
    'recruteur_id' => 71,
    'last_message_at' => '2026-05-02 20:42:48',
    'created_at' => '2026-05-02 20:42:29',
    'updated_at' => '2026-05-02 20:42:48',
  ),
  2 => 
  array (
    'id' => 3,
    'candidat_id' => 2,
    'recruteur_id' => 67,
    'last_message_at' => '2026-05-07 16:11:31',
    'created_at' => '2026-05-02 20:43:34',
    'updated_at' => '2026-05-07 16:11:31',
  ),
  3 => 
  array (
    'id' => 4,
    'candidat_id' => 2,
    'recruteur_id' => 11,
    'last_message_at' => '2026-05-07 16:00:17',
    'created_at' => '2026-05-02 20:52:41',
    'updated_at' => '2026-05-07 16:00:17',
  ),
  4 => 
  array (
    'id' => 5,
    'candidat_id' => 6,
    'recruteur_id' => 7,
    'last_message_at' => '2026-05-02 21:20:13',
    'created_at' => '2026-05-02 21:17:57',
    'updated_at' => '2026-05-02 21:20:13',
  ),
  5 => 
  array (
    'id' => 6,
    'candidat_id' => 2,
    'recruteur_id' => 68,
    'last_message_at' => '2026-05-07 20:40:54',
    'created_at' => '2026-05-07 20:40:22',
    'updated_at' => '2026-05-07 20:40:54',
  ),
));

        DB::table('messages')->insert(array (
  0 => 
  array (
    'id' => 1,
    'conversation_id' => 1,
    'sender_id' => 2,
    'content' => 'bonjour',
    'created_at' => '2026-05-02 20:36:29',
    'updated_at' => '2026-05-02 21:10:11',
    'is_read' => 1,
  ),
  1 => 
  array (
    'id' => 2,
    'conversation_id' => 2,
    'sender_id' => 2,
    'content' => 'bonsoir',
    'created_at' => '2026-05-02 20:42:48',
    'updated_at' => '2026-05-02 20:42:48',
    'is_read' => 0,
  ),
  2 => 
  array (
    'id' => 3,
    'conversation_id' => 3,
    'sender_id' => 2,
    'content' => 'cc',
    'created_at' => '2026-05-02 20:43:49',
    'updated_at' => '2026-05-02 20:43:49',
    'is_read' => 0,
  ),
  3 => 
  array (
    'id' => 4,
    'conversation_id' => 4,
    'sender_id' => 2,
    'content' => 'cc',
    'created_at' => '2026-05-02 20:52:54',
    'updated_at' => '2026-05-02 20:52:54',
    'is_read' => 0,
  ),
  4 => 
  array (
    'id' => 5,
    'conversation_id' => 4,
    'sender_id' => 2,
    'content' => 'hchg',
    'created_at' => '2026-05-02 20:57:00',
    'updated_at' => '2026-05-02 20:57:00',
    'is_read' => 0,
  ),
  5 => 
  array (
    'id' => 6,
    'conversation_id' => 4,
    'sender_id' => 2,
    'content' => 'puogj',
    'created_at' => '2026-05-02 21:02:30',
    'updated_at' => '2026-05-02 21:02:30',
    'is_read' => 0,
  ),
  6 => 
  array (
    'id' => 7,
    'conversation_id' => 1,
    'sender_id' => 7,
    'content' => 'bonjour',
    'created_at' => '2026-05-02 21:10:25',
    'updated_at' => '2026-05-07 15:32:11',
    'is_read' => 1,
  ),
  7 => 
  array (
    'id' => 8,
    'conversation_id' => 5,
    'sender_id' => 7,
    'content' => 'bonjour',
    'created_at' => '2026-05-02 21:20:13',
    'updated_at' => '2026-05-02 21:20:13',
    'is_read' => 0,
  ),
  8 => 
  array (
    'id' => 9,
    'conversation_id' => 1,
    'sender_id' => 2,
    'content' => 'cv',
    'created_at' => '2026-05-07 15:32:23',
    'updated_at' => '2026-05-07 16:51:22',
    'is_read' => 1,
  ),
  9 => 
  array (
    'id' => 10,
    'conversation_id' => 1,
    'sender_id' => 2,
    'content' => 'bien',
    'created_at' => '2026-05-07 15:41:59',
    'updated_at' => '2026-05-07 16:51:22',
    'is_read' => 1,
  ),
  10 => 
  array (
    'id' => 11,
    'conversation_id' => 1,
    'sender_id' => 2,
    'content' => '?',
    'created_at' => '2026-05-07 15:50:04',
    'updated_at' => '2026-05-07 16:51:22',
    'is_read' => 1,
  ),
  11 => 
  array (
    'id' => 12,
    'conversation_id' => 4,
    'sender_id' => 2,
    'content' => 'hbhef',
    'created_at' => '2026-05-07 15:52:13',
    'updated_at' => '2026-05-07 15:52:13',
    'is_read' => 0,
  ),
  12 => 
  array (
    'id' => 13,
    'conversation_id' => 4,
    'sender_id' => 2,
    'content' => 'jhu',
    'created_at' => '2026-05-07 16:00:17',
    'updated_at' => '2026-05-07 16:00:17',
    'is_read' => 0,
  ),
  13 => 
  array (
    'id' => 14,
    'conversation_id' => 3,
    'sender_id' => 2,
    'content' => 'cv',
    'created_at' => '2026-05-07 16:11:31',
    'updated_at' => '2026-05-07 16:11:31',
    'is_read' => 0,
  ),
  14 => 
  array (
    'id' => 15,
    'conversation_id' => 6,
    'sender_id' => 2,
    'content' => 'bonjour',
    'created_at' => '2026-05-07 20:40:54',
    'updated_at' => '2026-05-07 20:40:54',
    'is_read' => 0,
  ),
));

        DB::table('contacts')->insert(array (
  0 => 
  array (
    'id' => 1,
    'email' => 'eya@gmail.com',
    'message' => 'bonjour il y  un probleme de login',
    'status' => 'pending',
    'created_at' => '2026-05-02 19:37:04',
    'updated_at' => '2026-05-02 19:37:04',
  ),
  1 => 
  array (
    'id' => 2,
    'email' => 'eya@gmail.com',
    'message' => 'Bonjour, j\'ai une question sur le projet ProLink',
    'status' => 'pending',
    'created_at' => '2026-05-02 19:49:25',
    'updated_at' => '2026-05-02 19:49:25',
  ),
));

        DB::table('email_verifications')->insert(array (
  0 => 
  array (
    'id' => 6,
    'email' => 'test.prolink@gmail.com',
    'code' => '$2y$12$mkjL1h1.UePZbk5HFhhVhuzi9Jn579CCi1gxSoxJvdHxBkYYiBpCW',
    'expires_at' => '2026-05-06 20:20:55',
    'created_at' => '2026-05-06 20:05:55',
    'updated_at' => '2026-05-06 20:05:55',
  ),
));

        DB::statement('PRAGMA foreign_keys = ON');
    }
}

