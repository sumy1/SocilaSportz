<?php
ini_set('max_execution_time', 600);
if(isset($favourate_listing)){
	$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'User Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Facility Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Created On');
		$count=1;
        $rowCount = 3;
		if(count($favourate_listing)>0){
            foreach($favourate_listing as $favourateData) {	
			 $created_on=date('d-m-Y',strtotime($favourateData->created_on));
			 
			    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $favourateData->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $favourateData->fac_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $created_on);
			    $rowCount++;
				$count++;	
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:E2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:E1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "KNOWLEDGE SOURCING INTELLIGENCE (KSI) USER REPORT.");
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:E2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:E2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:E1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:E1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		// for save .xlsx workbook formate-----------------------
		$objPHPExcel->getActiveSheet(0)->setTitle('Favourate_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	 // print_data($objWriter);
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Favourate List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	}
	
	
	
if(isset($user_sport_list)){
		$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Creaded on');

		$count=1;
        $rowCount = 3;
		
		if(count($user_sport_list)>0){
			foreach($user_sport_list as $bookingval) {	
			// print_data($bookingval);
		   
			if($bookingval){
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $bookingval->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $bookingval->created_on);
				$rowCount++;
				$count++;	
			}
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:C2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	


        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:C1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "User List");
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:C1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		//FOR BOLD TEXT HEADING

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));

		$objPHPExcel->getActiveSheet()->getStyle('A1:C2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:C2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:C1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:U'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		// for save .xlsx workbook formate-----------------------
		
/////mahender 
		$objPHPExcel->getActiveSheet(0)->setTitle('User_List');
	 print_data($objPHPExcel);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="User List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
		

	}
	



	


	


?>	