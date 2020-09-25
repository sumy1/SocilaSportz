<?php

	ini_set('max_execution_time', 600);
	ini_set('display_errors',1);
	error_reporting(E_ALL);



if(isset($coupondata)){	
		// $this->load->library('Excel');
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $i=1;
        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$i, 'S.N');
        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$i, 'Coupon Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$i, 'Coupon Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$i, 'Min Cart Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$i, 'Coupon Discount Flat');
        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$i, 'Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$i, 'End Date');
		$count=1;
        $rowCount = 2;
		if(count($coupondata)>0){
         foreach($coupondata as $Masterdata) {			 
				$objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $count);
				$objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $Masterdata->coupon_name);
				$objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $Masterdata->coupon_code);
				$objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $Masterdata->cart_min_amount);
				$objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $Masterdata->coupon_flat_amount);
				$objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, date('d-m-Y',strtotime($Masterdata->coupon_start_date)));
				$objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, date('d-m-Y',strtotime($Masterdata->coupon_end_date)));
			    $rowCount++;
				$count++;	
			}
		}else{
			$objPHPExcel->getActiveSheet(0)->mergeCells("A1:I1");
			$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', "No Record found.");	
		}	
        $objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1'.$rowCount)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
         //FOR BOLD TEXT HEADING
		 $styleArray = array(
				'font'  => array(
				'bold'  => true,
				'color' => array('rgb' => 'FFFFFF'),	
				'size'  => 14
			));
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray($styleArray);
		// set background color only heading
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->applyFromArray(array(
				'type' => PHPExcel_Style_Fill::FILL_SOLID,
				'startcolor' => array('rgb' => '1e6699')
			));	
		$objPHPExcel->getActiveSheet()->getStyle("A1:I1")->applyFromArray(
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
		
		$objPHPExcel->getActiveSheet(0)->setTitle('Coupon_List');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
  		header('Content-Type: application/vnd.ms-excel');
  		header('Content-Disposition: attachment;filename="Coupon List'.date('dMy').'.xls"');
  		$objWriter->save('php://output');
 }
 
 


	


?>	