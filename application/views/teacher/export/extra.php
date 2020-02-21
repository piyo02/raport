<!DOCTYPE html>
<html lang="en">
<head>
    <title>Raport</title>
    <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css">
    <style>
        th, td {
            border-top: 0px !important;
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
        <!-- nilai sikap -->
        <h6 class="mt-3"><b>C. EKSTRAKURIKULER</b></h6>
        <h6>1. Pengetahuan</h6>
        <table class="table table-bordered">
            <tr class="bg-gray">
                <th>No</th>
                <th>Jenis Ekstrakurikuler</th>
                <th>Nilai</th>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td class="p-1 pl-3" colspan="5">Ekstrakurikuler</td>
            </tr>
            <?php $no = 1; $value = 81;?>
            <?php for($j = 0; $j < 2; $j++) : ?>
            <?php // for($j = 0; $j < count($courses); $j++) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $courses[$j]->name ?></td>
                <td><?php
                    switch ($value) {
                        case $value >= 91 && $value <= 100 :
                            echo $predicate_knowledge[0]->name;
                            break;
                        case $value >= 81 && $value <= 90 :
                            echo $predicate_knowledge[1]->name;
                            break;
                        case $value >= 71 && $value <= 80 :
                            echo $predicate_knowledge[2]->name;
                            break;
                        default:
                            echo $predicate_knowledge[3]->name;
                            break;
                    }
                ?></td>
                <td><?php 
                    switch ($value) {
                        case $value >= 91 && $value <= 100 :
                            echo $predicate_knowledge[0]->description;
                            break;
                        case $value >= 81 && $value <= 90 :
                            echo $predicate_knowledge[1]->description;
                            break;
                        case $value >= 71 && $value <= 80 :
                            echo $predicate_knowledge[2]->description;
                            break;
                        default:
                            echo $predicate_knowledge[3]->description;
                            break;
                    }
                ?></td>
            </tr>
            <?php endfor; ?>
        </table>

        <h6 class="mt-5"><b>D. PRESTASI</b></h6>
        <table class="table table-bordered">
            <tr class="bg-gray">
                <th>No</th>
                <th>Jenis Prestasi</th>
                <th>Keterangan</th>
            </tr>
            <?php $no = 1; $value = 81;?>
            <?php for($j = 0; $j < 2; $j++) : ?>
            <?php // for($j = 0; $j < count($courses); $j++) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= $courses[$j]->name ?></td>
                <td><?php 
                    switch ($value) {
                        case $value >= 91 && $value <= 100 :
                            echo $predicate_knowledge[0]->description;
                            break;
                        case $value >= 81 && $value <= 90 :
                            echo $predicate_knowledge[1]->description;
                            break;
                        case $value >= 71 && $value <= 80 :
                            echo $predicate_knowledge[2]->description;
                            break;
                        default:
                            echo $predicate_knowledge[3]->description;
                            break;
                    }
                ?></td>
            </tr>
            <?php endfor; ?>
        </table>

        <h6 class="mt-5"><b>D. KETIDAKHADIRAN</b></h6>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-bordered">
                    <tr>
                        <th>Izin</th>
                        <td><?= $absence->sick ?> Hari</td>
                    </tr>
                    <tr>
                        <th>Sakit</th>
                        <td><?= $absence->permission ?> Hari</td>
                    </tr>
                    <tr>
                        <th>Tanpa Keterangan</th>
                        <td><?= $absence->without_explanation ?> Hari</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>