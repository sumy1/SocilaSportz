<?php

	ini_set('max_execution_time', 600);

if(isset($userList)){
		$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Email Verified');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Gender');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Mobile Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Mobile Verified');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Country ');
		$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Google Address');
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Latitude');
		$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Longitude');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'User Swap');
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Login Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'User Status');
		$objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Created On');
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'Updated On');
		$count=1;
        $rowCount = 3;
		
		if(count($userList)>0){
			foreach($userList as $bookingval) {	
			if($bookingval->user_role =='1'){
			  $user_rol="End User";
			}elseif($bookingval->user_role =='2'){ 
			  $user_rol="Academy/Facility";
		   }
		   if($bookingval->user_login_type =='1'){
			  $user_login_type="Website";
			}elseif($bookingval->user_login_type =='2'){ 
			  $user_login_type="FB";
		   }elseif($bookingval->user_login_type =='3'){ 
			  $user_login_type="Google";
		   }
		   $user_status=ucfirst($bookingval->user_status);
		   $is_email_verified=ucfirst($bookingval->is_email_verified);
		   
			if($bookingval){
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $bookingval->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $bookingval->user_email);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $is_email_verified);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $bookingval->user_gender);				
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $bookingval->user_mobile_no);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $bookingval->is_mobile_verified);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $bookingval->user_city);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $bookingval->user_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $bookingval->user_country);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $bookingval->user_google_address);;
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $bookingval->user_latitude);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $bookingval->user_longitude);
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $user_rol);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $user_login_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $user_status);
				$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, date('d-m-Y',strtotime($bookingval->created_on)));
				$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, date('d-m-Y',strtotime($bookingval->updated_on)));	
				$rowCount++;
				$count++;	
			}
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:R2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	


        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:R1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "User List");
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:R1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		//FOR BOLD TEXT HEADING

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));

		$objPHPExcel->getActiveSheet()->getStyle('A1:R2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:R2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:R1")->applyFromArray(
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
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="User List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
		

	}




?>	