<?php

	ini_set('max_execution_time', 600);
ini_set("display_errors",1);
//facilit listing
if(isset($facility_booking_listing)){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Order Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Payment Method');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Payment Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Booking Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Facility Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Sport Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Timing');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Final Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'Total Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i, 'Coupon Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, 'Discount Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, 'Final Amount');
		$count=1;
        $rowCount = 3;
		if(count($facility_booking_listing)>0){
		   foreach($facility_booking_listing as $BookingSlot){
		   $booking_on=date('d-m-Y',strtotime($BookingSlot->booking_on));
		   $payment_method=ucfirst($BookingSlot->payment_method);
		   $payment_status=ucfirst($BookingSlot->payment_status);
		   $booking_type=ucfirst($BookingSlot->booking_type); 
		   $fac_type=ucfirst($BookingSlot->fac_type); 
		   $start_date=date('d-m-Y',strtotime(@$BookingSlot->start_date)); 
			if($BookingSlot){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
					$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $BookingSlot->name);
					$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $BookingSlot->email);
					$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $BookingSlot->mobile);
					$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $BookingSlot->city);
					$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $BookingSlot->address);
					$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $booking_on);				
					$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $payment_method);				
					$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $payment_status);				
					$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $booking_type);				
					$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $BookingSlot->fac_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $fac_type);
					$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $BookingSlot->sport_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $BookingSlot->batch_slot_start_time);
					$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $start_date);	
					$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $BookingSlot->booking_detail_total_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $BookingSlot->booking_detail_final_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $BookingSlot->total_amount);$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $BookingSlot->coupon_code);$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $BookingSlot->discount_amount);				
					$objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $BookingSlot->final_amount);	$rowCount++;
				$count++;	
			}
			}
			}
		else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:V2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:V1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Slot Booking List");
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:V1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		//FOR BOLD TEXT HEADING

		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:V1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		$objPHPExcel->getActiveSheet(0)->setTitle('Slot_Booking_List');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Slot Booking List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	}
		
	///academy listing
if(isset($academy_listing)){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Order Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Payment Method');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Payment Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Booking Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Facility Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Timing');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Final Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'Total Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i, 'Coupon Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, 'Discount Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, 'Final Amount');
		$count=1;
        $rowCount = 3;
		if(count($academy_listing)>0){
		   foreach($academy_listing as $BookingAcademy){
		   $booking_on=date('d-m-Y',strtotime($BookingAcademy->booking_on));
		   $payment_method=ucfirst($BookingAcademy->payment_method);
		   $payment_status=ucfirst($BookingAcademy->payment_status);
		   $booking_type=ucfirst($BookingAcademy->booking_type); 
		   $fac_type=ucfirst($BookingAcademy->fac_type); 
		   $start_date=date('d-m-Y',strtotime(@$BookingAcademy->start_date)); 
			if($BookingAcademy){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
					$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $BookingAcademy->name);
					$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $BookingAcademy->email);
					$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $BookingAcademy->mobile);
					$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $BookingAcademy->city);
					$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $BookingAcademy->address);
					$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $booking_on);				
					$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $payment_method);				
					$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $payment_status);				
					$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $booking_type);				
					$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $BookingAcademy->fac_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $fac_type);
					$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $BookingAcademy->sport_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $BookingAcademy->batch_slot_start_time);
					$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $start_date);	
					$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $BookingAcademy->booking_detail_total_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $BookingAcademy->booking_detail_final_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $BookingAcademy->total_amount);$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $BookingAcademy->coupon_code);$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $BookingAcademy->discount_amount);				
					$objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $BookingAcademy->final_amount);	$rowCount++;
				$count++;	
			}
			}
			}
		else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:V2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:V1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Batch Booking List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:V1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//FOR BOLD TEXT HEADING
		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:V1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		$objPHPExcel->getActiveSheet(0)->setTitle('Batch_Booking_List');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Batch Booking List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	}

//trial booking


	///academy listing
