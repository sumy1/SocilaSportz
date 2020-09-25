<?php

	ini_set('max_execution_time', 600);
	ini_set('display_errors',1);
	error_reporting(E_ALL);



if(isset($MasterSportdata)){
		$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Sport name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Sport email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Created on');
		$count=1;
        $rowCount = 2;
		if(count($MasterSportdata)>0){
         foreach($MasterSportdata as $Masterdata) {	
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $Masterdata->sport_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $Masterdata->sport_status);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, date('d-m-Y',strtotime($Masterdata->created_on)));
			    $rowCount++;
				$count++;	
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A1:D1");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:D1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		// for save .xlsx workbook formate-----------------------
		
		
		$objPHPExcel->getActiveSheet(0)->setTitle('ProductDetails');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="User_facility_report_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');  
 }
	


	


?>	