<?php
include('../TCPDF-main/tcpdf.php');
 session_start();
   include '../connectdb/connect.php';
           require '../model/user_model.php';



// extend TCPF with custom functions
class MYPDF extends TCPDF {
    
    // Load table data from file
    public function LoadData() {
      
         $con = ketnoi();
         $ma_don_hang=$_GET['ma_don_hang'];

         $sql="SELECT don_hang.ten_nguoinhan,don_hang.sdt_nguoinhan,don_hang.diachi_giaohang,user_new.user_id,user_new.email,sanpham.ten,ctdh.ma_don_hang,ctdh.so_luong,ctdh.size,sanpham.don_gia"
                 . " from don_hang, user_new, chi_tiet_don_hang as ctdh,sanpham where ctdh.ma_don_hang=$ma_don_hang and sanpham.id_sanpham=ctdh.id_sanpham and user_new.user_id=don_hang.user_id and ctdh.ma_don_hang=don_hang.ma_don_hang";
         $query=mysqli_query($con,$sql);
      return $query;
    }

  public function thong_tin_nguoi_dat($data){
         $model = new user_model();
          $con = ketnoi();
         $ma_don_hang=$_GET['ma_don_hang'];
         $sql1="SELECT email,don_hang.user_id FROM don_hang,user_new where don_hang.user_id=user_new.user_id and ma_don_hang=$ma_don_hang";
         $query1=mysqli_query($con,$sql1);
         //  $result = $model->getInfo(intval($_SESSION['id']));
                $row = mysqli_fetch_assoc($query1);
          $truoc = explode("@", $row['email']);
                $giaima = $truoc[0];
                $email = $giaima."@".$truoc[1];
      foreach($query1 as $row) {
           $this->writeHTML("Ma don hang: ".$ma_don_hang, true, false, true, false, '');
             $this->writeHTML("Khach hang: ".$email, true, false, true, false, '');
          $mdh=$row['ma_don_hang'];
            $this->writeHTML("<br>", true, false, true, false, '');
      }   
      return $mdh;
    }
    public function thong_tin_nguoi_nhan(   ){
        $con = ketnoi();
         $ma_don_hang=$_GET['ma_don_hang'];
         $sql2="SELECT * FROM `don_hang` where ma_don_hang=$ma_don_hang";
         $query2=mysqli_query($con,$sql2);
        
     foreach($query2 as $row) {
          $bo_dau1 = $row['ten_nguoinhan'];
           $bo_dau2 =$row['diachi_giaohang'];
           $this->writeHTML("Ten nguoi nhan: ".$bo_dau1, true, false, true, false, '');
           $this->writeHTML("Sdt nguoi nhan: ".$row['sdt_nguoinhan'], true, false, true, false, '');
           $this->writeHTML("Dia chi giao hang: ".$bo_dau2, true, false, true, false, '');
           }   
    }
    // Colored table
    public function ColoredTable($header,$data,$total) {
      
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('', 'B');
        
        
        // Header
        $w = array( 20,60, 30,35,35);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', 1);
        }
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = 0;
        $i=1;
        $total=0;
        foreach($data as $row) {
          $this->Cell($w[0], 6, $i, 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['ten'], 'LR', 0, 'C', $fill);
          $this->Cell($w[2], 6, $row['size'], 'LR', 0, 'C', $fill);
          $this->Cell($w[3], 6, $row['so_luong'], 'LR', 0, 'C', $fill);
            $this->Cell($w[4], 6, $row['don_gia'], 'LR', 0, 'C', $fill);
            $total+=$row['so_luong']*$row['don_gia'];
            $this->Ln();
            $fill=!$fill;
            $i++;
        }
    
        $this->Cell(array_sum($w), 0, '', 'T');
           return $total;
    }
    }
    

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('áa');
$pdf->SetTitle('Hoa Don');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, abc, test, hhhhh');
$pdf->setPrintHeader(true   );
$pdf->setPrintFooter(true);

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'Shop');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();

// column titles
$header = array('STT','Ten san pham','Size','So luong','Don gia');

// data loading
$data = $pdf->LoadData();
 
// print colored table
$mdh=$pdf->thong_tin_nguoi_dat($data);
$total1 = $pdf->ColoredTable($header, $data,$total);
$pdf->writeHTML("<br>", true, false, true, false, '');
$pdf->writeHTML("<h3>Tong cong: ".$total1, true, false, true, false, '');
$pdf->writeHTML("<br>", true, false, true, false, '');
$pdf->writeHTML("<h4>Thong tin giao hang</h4>", true, false, true, false, '');
$pdf->thong_tin_nguoi_nhan($data);
// ---------------------------------------------------------

// close and output PDF document
$pdf->Output('hoa_don '.$mdh.'.pdf', 'I');

?>

    
    