if(isset($facility_trial_listing)){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Order Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Payment Method');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Payment Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Booking Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Facility Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Timing');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Final Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'Total Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i, 'Coupon Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, 'Discount Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, 'Final Amount');
		$count=1;
        $rowCount = 3;
		if(count($facility_trial_listing)>0){
		   foreach($facility_trial_listing as $BookingAcademy){
			  
			   
			   
			   
		   $booking_on=date('d-m-Y',strtotime($BookingAcademy->booking_on));
		   $payment_method=ucfirst($BookingAcademy->payment_method);
		   $payment_status=ucfirst($BookingAcademy->payment_status);
		   $booking_type=ucfirst($BookingAcademy->booking_type); 
		   $fac_type=ucfirst($BookingAcademy->fac_type); 
		   $start_date=date('d-m-Y',strtotime(@$BookingAcademy->start_date)); 
			if($BookingAcademy){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
					$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $BookingAcademy->name);
					$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $BookingAcademy->email);
					$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $BookingAcademy->mobile);
					$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $BookingAcademy->city);
					$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $BookingAcademy->address);
					$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $booking_on);				
					$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $payment_method);				
					$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $payment_status);				
					$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $booking_type);				
					$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $BookingAcademy->fac_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $fac_type);
					$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $BookingAcademy->sport_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $BookingAcademy->batch_slot_start_time);
					$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $start_date);	
					$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $BookingAcademy->booking_detail_total_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $BookingAcademy->booking_detail_final_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $BookingAcademy->total_amount);$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $BookingAcademy->coupon_code);$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $BookingAcademy->discount_amount);				
					$objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $BookingAcademy->final_amount);	$rowCount++;
				$count++;	
			}
			}
			}
		else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:V2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:V1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Trial Booking List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:V1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//FOR BOLD TEXT HEADING
		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:V2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:V1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:V1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}	
      	
		$objPHPExcel->getActiveSheet(0)->setTitle('Trial_Booking_List');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Trial Booking List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	}





