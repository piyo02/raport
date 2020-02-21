<?php

class Excel_services
{
    function __construct()
    {
        //
    }

    public function excel_config($_data)
    {
        $school = $_data['school'];
        $teacher = $_data['teacher'];
        $category = $_data['category'];
        $courses = $_data['courses'];
        $student = $_data['student'];
        $semester = $_data['semester'];
        $year = $_data['year'];
        $student_attitudes = $_data['student_attitudes'];
        $record_courses = $_data['record_courses'];
        $extracurriculars = $_data['extracurriculars'];
        $achievement = $_data['achievement'];
        $absence = $_data['absence'];
        $knowledge = $_data['knowledge'];
        $skill = $_data['skill'];
        
        $predicate_knowledge = $_data['predicate_knowledge'];
        // var_dump($school); die;
        

        // $name = $_data['name']->name;
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require(APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $PHPExcel = new PHPExcel();

        ########################  DATA UMUM  ########################
        $PHPExcel->getProperties()->setCreator('Creator');
        $PHPExcel->getProperties()->setLastModifiedBy();
        $PHPExcel->getProperties()->setTitle('Creator');
        $PHPExcel->getProperties()->setSubject('Creator');
        $PHPExcel->getProperties()->setDescription('Creator');

        $PHPExcel->getActiveSheetIndex(0);
        $PHPExcel->getActiveSheet()->setTitle('title');

        ########################  ARRAY STYLE  ########################

        $styleArray = array('borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '0000'))));
        $outsideborder = array('borders' => array('outsideborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN, 'color' => array('argb' => '0000'))));

        //Header
        $row_header = ['1', '44', '77', '110'];
        for ($i=0; $i <4 ; $i++) { 
            $PHPExcel->getActiveSheet()->setCellValue('A'.$row_header[$i], 'Nama Sekolah ');
            $PHPExcel->getActiveSheet()->setCellValue('C'.$row_header[$i], ': '. $school->name );
            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_header[$i]+1), 'Alamat ');
            $PHPExcel->getActiveSheet()->setCellValue('C'.($row_header[$i]+1), ': '. $school->address);
            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_header[$i]+2), 'Nama Siswa ');
            $PHPExcel->getActiveSheet()->setCellValue('C'.($row_header[$i]+2), ': '. $student->name);
            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_header[$i]+3), 'NIS / NISN ');
            $PHPExcel->getActiveSheet()->setCellValue('C'.($row_header[$i]+3), ': '. $student->nis . ' / ' . $student->nisn);
            $PHPExcel->getActiveSheet()->setCellValue('G'.$row_header[$i], 'Kelas ');
            $PHPExcel->getActiveSheet()->setCellValue('H'.$row_header[$i], ': '. $student->classroom_name);
            $PHPExcel->getActiveSheet()->setCellValue('G'.($row_header[$i]+1), 'Semester ');
            $PHPExcel->getActiveSheet()->setCellValue('H'.($row_header[$i]+1), ': '. $semester );
            $PHPExcel->getActiveSheet()->setCellValue('G'.($row_header[$i]+2), 'T.P. ');
            $PHPExcel->getActiveSheet()->setCellValue('H'.($row_header[$i]+2), ': '. $year);
    
            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_header[$i]+4), '-----------------------------------------------------------------------------------------------------------------------------------------------');
        }
        $PHPExcel->getActiveSheet()->setCellValue('A6', 'CAPAIAN HASIL BELAJAR');
        $PHPExcel->getActiveSheet()->getStyle('A6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $PHPExcel->getActiveSheet()->setCellValue('A9', 'A. Sikap');
        $PHPExcel->getActiveSheet()->setCellValue('B10', '1. Sikap Spiritual');
        $PHPExcel->getActiveSheet()->setCellValue('B25', '2. Sikap Sosial');
        
        $row_attitude = ['12', '25'];
        for ($i = 0; $i < 2; $i++) {
            $PHPExcel->getActiveSheet()->getStyle('B'.$row_attitude[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $PHPExcel->getActiveSheet()->getStyle('D'.$row_attitude[$i])->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $PHPExcel->getActiveSheet()->setCellValue('B'.$row_attitude[$i], 'Predikat');
            $PHPExcel->getActiveSheet()->setCellValue('B'.($row_attitude[$i]+1), $student_attitudes[$i]->predicate);
            $PHPExcel->getActiveSheet()->getStyle('B'.($row_attitude[$i]+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $PHPExcel->getActiveSheet()->mergeCells('B'.$row_attitude[$i] . ':'. 'C' . $row_attitude[$i]);
            $PHPExcel->getActiveSheet()->mergeCells('B'.($row_attitude[$i]+1) . ':'. 'C'.($row_attitude[$i]+9));
            
            $PHPExcel->getActiveSheet()->setCellValue('D'.$row_attitude[$i], 'Deskripsi');
            $PHPExcel->getActiveSheet()->setCellValue('D'.($row_attitude[$i]+1), $student_attitudes[$i]->description);
            $PHPExcel->getActiveSheet()->getStyle('D'.($row_attitude[$i]+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $PHPExcel->getActiveSheet()->mergeCells('D'.$row_attitude[$i] . ':'. 'I'.$row_attitude[$i]);
            $PHPExcel->getActiveSheet()->mergeCells('D'.($row_attitude[$i]+1) . ':'. 'I'.($row_attitude[$i]+9));

            $PHPExcel->getActiveSheet()->getStyle('B'.$row_attitude[$i].':'.'F'.($row_attitude[$i]+9))->applyFromArray($styleArray);
        }
        
        $start_row = 49;
        
        $PHPExcel->getActiveSheet()->setCellValue('B'.$start_row, 'B. Pengetahuan dan Keterampilan');
        $PHPExcel->getActiveSheet()->mergeCells('B'.($start_row).':'.'D'.($start_row));
        
        //pengetahuan
        $PHPExcel->getActiveSheet()->setCellValue('A'.($start_row+2), 'Mata Pelajaran');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($start_row+2).':'.'C'.($start_row+3));
        $PHPExcel->getActiveSheet()->getStyle('A'.($start_row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $PHPExcel->getActiveSheet()->setCellValue('D'.($start_row+2), 'Pengetahuan');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($start_row+2).':'.'I'.($start_row+2));
        $PHPExcel->getActiveSheet()->getStyle('D'.($start_row+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $PHPExcel->getActiveSheet()->setCellValue('D'.($start_row+3), 'Nilai');
        $PHPExcel->getActiveSheet()->setCellValue('E'.($start_row+3), 'Predikat');
        $PHPExcel->getActiveSheet()->setCellValue('F'.($start_row+3), 'Keterangan');
        $PHPExcel->getActiveSheet()->mergeCells('F'.($start_row+3).':'.'I'.($start_row+3));
        $PHPExcel->getActiveSheet()->getStyle('F'.($start_row+3))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        // if($no != 1){
        //     var_dump($row_knowledge[1]); die;
        // }

        $no = 1;
        for ($i=0; $i < count($category) ; $i++) { 
            $row_knowledge = [53 + $i, (53 + $no)];
            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_knowledge[$i]), $category[$i]->name);
            $PHPExcel->getActiveSheet()->getRowDimension(($row_knowledge[$i]))->setRowHeight(15);
            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_knowledge[$i]).':'.'I'.($row_knowledge[$i]));
            
            $nomor = 1; 
            for ($j=0; $j < $record_courses[$i]->total ; $j++) {
                $PHPExcel->getActiveSheet()->mergeCells('B'.($row_knowledge[$i] + $nomor).':'.'C'.($row_knowledge[$i] + $nomor));
                $PHPExcel->getActiveSheet()->mergeCells('F'.($row_knowledge[$i] + $nomor).':'.'I'.($row_knowledge[$i] + $nomor));
                
                $PHPExcel->getActiveSheet()->getRowDimension(($row_knowledge[$i]+$nomor))->setRowHeight(24);
                
                $PHPExcel->getActiveSheet()->setCellValue('A'.($row_knowledge[$i] + $nomor) , $no);
                $PHPExcel->getActiveSheet()->setCellValue('B'.($row_knowledge[$i] + $nomor) , $courses[$no - 1]->name);


                if(isset($knowledge[$no - 1]))
                    $value = $knowledge[$no - 1];
                else
                    $value = 0;

                switch($value) {
                    case $value >= 91 && $value <= 100:
                        $predicate = $predicate_knowledge[0];
                    break;
                    case $value >= 81 && $value <= 90:
                        $predicate = $predicate_knowledge[1];
                    break;
                    case $value >= 71 && $value <= 80:
                        $predicate = $predicate_knowledge[2];
                    break;
                    case $value <= 70:
                        $predicate = $predicate_knowledge[3];
                    break;
                }
                $PHPExcel->getActiveSheet()->setCellValue('D'.($row_knowledge[$i] + $nomor) , $value);
                $PHPExcel->getActiveSheet()->setCellValue('E'.($row_knowledge[$i] + $nomor) , $predicate->name);
                $PHPExcel->getActiveSheet()->setCellValue('F'.($row_knowledge[$i] + $nomor) , $predicate->description);
                
                $no++;
                $nomor++;
            }
        }
        // var_dump($no);
        // var_dump($start_row+4+$no);
        
        $PHPExcel->getActiveSheet()->getStyle('A'.($start_row+2).':'.'I'.($start_row+4+$no))->applyFromArray($styleArray);
        
        //keterampilan
        $start_row = 82;
        $PHPExcel->getActiveSheet()->setCellValue('A'.($start_row+2), 'Mata Pelajaran');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($start_row+2).':'.'C'.($start_row+3));
        $PHPExcel->getActiveSheet()->setCellValue('D'.($start_row+2), 'Keterampilan');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($start_row+2).':'.'I'.($start_row+2));
        $PHPExcel->getActiveSheet()->setCellValue('D'.($start_row+3), 'Nilai');
        $PHPExcel->getActiveSheet()->setCellValue('E'.($start_row+3), 'Predikat');
        $PHPExcel->getActiveSheet()->setCellValue('F'.($start_row+3), 'Keterangan');
        $PHPExcel->getActiveSheet()->mergeCells('F'.($start_row+3).':'.'I'.($start_row+3));

        // var_dump($predicate_knowledge); die;

        $no = 1;
        for ($i=0; $i < count($category) ; $i++) { 
            $row_knowledge = [86 + $i, (86 + $no)];
            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_knowledge[$i]), $category[$i]->name);
            $PHPExcel->getActiveSheet()->getRowDimension(($row_knowledge[$i]))->setRowHeight(15);
            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_knowledge[$i]).':'.'I'.($row_knowledge[$i]));
            $nomor = 1; 
            for ($j=0; $j < $record_courses[$i]->total ; $j++) { 
                $PHPExcel->getActiveSheet()->mergeCells('B'.($row_knowledge[$i] + $nomor).':'.'C'.($row_knowledge[$i] + $nomor));
                $PHPExcel->getActiveSheet()->mergeCells('F'.($row_knowledge[$i] + $nomor).':'.'I'.($row_knowledge[$i] + $nomor));
                
                $PHPExcel->getActiveSheet()->getRowDimension(($row_knowledge[$i]+$nomor))->setRowHeight(24);

                $PHPExcel->getActiveSheet()->setCellValue('A'.($row_knowledge[$i] + $nomor) , $no);
                $PHPExcel->getActiveSheet()->setCellValue('B'.($row_knowledge[$i] + $nomor) , $courses[$no - 1]->name);

                if(isset($skill[$no - 1]->result))
                    $value = $skill[$no - 1]->result;
                else
                    $value = 0;

                switch($value) {
                    case $value >= 91 && $value <= 100:
                        $predicate = $predicate_knowledge[0];
                    break;
                    case $value >= 81 && $value <= 90:
                        $predicate = $predicate_knowledge[1];
                    break;
                    case $value >= 71 && $value <= 80:
                        $predicate = $predicate_knowledge[2];
                    break;
                    case $value <= 70:
                        $predicate = $predicate_knowledge[3];
                    break;
                }
                $PHPExcel->getActiveSheet()->setCellValue('D'.($row_knowledge[$i] + $nomor) , $value);
                $PHPExcel->getActiveSheet()->setCellValue('E'.($row_knowledge[$i] + $nomor) , $predicate->name);
                $PHPExcel->getActiveSheet()->setCellValue('F'.($row_knowledge[$i] + $nomor) , $predicate->description);
                
                $no++;
                $nomor++;
            }
        }
        $PHPExcel->getActiveSheet()->getStyle('A'.($start_row+2).':'.'I'.($start_row+4+$no))->applyFromArray($styleArray);

        //extra
        $row_exschool = 116;
        $PHPExcel->getActiveSheet()->getRowDimension(($row_exschool-1))->setRowHeight(10);

        $PHPExcel->getActiveSheet()->setCellValue('A'.$row_exschool, 'C. Ekstrakurikuler');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_exschool).':'.'C'.($row_exschool));
        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_exschool+1), 'No');
        $PHPExcel->getActiveSheet()->setCellValue('B'.($row_exschool+1), 'Kegiatan Ekstrakurikuler');
        $PHPExcel->getActiveSheet()->mergeCells('B'.($row_exschool+1).':'.'D'.($row_exschool+1));

        $PHPExcel->getActiveSheet()->setCellValue('E'.($row_exschool+1), 'Nilai');
        $PHPExcel->getActiveSheet()->setCellValue('F'.($row_exschool+1), 'Deskripsi');
        $PHPExcel->getActiveSheet()->mergeCells('F'.($row_exschool+1).':'.'I'.($row_exschool+1));
        $no = 1;
        if($extracurriculars == NULL){
            $extracurriculars[0] = (object) $extracurriculars;

            $extracurriculars[0]->extracurricular_name = '';
            $extracurriculars[0]->name = '';
            $extracurriculars[0]->description = '';
        }
        foreach ($extracurriculars as $key => $extracurricular) {
            $PHPExcel->getActiveSheet()->getRowDimension(($row_exschool+1+$no))->setRowHeight(20);

            $PHPExcel->getActiveSheet()->setCellValue('A'.($row_exschool+1+$no), $no);
            $PHPExcel->getActiveSheet()->setCellValue('B'.($row_exschool+1+$no), $extracurricular->extracurricular_name);
            $PHPExcel->getActiveSheet()->mergeCells('B'.($row_exschool+1+$no).':'.'D'.($row_exschool+1+$no));
            
            $PHPExcel->getActiveSheet()->setCellValue('E'.($row_exschool+1+$no), $extracurricular->name);
            $PHPExcel->getActiveSheet()->setCellValue('F'.($row_exschool+1+$no), $extracurricular->description);
            $PHPExcel->getActiveSheet()->mergeCells('F'.($row_exschool+1+$no).':'.'I'.($row_exschool+1+$no));
            $no++;
        }
        $PHPExcel->getActiveSheet()->getStyle('A'.($row_exschool+1).':'.'I'.($row_exschool+$no))->applyFromArray($styleArray);
        

        $row_achievement = $row_exschool + count($extracurriculars)+2;
        // var_dump($row_achievement); die;
        $PHPExcel->getActiveSheet()->setCellValue('A'.$row_achievement, 'D. Prestasi');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_achievement).':'.'C'.($row_achievement));

        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_achievement+1), 'No');
        $PHPExcel->getActiveSheet()->setCellValue('B'.($row_achievement+1), 'Jenis Kegiatan');
        $PHPExcel->getActiveSheet()->mergeCells('B'.($row_achievement+1).':'.'D'.($row_achievement+1));

        $PHPExcel->getActiveSheet()->setCellValue('E'.($row_achievement+1), 'Deskripsi');
        $PHPExcel->getActiveSheet()->mergeCells('E'.($row_achievement+1).':'.'I'.($row_achievement+1));
        if($achievement == NULL){
            $achievement = (object) $achievement;
            $achievement->name = '';
            $achievement->description = '';
        }
        $PHPExcel->getActiveSheet()->getRowDimension(($row_achievement+2))->setRowHeight(20);
        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_achievement+2), 1);
        $PHPExcel->getActiveSheet()->setCellValue('B'.($row_achievement+2), $achievement->name);
        $PHPExcel->getActiveSheet()->mergeCells('B'.($row_achievement+2).':'.'D'.($row_achievement+2));
        $PHPExcel->getActiveSheet()->setCellValue('E'.($row_achievement+2), $achievement->description);
        $PHPExcel->getActiveSheet()->mergeCells('E'.($row_achievement+2).':'.'I'.($row_achievement+2));

        $PHPExcel->getActiveSheet()->getStyle('A'.($row_achievement+1).':'.'I'.($row_achievement+2))->applyFromArray($styleArray);


        $row_absence = $row_achievement+3;
        $PHPExcel->getActiveSheet()->setCellValue('A'.$row_absence, 'E. Ketidakhadiran');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_absence).':'.'C'.($row_absence));
        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_absence+1), 'Sakit');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_absence+1).':'.'C'.($row_absence+1));
        $PHPExcel->getActiveSheet()->setCellValue('D'.($row_absence+1), $absence->sick . ' Hari');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row_absence+1).':'.'F'.($row_absence+1));

        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_absence+2), 'Izin');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_absence+2).':'.'C'.($row_absence+2));
        $PHPExcel->getActiveSheet()->setCellValue('D'.($row_absence+2), $absence->permission . ' Hari');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row_absence+2).':'.'F'.($row_absence+2));
        
        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_absence+3), 'Tanpa Keterangan');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_absence+3).':'.'C'.($row_absence+3));
        $PHPExcel->getActiveSheet()->setCellValue('D'.($row_absence+3), $absence->without_explanation . ' Hari');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row_absence+3).':'.'F'.($row_absence+3));
        
        $PHPExcel->getActiveSheet()->getStyle('A'.($row_absence+1).':'.'F'.($row_absence+3))->applyFromArray($styleArray);

        $row_note = $row_absence+5;
        $PHPExcel->getActiveSheet()->getRowDimension(($row_note-1))->setRowHeight(10);
        $PHPExcel->getActiveSheet()->getRowDimension(($row_note+2))->setRowHeight(10);
        $PHPExcel->getActiveSheet()->setCellValue('A'.$row_note, 'F. Catatan Wali Kelas');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_note).':'.'C'.($row_note));
        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_note+1), '');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_note+1).':'.'I'.($row_note+2));
        
        $PHPExcel->getActiveSheet()->getStyle('A'.($row_note+1).':'.'I'.($row_note+2))->applyFromArray($styleArray);
        
        $row_parent = $row_note+4;
        $PHPExcel->getActiveSheet()->getRowDimension(($row_parent-1))->setRowHeight(10);
        $PHPExcel->getActiveSheet()->setCellValue('A'.$row_parent, 'G. Tanggapan Orangtua/Wali');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_parent).':'.'C'.($row_parent));
        $PHPExcel->getActiveSheet()->setCellValue('A'.($row_parent+1), '');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row_parent+1).':'.'I'.($row_parent+2));

        $PHPExcel->getActiveSheet()->getStyle('A'.($row_parent+1).':'.'I'.($row_parent+2))->applyFromArray($styleArray);
        
        $row = $row_parent + 4;
        $PHPExcel->getActiveSheet()->setCellValue('B'.$row, 'Mengetahui');
        $PHPExcel->getActiveSheet()->setCellValue('B'.($row+1), 'Orang Tua/Wali');
        
        $PHPExcel->getActiveSheet()->getRowDimension(($row+2))->setRowHeight(12.5);
        $PHPExcel->getActiveSheet()->getRowDimension(($row+3))->setRowHeight(12.5);
        $PHPExcel->getActiveSheet()->getRowDimension(($row+4))->setRowHeight(12.5);
        $PHPExcel->getActiveSheet()->getRowDimension(($row+5))->setRowHeight(12.5);

        $PHPExcel->getActiveSheet()->mergeCells('B'.($row+1).':'.'C'.($row+1));
        $PHPExcel->getActiveSheet()->setCellValue('B'.($row+5), '------------');
        $PHPExcel->getActiveSheet()->mergeCells('A'.($row+5).':'.'C'.($row+5));

        $PHPExcel->getActiveSheet()->setCellValue('G'.$row, 'Kendari, '. date('d F Y'));
        $PHPExcel->getActiveSheet()->mergeCells('G'.($row).':'.'I'.($row));
        $PHPExcel->getActiveSheet()->setCellValue('G'.($row+1), 'Wali Kelas');
        $PHPExcel->getActiveSheet()->setCellValue('G'.($row+5), $teacher->user_fullname);
        $PHPExcel->getActiveSheet()->mergeCells('G'.($row+5).':'.'I'.($row+5));
        $PHPExcel->getActiveSheet()->setCellValue('G'.($row+6), 'NIP. ' . $teacher->nip);
        $PHPExcel->getActiveSheet()->mergeCells('G'.($row+6).':'.'I'.($row+6));

        $PHPExcel->getActiveSheet()->setCellValue('D'.($row+7), 'Mengetahui');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row+7).':'.'F'.($row+7));

        $PHPExcel->getActiveSheet()->setCellValue('D'.($row+8), 'Kepala Sekolah');
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row+8).':'.'F'.($row+8));

        $PHPExcel->getActiveSheet()->getRowDimension(($row+9))->setRowHeight(14);
        $PHPExcel->getActiveSheet()->getRowDimension(($row+10))->setRowHeight(14);
        $PHPExcel->getActiveSheet()->getRowDimension(($row+11))->setRowHeight(14);
        $PHPExcel->getActiveSheet()->getRowDimension(($row+13))->setRowHeight(12.5);

        $PHPExcel->getActiveSheet()->setCellValue('D'.($row+12), $school->user_fullname);
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row+12).':'.'I'.($row+12));

        $PHPExcel->getActiveSheet()->setCellValue('D'.($row+13), 'NIP. '. $school->nip);
        $PHPExcel->getActiveSheet()->mergeCells('D'.($row+13).':'.'I'.($row+13));







        ############    style aligment   ####################
        $PHPExcel->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // $PHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // $PHPExcel->getActiveSheet()->getStyle('B2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        // $PHPExcel->getActiveSheet()->getStyle('B5:F12')->applyFromArray($styleArray);
        // $PHPExcel->getActiveSheet()->getStyle('E11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        // $PHPExcel->getActiveSheet()->getStyle('B14:E14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        // $PHPExcel->getActiveSheet()->getStyle('D5:D12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        #####################   style global width colum  #########################
        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(2.5);
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(9);
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(4.9);
        $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.9);
        $PHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(5.9);
        $PHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
        $PHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(9);
        $PHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9);
        
        #####################   style global height row  #########################
        $PHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(16.5);

        #########################     style font  ############################
        $PHPExcel->getActiveSheet()->getStyle('A1:H6')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A44:H48')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A74:H81')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A110:H114')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A1:I200')->getFont()->setName('Arial');
        $PHPExcel->getActiveSheet()->getStyle('A1:I200')->getFont()->setSize(10);

        #################  style merge column   ##########################
        $row_header = ['1', '44', '77', '110'];
        for($i = 0; $i < 4; $i++){
            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_header[$i]).':'.'B'.($row_header[$i]));
            $PHPExcel->getActiveSheet()->mergeCells('C'.($row_header[$i]).':'.'E'.($row_header[$i]));
            $PHPExcel->getActiveSheet()->mergeCells('H'.($row_header[$i]).':'.'I'.($row_header[$i]));

            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_header[$i]+1).':'.'B'.($row_header[$i]+1));
            $PHPExcel->getActiveSheet()->mergeCells('C'.($row_header[$i]+1).':'.'E'.($row_header[$i]+1));
            $PHPExcel->getActiveSheet()->mergeCells('H'.($row_header[$i]+1).':'.'I'.($row_header[$i]+1));

            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_header[$i]+2).':'.'B'.($row_header[$i]+2));
            $PHPExcel->getActiveSheet()->mergeCells('C'.($row_header[$i]+2).':'.'E'.($row_header[$i]+2));
            $PHPExcel->getActiveSheet()->mergeCells('H'.($row_header[$i]+2).':'.'I'.($row_header[$i]+2));

            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_header[$i]+3).':'.'B'.($row_header[$i]+3));
            $PHPExcel->getActiveSheet()->mergeCells('C'.($row_header[$i]+3).':'.'E'.($row_header[$i]+3));
            $PHPExcel->getActiveSheet()->mergeCells('H'.($row_header[$i]+3).':'.'I'.($row_header[$i]+3));

            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_header[$i]+3).':'.'B'.($row_header[$i]+3));
            $PHPExcel->getActiveSheet()->mergeCells('C'.($row_header[$i]+3).':'.'E'.($row_header[$i]+3));
            $PHPExcel->getActiveSheet()->mergeCells('H'.($row_header[$i]+3).':'.'I'.($row_header[$i]+3));

            $PHPExcel->getActiveSheet()->mergeCells('A'.($row_header[$i]+4).':'.'I'.($row_header[$i]+4));
        }
        $PHPExcel->getActiveSheet()->mergeCells('A6:I6');
        
        $PHPExcel->getActiveSheet()->mergeCells('A9:B9');
        $PHPExcel->getActiveSheet()->mergeCells('B10:C10');
        $PHPExcel->getActiveSheet()->mergeCells('B12:C12');
        $PHPExcel->getActiveSheet()->mergeCells('B13:C21');
        $PHPExcel->getActiveSheet()->mergeCells('D12:I12');
        $PHPExcel->getActiveSheet()->mergeCells('D13:I21');
        
        $PHPExcel->getActiveSheet()->mergeCells('B25:C25');
        $PHPExcel->getActiveSheet()->mergeCells('B27:C27');
        $PHPExcel->getActiveSheet()->mergeCells('B28:C36');
        $PHPExcel->getActiveSheet()->mergeCells('D27:I27');
        $PHPExcel->getActiveSheet()->mergeCells('D28:I36');

        #################  style border column   ##########################
        // $PHPExcel->getActiveSheet()->getStyle('B2:F3')->applyFromArray($styleArray);
        // $PHPExcel->getActiveSheet()->getStyle('B5:B12')->applyFromArray($styleArray);
        // $PHPExcel->getActiveSheet()->getStyle('B14:F' . --$row_data)->applyFromArray($styleArray);
        // $PHPExcel->getActiveSheet()->getStyle('B' . ($row_rekap - 4) . ':F' . $row_rekap)->applyFromArray($styleArray);
        // $PHPExcel->getActiveSheet()->getStyle('C5:F5')->applyFromArray($styleArray);

        ###################################################################################
        $filename = 'Raport ' . $student->name .' ' . $student->classroom_name . '.xlsx';

        header('Content-Type: appliaction/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Chace-Control: max-age=0 ');

        $writer = PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');

        $writer->save('php://output');
        exit;
    }
}
