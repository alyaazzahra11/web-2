<?php

    // mengambil data dari file data-form-regis.php
    require_once "form_nilai.php";

    // buat variabel yang menerima value yang dikirim dari form
    $proses = $_GET['proses'];
    $nama_siswa = $_GET['nama'];
    $mata_kuliah = $_GET['matkul'];
    $nilai_uts = $_GET['nilai_uts'];
    $nilai_uas = $_GET['nilai_uas'];
    $nilai_tugas = $_GET['nilai_tugas'];


    // Menghitung nilai akhir dengan presentase 30% UTS, 35% UAS, dan 35% Tugas
    $nilai_akhir = ($nilai_uts * 0.3) + ($nilai_uas * 0.35) + ($nilai_tugas * 0.35);

    // Menentukan status kelulusan
    $status = ($nilai_akhir > 55) ? 'Lulus' : 'Tidak Lulus';

    // Menentukan grade nilai
    if ($nilai_akhir >= 85 && $nilai_akhir <= 100) {
        $grade = 'A';
    } elseif ($nilai_akhir >= 70 && $nilai_akhir < 85) {
        $grade = 'B';
    } elseif ($nilai_akhir >= 56 && $nilai_akhir < 70) {
        $grade = 'C';
    } elseif ($nilai_akhir >= 36 && $nilai_akhir < 56) {
        $grade = 'D';
    } elseif ($nilai_akhir >= 0 && $nilai_akhir < 36) {
        $grade = 'E';
    } else {
        $grade = 'I';
    }

    // Menentukan predikat nilai menggunakan switch
    switch ($grade) {
        case 'A':
            $predikat = 'Sangat Memuaskan';
            break;
        case 'B':
            $predikat = 'Memuaskan';
            break;
        case 'C':
            $predikat = 'Cukup';
            break;
        case 'D':
            $predikat = 'Kurang';
            break;
        case 'E':
            $predikat = 'Sangat Kurang';
            break;
        default:
            $predikat = 'Tidak Ada';
            break;
    }

    if (!empty($proses)) {
        echo 'Proses: ' . $proses;
        echo '<br/>Nama: ' . $nama_siswa;
        echo '<br/>Mata Kuliah: ' . $mata_kuliah;
        echo '<br/>Nilai UTS: ' . $nilai_uts;
        echo '<br/>Nilai UAS: ' . $nilai_uas;
        echo '<br/>Nilai Tugas Praktikum: ' . $nilai_tugas;
        echo '<br/>Nilai Akhir: ' . number_format($nilai_akhir, 2, ',', '.');
        echo '<br/>Grade: ' . $grade;
        echo '<br/>Predikat: ' . $predikat;
        echo '<br/>Status: ' . $status;
    }
