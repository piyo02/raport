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
        <h6 class="mt-3"><b>B. Pengetahuan Dan Keterampilan</b></h6>
        <?php $no = 1; ?>
            <h6>1. Pengetahuan</h6>
            <table class="table table-bordered">
                <tr class="bg-gray">
                    <th>No</th>
                    <th>Mata Pelajaran</th>
                    <th>Nilai</th>
                    <th>Predikat</th>
                    <th>Deskripsi</th>
                </tr>
                <tr>
                    <td class="p-1 pl-3" colspan="5">Kelompok</td>
                </tr>
                <?php for($j = 0; $j < 2; $j++) : ?>
                <?php // for($j = 0; $j < count($courses); $j++) : ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $courses[$j]->name ?></td>
                    <td>
                    <?php
                        $value = 0;
                        $bagi = 0;
                        foreach($formulas as $key => $formula){
                            $bagi += $formula->value; 
                            $var = $formula->name;
                            $value += $formula->value * $$var[$j]->result;
                        }
                        $value = $value/$bagi;
                        echo $value;
                    ?>
                    </td>
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
    </div>
</body>
</html>