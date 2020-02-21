<!DOCTYPE html>
<html lang="en">
<head>
    <title>Raport</title>
    <!-- <link rel="stylesheet" href="<?= base_url('assets/') ?>dist/css/adminlte.min.css"> -->
    <style>
:root {
  --blue: #007bff;
  --indigo: #6610f2;
  --purple: #6f42c1;
  --pink: #e83e8c;
  --red: #dc3545;
  --orange: #fd7e14;
  --yellow: #ffc107;
  --green: #28a745;
  --teal: #20c997;
  --cyan: #17a2b8;
  --white: #ffffff;
  --gray: #6c757d;
  --gray-dark: #343a40;
  --primary: #007bff;
  --secondary: #6c757d;
  --success: #28a745;
  --info: #17a2b8;
  --warning: #ffc107;
  --danger: #dc3545;
  --light: #f8f9fa;
  --dark: #343a40;
  --breakpoint-xs: 0;
  --breakpoint-sm: 576px;
  --breakpoint-md: 768px;
  --breakpoint-lg: 992px;
  --breakpoint-xl: 1200px;
  --font-family-sans-serif: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
}

*,
*::before,
*::after {
  box-sizing: border-box;
}
html {
  font-family: sans-serif;
  line-height: 1.15;
  -webkit-text-size-adjust: 100%;
  -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
}
body {
  margin: 0;
  font-family: "Source Sans Pro", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  text-align: left;
  background-color: #ffffff;
}
h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
}
p {
  margin-top: 0;
  margin-bottom: 1rem;
}
b,
strong {
  font-weight: bolder;
}
h1, h2, h3, h4, h5, h6,
.h1, .h2, .h3, .h4, .h5, .h6 {
  margin-bottom: 0.5rem;
  font-family: inherit;
  font-weight: 500;
  line-height: 1.2;
}
h1, .h1 {
  font-size: 2.5rem;
}

h2, .h2 {
  font-size: 2rem;
}

h3, .h3 {
  font-size: 1.75rem;
}

h4, .h4 {
  font-size: 1.5rem;
}

h5, .h5 {
  font-size: 1.25rem;
}

h6, .h6 {
  font-size: 1rem;
}
.container {
  width: 100%;
  padding-right: 7.5px;
  padding-left: 7.5px;
  margin-right: auto;
  margin-left: auto;
}
.row {
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  margin-right: -7.5px;
  margin-left: -7.5px;
}
.col-lg-4 {
  -ms-flex: 0 0 33.333333%;
  flex: 0 0 33.333333%;
  max-width: 33.333333%;
}
.col-lg-6 {
  -ms-flex: 0 0 50%;
  flex: 0 0 50%;
  max-width: 50%;
}
.table {
  width: 100%;
  margin-bottom: 1rem;
  color: #212529;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}
.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}
.justify-content-between {
  -ms-flex-pack: justify !important;
  justify-content: space-between !important;
}
.mt-5,
.my-5 {
  margin-top: 3rem !important;
}
.p-1 {
  padding: 0.25rem !important;
}
.mt-3,
.my-3 {
  margin-top: 1rem !important;
}
.pl-3,
.px-3 {
  padding-left: 1rem !important;
}
.mb-5,
.my-5 {
  margin-bottom: 3rem !important;
}
.text-center {
  text-align: center !important;
}
.bg-gray {
  background-color: #adb5bd;
  color: #1F2D3D;
}
.bg-gray,
.bg-gray > a {
  color: #ffffff !important;
}
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
        <!-- nilai sikap -->
        <?php $no = 1; ?>
            <h6 class="mt-5">2. Keterampilan</h6>
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