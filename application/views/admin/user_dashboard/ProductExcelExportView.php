<?php
ini_set('max_execution_time', 600);
if(isset($user_sport_list)){
	// print_data($user_sport_list);
	 
	      $this->load->library('Excel');
		   $objPHPExcel = new PHPExcel();
           $objPHPExcel->setActiveSheetIndex(0);
           $i=2;
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Fac Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'User Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Is Trial');
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Start Time');
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'End Time');
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Start Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'End_Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Actual Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Is kit Available');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Kit Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Court Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Court Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Max Participanets');
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Fac Batch Slot Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Created On');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Updated On');

		$count=1;
        $rowCount = 3;

		if(count($user_sport_list)>0){
        foreach($user_sport_list as $user_sport_list) {
			
			    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
			    $objPHPExcel->getActiveSheet()->SetCellValue('b' . $user_sport_list, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, date('d-m-Y',strtotime($user_sport_list->created_on)));
			
				
				$rowCount++;
				$count++;	
			}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:Z2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:Z1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "KNOWLEDGE SOURCING INTELLIGENCE (KSI) USER REPORT.");
		$objPHPExcel->getActiveSheet()->getStyle('A1:AE'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //FOR BOLD TEXT HEADING
        $styleArray = array(

			'font'  => array(

				'bold'  => true,

				'color' => array('rgb' => 'FFFFFF'),	

				'size'  => 14

			));

		$objPHPExcel->getActiveSheet()->getStyle('A1:Z2')->applyFromArray($styleArray);

		// set background color only heading

		$objPHPExcel->getActiveSheet()->getStyle('A1:Z2')->getFill()->applyFromArray(array(

				'type' => PHPExcel_Style_Fill::FILL_SOLID,

				'startcolor' => array('rgb' => '1e6699')

			));	

		$objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->applyFromArray(

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

		$objPHPExcel->getActiveSheet()->getStyle('A1:AZ'.$rowCount)->applyFromArray($style);
		//FOR AUTO FORMAT

		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {

			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);

			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);

		}		
		// for save .xlsx workbook formate-----------------------
		$objPHPExcel->getActiveSheet(0)->setTitle('ProductDetails');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// print_data($objWriter);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Product_report_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				print_data($objWriter);
  
		$objWriter->save('php://output');  
	 
	 
}





ini_set("display_errors",0);
if(isset($favourate_listings)){
	// print_data($user_sport_list);
	 
	      $this->load->library('Excel');
		   $objPHPExcel = new PHPExcel();
           $objPHPExcel->setActiveSheetIndex(0);
           $i=2;
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Fac Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'User Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Is Trial');
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Start Time');
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'End Time');
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Start Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'End_Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Actual Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Is kit Available');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Kit Price');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Court Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Court Description');
			$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Max Participanets');
			$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Fac Batch Slot Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Created On');
			$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Updated On');

		$count=1;
        $rowCount = 3;

		if(count($favourate_listings)>0){
        foreach($favourate_listings as $favourate_listings) {
			
			    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, date('d-m-Y',strtotime($favourate_listings->created_on)));
			
				
				$rowCount++;
				$count++;	
			}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:Z2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:Z1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "KNOWLEDGE SOURCING INTELLIGENCE (KSI) USER REPORT.");
		$objPHPExcel->getActiveSheet()->getStyle('A1:AE'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //FOR BOLD TEXT HEADING
        $styleArray = array(

			'font'  => array(

				'bold'  => true,

				'color' => array('rgb' => 'FFFFFF'),	

				'size'  => 14

			));

		$objPHPExcel->getActiveSheet()->getStyle('A1:Z2')->applyFromArray($styleArray);

		// set background color only heading

		$objPHPExcel->getActiveSheet()->getStyle('A1:Z2')->getFill()->applyFromArray(array(

				'type' => PHPExcel_Style_Fill::FILL_SOLID,

				'startcolor' => array('rgb' => '1e6699')

			));	

		$objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->applyFromArray(

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

		$objPHPExcel->getActiveSheet()->getStyle('A1:AZ'.$rowCount)->applyFromArray($style);
		//FOR AUTO FORMAT

		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {

			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);

			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);

		}		
		// for save .xlsx workbook formate-----------------------
		$objPHPExcel->getActiveSheet(0)->setTitle('ProductDetails');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		// print_data($objWriter);
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Product_report_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
				print_data($objWriter);
  
		$objWriter->save('php://output');  
	 
	 
}
?>