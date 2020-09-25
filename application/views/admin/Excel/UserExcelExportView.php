<?php

	ini_set('max_execution_time', 600);



	if(isset($userList)){
		$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'User name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'User email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Is email verified');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'User password');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'User gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'User mobile no');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Is mobile verified');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'User city');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'User address');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'User address2');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'User pincode');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'User country ');
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'User google address');
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'User latitude');
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'User longitude');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'User role');
		$objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'User login type');
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i, 'User status');
		$objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, 'Created on');
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, 'Updated on');
		$count=1;
        $rowCount = 3;

		if(count($userList)>0){
         foreach($userList as $bookingval) {	
           if($bookingval){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $bookingval->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $bookingval->user_email);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $bookingval->is_email_verified);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $bookingval->user_password);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $bookingval->user_gender);				
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $bookingval->user_mobile_no);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $bookingval->is_mobile_verified);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $bookingval->user_city);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $bookingval->user_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $bookingval->user_address2);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $bookingval->user_pincode);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $bookingval->user_country);
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $bookingval->user_google_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $bookingval->user_latitude);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $bookingval->user_longitude);
				$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $bookingval->user_role);
				$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $bookingval->user_login_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $bookingval->user_status);
				$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, date('d-m-Y',strtotime($bookingval->created_on)));
				$objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, date('d-m-Y',strtotime($bookingval->updated_on)));
			    $rowCount++;
				$count++;	

			}}

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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2005');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="User_facility_report_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2005');
        $objWriter->save('php://output');  
		
		// for save .xls workbook formate------------
		// $objPHPExcel->getActiveSheet(0)->setTitle('ProductDetails');
        // $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        // header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment;filename="Product_report_'.date('dMy').'.xls"');
        // header('Cache-Control: max-age=0');
        // $objWriter->save('php://output');  
		

	}
	


	


?>	