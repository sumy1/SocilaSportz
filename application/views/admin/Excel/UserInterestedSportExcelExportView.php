<?php
ini_set('max_execution_time', 600);



	if(isset($user_sport_lists)){

		
		$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'User name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'User email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Is email verified');
		$count=1;
        $rowCount = 3;

		if(count($user_sport_lists)>0){
            foreach($user_sport_lists as $usersportKey=>$usersportVal) {	
		   
			    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $usersportVal->created_on);
				// print_data($user_sport_lists[$usersportKey]);
				 foreach($user_sport_lists[$usersportKey]->sport_list as $sportval){
				  $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $sportval->sport_name);
			}
			 foreach($user_sport_lists[$usersportKey]->user_list as $userdata){
				  $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $userdata->user_name);
			}
			
			    $rowCount++;
				$count++;	

			}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:U2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
			
		}
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:U1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "KNOWLEDGE SOURCING INTELLIGENCE (KSI) USER REPORT.");
		$objPHPExcel->getActiveSheet()->getStyle('A1:U'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:U2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:U2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:U1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:U1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		// for save .xlsx workbook formate-----------------------
	  $objPHPExcel->getActiveSheet(0)->setTitle('ProductDetails');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Product_report_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');  
		
		//for save .xls workbook formate------------
	/* 	$objPHPExcel->getActiveSheet(0)->setTitle('ProductDetails');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Product_report_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');   */ 
		

	}
	


	


?>	