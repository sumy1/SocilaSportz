<?php

	ini_set('max_execution_time', 600);
	ini_set('display_errors',1);
	error_reporting(E_ALL);



if(isset($rating_data)){	
	$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
	    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'User name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Facility name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'User email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Rating type');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Admin Approval');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Created on');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Updated on');
		$count=1;
        $rowCount = 2;
		if(count($rating_data)>0){
         foreach($rating_data as $MasterKey=>$MasterVal) {
		 $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
		 $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $MasterVal->user_name);
		     foreach($rating_data[$MasterKey]->facility_name as $facilityname){
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $facilityname); 
			 }	  
			    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $MasterVal->user_email);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $MasterVal->rating_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $MasterVal->admin_approval);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, date('d-m-Y',strtotime($MasterVal->created_on)));
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, date('d-m-Y',strtotime($MasterVal->updated_on)));
			    $rowCount++;
				$count++;	
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A1:H1");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:H1")->applyFromArray(
			array(
				  'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
						'color' => array('rgb' => 'FFFFFF')
					)
				  )
			)
		);
        $style = array(
			'alignment' => array(
			'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			'vertical' => PHPExcel_Style_Alignment::VERTICAL_TOP,
			)
		);	
		$objPHPExcel->getActiveSheet()->getStyle('A1:H1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
		}		
		// for save .xlsx workbook formate-----------------------
		
		$objPHPExcel->getActiveSheet(0)->setTitle('ReviewDetails');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ReviewReport'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');  
 }
 
 


	


?>	