///event listing	
if(isset($event_listing)){
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
		$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Order Date');
		$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Payment Method');
	    $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Payment Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Booking Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Facility Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Facility Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Sport Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Event Start Time');
        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Event End Time');
        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Event Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Event End Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'Amount');
		
		
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i, 'Final Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, 'Total Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, 'Coupon Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('V'.$i, 'Discount Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('W'.$i, 'Final Amount');
		$count=1;
        $rowCount = 3;
		if(count($event_listing)>0){
		   foreach($event_listing as $event_listing){
		   $booking_on=date('d-m-Y',strtotime($event_listing->booking_on));
		   $payment_method=ucfirst($event_listing->payment_method);
		   $payment_status=ucfirst($event_listing->payment_status);
		   $booking_type=ucfirst($event_listing->booking_type); 
		   $fac_type=ucfirst($event_listing->fac_type); 
		   $event_start_date=date('d-m-Y',strtotime(@$event_listing->event_start_date)); 
		   $event_end_date=date('d-m-Y',strtotime(@$event_listing->event_end_date)); 
			if($event_listing){
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
					$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $event_listing->name);
					$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $event_listing->email);
					$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $event_listing->mobile);
					$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $event_listing->city);
					$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $event_listing->address);
					$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $booking_on);				
					$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $payment_method);				
					$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $payment_status);				
					$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $booking_type);				
					$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $event_listing->fac_name);
					$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $fac_type);
					$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $event_listing->sport_name);$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $event_listing->event_start_time);
					$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $event_listing->event_end_time);	
					$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $event_start_date);	
					$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $event_end_date);	
					$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $event_listing->booking_detail_total_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $event_listing->booking_detail_final_amount);
					$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $event_listing->total_amount);$objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $event_listing->coupon_code);$objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, $event_listing->discount_amount);				
					$objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, $event_listing->final_amount);	$rowCount++;
				$count++;	
			}
			}
			}
		else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:X2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:X1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Event Booking List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:U1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
		//FOR BOLD TEXT HEADING
		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:X2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:X2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:X1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:X1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		$objPHPExcel->getActiveSheet(0)->setTitle('Event_Booking_List');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Event Booking List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	}




	
	
	
	if(isset($facility_booking_event_listing)){
		$this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
		$i=2;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Booking Order No');
		$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'User Id');
		$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Mobile');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Country');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'City');
        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Total Amount');
		$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Taxes');
        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Coupon Code');
		$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Discount Amount');
		$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Final Amount');
		$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Paymen Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$i, 'Payment Method');
		$objPHPExcel->getActiveSheet()->SetCellValue('R'.$i, 'Booking Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$i, 'Pay Transction Id');
		$objPHPExcel->getActiveSheet()->SetCellValue('T'.$i, 'Pay Transction Other');
        $objPHPExcel->getActiveSheet()->SetCellValue('U'.$i, 'Booking Status');
        $objPHPExcel->getActiveSheet()->SetCellValue('V'.$i, 'Booking On');
        $objPHPExcel->getActiveSheet()->SetCellValue('W'.$i, 'Updated On');
		
		
		
		$count=1;
        $rowCount = 3;
		if(count($facility_booking_event_listing)>0){
			foreach($facility_booking_event_listing as $bookingkeys=>$bookingval) {
					    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
						$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $bookingval->booking_order_no);
						$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $bookingval->booking_for);
						$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $bookingval->name);
						$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $bookingval->email);
						$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $bookingval->mobile);				
						$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $bookingval->country);
						$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $bookingval->state);
						$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $bookingval->city);
						$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $bookingval->address);
						$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $bookingval->total_amount);
						$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $bookingval->taxes);
						$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $bookingval->coupon_code);
						$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $bookingval->discount_amount);
						$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $bookingval->final_amount);
						$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $bookingval->payment_status);
						$objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $bookingval->payment_method);
						$objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $bookingval->booking_type);
						$objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $bookingval->pay_transction_id);
						$objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $bookingval->pay_transction_other);
						$objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $bookingval->booking_status);
						$objPHPExcel->getActiveSheet()->SetCellValue('V' . $rowCount, date('d-m-Y',strtotime($bookingval->booking_on)));
						$objPHPExcel->getActiveSheet()->SetCellValue('W' . $rowCount, date('d-m-Y',strtotime($bookingval->updated_on)));				
						$count++;			
					$rowCount++;
			}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:W2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:W1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "");
		$objPHPExcel->getActiveSheet()->getStyle('A1:AP'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		//FOR BOLD TEXT HEADING
		$styleArray = array(
			'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:W2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:W2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:W1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:AP'.$rowCount)->applyFromArray($style);	
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
		}		
		// for save .xlsx workbook formate-----------------------
		$objPHPExcel->getActiveSheet(0)->setTitle('BookingList');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Booking_List_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');  
		
}

	
	
if(isset($academy_data)){
		   $objPHPExcel = new PHPExcel();
           $objPHPExcel->setActiveSheetIndex(0);
           $i=2;
				$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
				$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'User Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Facility / Academy Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Slug');
				$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Facility / Academy');
				$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'City');
				$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Country');
				$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Address');
				$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Google Address');
				$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Pincode');
				$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Banner Image');
				$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Meta keyword');
				$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Meta Title');
				$objPHPExcel->getActiveSheet()->SetCellValue('N'.$i, 'Status');
				$objPHPExcel->getActiveSheet()->SetCellValue('O'.$i, 'Home Display');
				$objPHPExcel->getActiveSheet()->SetCellValue('P'.$i, 'Created On');
				$count=1;
				$rowCount = 3;
		if(count($academy_data)>0){
         foreach($academy_data as $academylisting) {	
			if($academylisting){				
				
				$admin_approval=ucfirst($academylisting->admin_approval);
				$is_home=ucfirst($academylisting->is_home);
				$fac_type=ucfirst($academylisting->fac_type);
				
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $academylisting->user_name[0]->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $academylisting->fac_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $academylisting->fac_slug);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $fac_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $academylisting->fac_city);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $academylisting->fac_country);
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $academylisting->fac_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $academylisting->fac_google_address);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $academylisting->fac_pincode);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $academylisting->fac_banner_image);
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $academylisting->fac_meta_keyword);
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $academylisting->fac_meta_description);
				$objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $admin_approval);
				$objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $is_home);
				$objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, date('d-m-Y',strtotime($academylisting->created_on)));
				$rowCount++;
				$count++;	

			}
		
			}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:P2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:P1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Facility Academy List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:Q'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //FOR BOLD TEXT HEADING
        $styleArray = array(
			    'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:P2')->applyFromArray($styleArray);
		// set background color only heading
		 $objPHPExcel->getActiveSheet()->getStyle('A1:P2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:P1")->applyFromArray(
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:P1'.$rowCount)->applyFromArray($style);
		//FOR AUTO FORMAT

		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);
		}		
		// for save .xlsx workbook formate-----------------------
		$objPHPExcel->getActiveSheet(0)->setTitle('Facility_Academy_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Facility Academy List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
 	
  }
  
  
  
