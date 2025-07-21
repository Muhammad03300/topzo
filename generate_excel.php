<?php

// Include database connection file
include("connect_db.php");

// Fetch products data from the database
$query = "SELECT * FROM product";
$result = $conn->query($query);

// Create a new PHPExcel object
require 'PHPExcel/Classes/PHPExcel.php';
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Your Name")
                             ->setLastModifiedBy("Your Name")
                             ->setTitle("Product Data")
                             ->setSubject("Product Data")
                             ->setDescription("Product data exported from database to Excel")
                             ->setKeywords("product data excel")
                             ->setCategory("Product Management");

// Add data to the Excel sheet
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Product ID')
            ->setCellValue('B1', 'Product Title')
            ->setCellValue('C1', 'Regular Price');

$rowNumber = 2; // Start from the second row
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $objPHPExcel->getActiveSheet()->setCellValue('A' . $rowNumber, $row['product_id'])
                                      ->setCellValue('B' . $rowNumber, $row['product_title'])
                                      ->setCellValue('C' . $rowNumber, $row['regular_price']);
        $rowNumber++;
    }
}

// Set active sheet index to the first sheet and rename it
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setTitle('Product Data');

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="product_data.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');

// Close the database connection
$conn->close();

exit;
?>
