<!DOCTYPE html>
<html lang="en">
<head>
    <title>Raport</title>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <style>
        th, td {
            border-top: 0px !important;
        }
        th {
            text-align : left !important;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: Sans-serif !important;
            color: rgb(33, 37, 41) !important;
        }
    </style>
</head>
<body>
    <div class="container">
    <!-- //kop -->
    <?php
    $class = explode(" ",$student->classroom_name);
    
    if(date('m') > 6)
        $year = date('Y'). '/' . (date('Y')+1);
    else
        $year = (date('Y')-1) . '/' . date('Y');
    switch ($class[0]) {
        case 'XI':
            $semester = '3 (Tiga)';
            if(date('m') > 6)
            $semester = '4 (Empat)';
            break;
        case 'XII':
            $semester = '5 (Lima)';
            if(date('m') > 6)
            $semester = '6 (Enam)';
            break;
        default:
            $semester = '1 (Satu)';
            if(date('m') > 6)
            $semester = '2 (Dua)';
            break;
    }
     ?>
        <h3 class="text-center mt-3 mb-5">PENCAPAIAN KOMPETENSI PESERTA DIDIK</h3>
        
        <!-- profil -->
        <div class="row justify-content-between mb-5">
            <div class="col-lg-6 mt-5" style="max-width: 50%;">
                <table class="table">
                    <tr>
                        <th>Nama Sekolah</th>
                        <td>: <?= $school->name ?></td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>: <?= $school->address ?></td>
                    </tr>
                    <tr>
                        <th>Nama Peserta Didik</th>
                        <td>: <?= $student->name ?></td>
                    </tr>
                    <tr>
                        <th>NIS / NISN</th>
                        <td>: <?= $student->nis . ' / ' . $student->nisn ?></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-4 mt-5">
                <table class="table">
                    <tr>
                        <th>Kelas</th>
                        <td>: <?= $student->classroom_name ?></td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>: <?= $semester ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Pelajaran</th>
                        <td>: <?= $year ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- nilai sikap -->
        <h6 class=""><b>A. Sikap</b></h6>
        <?php for($i = 0; $i < count($attitude); $i++) :?>
            <h6><?= $i + 1 ?>. Sikap <?= $attitude[0]->name;?></h6>
            <table class="table table-bordered">
                <tr class="bg-gray">
                    <th>Predikat</th>
                    <th>Deskripsi</th>
                </tr>
                <tr>
                    <td><?= $student_attitude[0]->predicate?></td>
                    <td><?= $student_attitude[0]->description?></td>
                </tr>
            </table>
        <?php endfor;?>

    </div>
</body>
</html>