if(isset($facility_batch_data)){
	 
	       // $this->load->library('Excel');
		   $objPHPExcel = new PHPExcel();
           $objPHPExcel->setActiveSheetIndex(0);
           $i=2;
	
			$objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
			$objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Owner Name');
			$objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Facility Name');
		    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Facility Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Start Time');
			$objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'End Time');
			$objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Start Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'End Date');
			$objPHPExcel->getActiveSheet()->SetCellValue('I'.$i, 'Is kit Available');
			$objPHPExcel->getActiveSheet()->SetCellValue('J'.$i, 'Court Type');
			$objPHPExcel->getActiveSheet()->SetCellValue('K'.$i, 'Status');
			$objPHPExcel->getActiveSheet()->SetCellValue('L'.$i, 'Created On');
			$objPHPExcel->getActiveSheet()->SetCellValue('M'.$i, 'Updated On');

		$count=1;
        $rowCount = 3;

		if(count($facility_batch_data)>0){
        foreach($facility_batch_data as $facility_batchslot_data) {	
			if($facility_batchslot_data){
				$fac_type=ucfirst($facility_batchslot_data->fac_type);
				$is_kit_available=ucfirst($facility_batchslot_data->is_kit_available);
				$fac_batch_slot_status=ucfirst($facility_batchslot_data->fac_batch_slot_status);
				
				// print_data($facility_batchslot_data);
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $facility_batchslot_data->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $facility_batchslot_data->fac_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $fac_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $facility_batchslot_data->start_time);				
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $facility_batchslot_data->end_time);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, date('d-m-Y',strtotime($facility_batchslot_data->start_date)));
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, date('d-m-Y',strtotime($facility_batchslot_data->end_date)));
				$objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $is_kit_available);
				$objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $facility_batchslot_data->court_type);
				$objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $fac_batch_slot_status);
				
				$objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, date('d-m-Y',strtotime($facility_batchslot_data->create_on)));
				$objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount,  date('d-m-Y',strtotime($facility_batchslot_data->update_on)));
				$rowCount++;
				$count++;	
			}	
			}

		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A2:M2");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A3', "No Record found.");	
		}	
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet(0)->mergeCells("A1:M1");
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', "Slot Batch List");
		$objPHPExcel->getActiveSheet()->getStyle('A1:N1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //FOR BOLD TEXT HEADING
        $styleArray = array(
			'font'  => array(
			'bold'  => true,
			'color' => array('rgb' => 'FFFFFF'),	
			'size'  => 14

			));

		$objPHPExcel->getActiveSheet()->getStyle('A1:M2')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:M2')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	

		$objPHPExcel->getActiveSheet()->getStyle("A1:M1")->applyFromArray(
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

		$objPHPExcel->getActiveSheet()->getStyle('A1:M1'.$rowCount)->applyFromArray($style);
		//FOR AUTO FORMAT

		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {

			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);

			//$objPHPExcel->getActiveSheet()->getStyle($i)->getAlignment()->setWrapText(true);

		}		
		$objPHPExcel->getActiveSheet(0)->setTitle('Slot_Batch_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Slot Batch List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
	 
}


?>	