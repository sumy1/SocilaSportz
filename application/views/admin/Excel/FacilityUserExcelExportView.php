<?php
	ini_set('max_execution_time', 600);
	if(isset($userList)){
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
         foreach($userList as $userLists) {
              if($userLists->user_role =='1'){
			  $user_rol="End User";
			}elseif($userLists->user_role =='2'){ 
			  $user_rol="Academy/Facility";
		   }
		   if($userLists->user_login_type =='1'){
			  $user_login_type="Website";
			}elseif($userLists->user_login_type =='2'){ 
			  $user_login_type="FB";
		   }elseif($userLists->user_login_type =='3'){ 
			  $user_login_type="Google";
		   }if($userLists->user_status =='enable'){
			    $user_status="Active";
		   }elseif($userLists->user_status =='disable'){
			    $user_status="Inactive";
		   }			 
           if($userLists){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $userLists->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $userLists->user_email);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $userLists->is_email_verified);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $userLists->user_gender);				
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $userLists->user_mobile_no);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $userLists->is_mobile_verified);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $userLists->user_city);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $userLists->user_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $userLists->user_country);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $userLists->user_google_address);;
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $userLists->user_latitude);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $userLists->user_longitude);
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $user_rol);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $user_login_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $user_status);
				$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, date('d-m-Y',strtotime($userLists->created_on)));
				$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, date('d-m-Y',strtotime($userLists->updated_on)));	
				$rowCount++;
				$count++;	

			}}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:S2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:S1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "User List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:U'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:S2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:S2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:S1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:S1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		$objPHPExcel->getActiveSheet(0)->setTitle('User_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="User List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	}
	
	if(isset($user_bank_details_data)){
		// $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Owner Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Account Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Account Number');
		$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Account Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Bank Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Branch Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'GST No');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'CIN No');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'GST Image');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'PAN Image');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'FIRM Image');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Address Proof Image');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'CHEQUE Image');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Admin Approval');
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Created On');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Updated On');
        $rowCount = 3;
        $count=1;
		if($user_bank_details_data){
         foreach($user_bank_details_data as $BankKey=>$BankVal) {	
		$admin_aprovel=ucfirst($BankVal->admin_approval);
		
		
           if($BankVal){
			   $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $user_bank_details_data[$BankKey]->user_names->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $BankVal->account_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $BankVal->account_number);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $BankVal->account_type);				
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $BankVal->bank_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $BankVal->branch_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $BankVal->gst_no);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $BankVal->cin_no);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $BankVal->gst_image);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $BankVal->pan_image);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $BankVal->firm_image);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $BankVal->address_proof_image);
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $BankVal->cheque_image);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $admin_aprovel);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, date('d-m-Y',strtotime($BankVal->created_on)));
				$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, date('d-m-Y',strtotime($BankVal->updated_on)));
			    $rowCount++;
				$count++;	

			}}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:R2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:R1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Event List");
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:R1'.$rowCount)->applyFromArray($style);

		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}
		$objPHPExcel->getActiveSheet(0)->setTitle('User_Bank_list');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Bank List'.date('dMy').'.xls"');
  		$objWriter->save('php://output'); 

	}
	

if(isset($fac_event_listing)){
		// $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Sport Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Event Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Event Slug');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Event Meta Title');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Facility Meta Keyword');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Event Price');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Event Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Event Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Event Venue');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Event City');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Event Person Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Event Person Contact');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Is Home');


        $rowCount = 3;
        $count=1;
		if($fac_event_listing){
         foreach($fac_event_listing as $eventKey=>$eventVal) {	
		// $admin_aprovel=ucfirst($eventVal->admin_approval);
		$event_start_date=date('d-m-y',strtotime($eventVal->event_start_date));
		$event_end_date=date('d-m-y',strtotime($eventVal->event_end_date));
		$event_approval=ucfirst($eventVal->event_approval);
		$is_home=ucfirst($eventVal->is_home);
		
		
           if($eventVal){
			   // print_data($eventVal);
			   $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
			   $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $eventVal->sport_name);
			   $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $eventVal->event_name);
			   $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $eventVal->event_slug);
			   $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $eventVal->event_meta_title);
			   $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $eventVal->event_meta_keyword);
			   $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $eventVal->event_price);
			   $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $event_start_date);
			   $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $event_end_date);
			   $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $eventVal->event_venue);
			   $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $eventVal->event_city);
			   $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $eventVal->event_contact_person_email);
			   $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $eventVal->event_contact_person_no);
			   $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $event_approval);
			   $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $is_home);
			
				
			    $rowCount++;
				$count++;	

			}}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:Q2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:Q1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Event  List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:Q1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:Q2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:Q1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:Q1'.$rowCount)->applyFromArray($style);

		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}
		// print_data($objPHPExcel);
		$objPHPExcel->getActiveSheet(0)->setTitle('Event_list');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Event List'.date('dMy').'.xls"');
  		$objWriter->save('php://output'); 

	}

	

	
	
	
	///news letter
	
	
	if(isset($letterlist)){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Created On');


        $rowCount = 3;
        $count=1;
		if($letterlist){
         foreach($letterlist as $letterlisttKey=>$letterlistVal) {	
		// $admin_aprovel=ucfirst($eventVal->admin_approval);
		$create_on=date('d-m-y',strtotime($letterlistVal->create_on));
		
		
           if($letterlistVal){
			   // print_data($eventVal);
			   $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
			   $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $letterlistVal->email);
			   $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $create_on);
			   
			
				
			    $rowCount++;
				$count++;	

			}}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:C2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:C1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Event  List");
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:C1'.$rowCount)->applyFromArray($style);

		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}
		$objPHPExcel->getActiveSheet(0)->setTitle('Newletter_list');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		// print_data($objWriter);
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Newletter list'.date('dMy').'.xls"');
  		$objWriter->save('php://output'); 

	}
	


?>	