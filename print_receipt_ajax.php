<?php
ob_start();
require_once './config/config.php';
require('fpdf/fpdf.php');

$order_id = $_POST['orderId'];
$customer_name = $_POST['customerName'];
$total_amount = $_POST['totalAmount'];
$excel_receipt_no = $_POST['receiptNumber'];


$db = getDbInstance();

$db->where("order_id", $order_id);
$items = $db->get("et_items");

$receipt_no = str_pad($order_id, 4, '0', STR_PAD_LEFT);

// echo json_encode($receipt_no);

$pdf = new FPDF();
$pdf->AddPage('P');
$pdf->SetFont('Arial','B',14);
$pdf->Rect(10, 10, 190, 230, 'D');
$pdf->Cell(70);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(30,10,'EXCEL MEN\'S WEAR');
$pdf->Ln(5);
$pdf->SetFont('Arial','I',10);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50);
$pdf->Cell(30,10,'102 Ghorpade peth, Aman Heights, Opp Devki Restaurent,');
$pdf->Ln(5);
$pdf->Cell(80);
$pdf->Cell(30,10,'Pune - 411042');
$pdf->Ln(15);
$pdf->SetFont('Arial','',14);
$pdf->Cell(7);
$pdf->Cell(27,10,'Receipt No: ');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(2,10,$receipt_no);
$pdf->Cell(30);
$pdf->SetFont('Arial','',14);
$pdf->Cell(40,10,'Excel Receipt No: ');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(2,10,$excel_receipt_no);
$pdf->Cell(29);
$pdf->SetFont('Arial','',14);
$pdf->Cell(13,10,'Date: ');
$pdf->SetFont('Arial','B',14);
$pdf->Cell(2,10,date('d M Y'));
$pdf->Ln(12);
$pdf->Cell(7);
$pdf->Cell(32,10,'Payee Name: ');
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,10,$customer_name);
$pdf->Rect(17, 60, 179, 110, 'D');
$pdf->Line(17, 70, 196, 70);
//$pdf->Rect(116, 170, 80, 10, 'D');
$pdf->Rect(116, 170, 80, 10, 'D');
$pdf->Line(116, 60, 116, 170);
$pdf->Line(150, 60, 150, 170);
$pdf->Line(165, 60, 165, 180);
$pdf->SetFont('Arial','B',12);
$pdf->Ln(13);
$pdf->Cell(15);
$pdf->Cell(30,10,'Description');
$pdf->Cell(63);
$pdf->Cell(12,10,'Rate');
$pdf->Cell(22);
$pdf->Cell(7,10,'Qty.');
$pdf->Cell(8);
$pdf->Cell(30,10,'Amount');
$pdf->Ln(5);
$tax_amount = 0;
$total = 0;
foreach($items as $item) {
  $pdf->Ln(8);
  $pdf->Cell(15);
  $pdf->SetFont('Arial','',12);
  $pdf->Cell(30,10,$item['item_type']);
  $pdf->Cell(63);
  $tax_excluded_amount = round(($item['item_rate'] / 118) * 100, 2);
  $tax_amount = $tax_amount + $tax_excluded_amount * $item['item_quantity'];
  //$pdf->Cell(10,10, 'Rs.'.$tax_excluded_amount);
  $pdf->Cell(10,10, 'Rs.'.$item['item_rate']);
  $pdf->Cell(25);
  $pdf->Cell(13,10,$item['item_quantity']);
  $pdf->Cell(1);
  $pdf->Cell(30,10, 'Rs.'. $item['item_amount']);
}
// $pdf->Text(130,176,'GST (18%)');
// $tax_amount = ($tax_amount * 18) / 100; 
// $pdf->Text(168,176, 'Rs.'.round($tax_amount, 2));
$pdf->Text(135,176,'Total');
$pdf->Text(168,176,'Rs.' . $total_amount);
$pdf->SetFont('Arial','IB',12);
$pdf->Text(145,210,'For Excel Men\'s Wear');
$pdf->SetFont('Arial','I',12);
$pdf->Text(145,230,'Receiver\'s Signature');
$pdf->SetFont('Arial','B',12);
$pdf->Text(15,200,'Timing: ');
$pdf->SetFont('Arial','',12);
$pdf->Text(15,207,'10:00 AM to 01:00 PM ');
$pdf->Text(15,214,'04:00 PM to 08:30 PM');
$pdf->SetFont('Arial','BI',12);
$pdf->SetTextColor(255,0,0);
$pdf->Text(15,230,'Monday Closed');

$op = $pdf->Output('F', 'receipts/excel-'.$order_id.'.pdf');

// ob_end_clean();

echo json_encode('receipts/excel-'.$order_id.'.pdf');