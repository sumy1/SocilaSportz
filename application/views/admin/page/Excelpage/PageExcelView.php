<?php

	ini_set('max_execution_time', 600);
	ini_set('display_errors',1);
	error_reporting(E_ALL);


if(isset($careerdata)){	
		// $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Contact No');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Message');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Resume');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Created on');	
		$count=1;
        $rowCount = 2;
		
		
		if(count($careerdata)>0){
         foreach($careerdata as $careerdata) {
               $messages=substr($careerdata->message,0,50);
		        $create_on=date('d-m-Y',strtotime($careerdata->created_on));			 
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $careerdata->name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $careerdata->email);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $careerdata->mobile);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $messages);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $careerdata->resume);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $create_on);
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
		// print_data($objPHPExcel);
		$objPHPExcel->getActiveSheet(0)->setTitle('Career_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Career List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
 }
 
 
 
if(isset($contactdata)){	
		// $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Contact No');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Subject');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Message');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Created on');
		$count=1;
        $rowCount = 2;
		if(count($contactdata)>0){
         foreach($contactdata as $Masterdata) {	
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $Masterdata->query_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $Masterdata->query_email);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $Masterdata->query_contact);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $Masterdata->query_title);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, substr($Masterdata->query_message,0,50));
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, date('d-m-Y',strtotime($Masterdata->create_on)));
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:D1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
		}		
		// for save .xlsx workbook formate-----------------------
		
		$objPHPExcel->getActiveSheet(0)->setTitle('Contact_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Contact List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
		
 }
 
 
 if(isset($enquiredata)){	
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'User Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Facility Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'User Email');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'User Contact');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Subject');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'Message');
        $objPHPExcel->getActiveSheet()->SetCellValue('H'.$i, 'Created on');	
		$count=1;
        $rowCount = 2;
		if(count($enquiredata)>0){
         foreach($enquiredata as $Masterdata) {	
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $Masterdata->user_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $Masterdata->fac_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $Masterdata->user_email);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $Masterdata->user_mobile);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $Masterdata->query_title);
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, substr($Masterdata->query_message,0,50));
				$objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, date('d-m-Y',strtotime($Masterdata->create_on)));
			    $rowCount++;
				$count++;	
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A1:J1");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:J1")->applyFromArray(
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
		$objPHPExcel->getActiveSheet()->getStyle('A1:J1'.$rowCount)->applyFromArray($style);	
		//FOR AUTO FORMAT
		for ($i = 'A'; $i !=  $objPHPExcel->getActiveSheet(0)->getHighestColumn(); $i++) {
			$objPHPExcel->getActiveSheet(0)->getColumnDimension($i)->setAutoSize(TRUE);
		}		
		// for save .xlsx workbook formate-----------------------
		$objPHPExcel->getActiveSheet(0)->setTitle('Enquire_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Enquire List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
 }
	


	


?>	