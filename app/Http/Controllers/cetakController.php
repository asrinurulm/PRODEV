<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\pkp\tipp;
use App\pkp\pkp_project;
use DB;

class cetakController extends Controller
{
    public function download_project(){

        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14.67);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(11.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(4.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(4.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(4.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(15.67);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(11.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(12.57);

        $awal=1;
        $pertama=2;

        $data=tipp::join('pkp_project','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('data_forecast','data_forecast.id_pkp','pkp_project.id_project') 
            ->join('data_kemas','data_kemas.id_kemas','tippu.kemas_eksis')->where('status_data','=','active')
            ->join('users','users.id','tippu.perevisi')
            ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        dd($data);
        $no=1;
        
        
            //Inisialisasi tanggal kosong
        
            $styleArray = array(
                'background'  => array(
                    'color' => array('rgb' => 'FF0000'),
                ));


                //Bagian Isi
        
                $baris=$awal;
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$baris, 'PKP Number')
                            ->setCellValue('C'.$baris, 'Project Name')
                            ->setCellValue('D'.$baris, 'Created Date')
                            ->setCellValue('E'.$baris, 'PV')
                            ->setCellValue('F'.$baris, 'Type')
                            ->setCellValue('G'.$baris, 'Brand')
                            ->setCellValue('H'.$baris, 'Priority')
                            ->setCellValue('I'.$baris, 'Jenis')
                            ->setCellValue('J'.$baris, 'Idea')
                            ->setCellValue('K'.$baris, 'Gender')
                            ->setCellValue('L'.$baris, 'Uniqueness')
                            ->setCellValue('M'.$baris, 'Reason')
                            ->setCellValue('N'.$baris, 'Estimated')
                            ->setCellValue('O'.$baris, 'Competitive')
                            ->setCellValue('P'.$baris, 'Selling Price')
                            ->setCellValue('Q'.$baris, 'Competitor')
                            ->setCellValue('R'.$baris, 'Aisle')
                            ->setCellValue('S'.$baris, 'Product Form')
                            ->setCellValue('T'.$baris, 'AKG')
                            ->setCellValue('U'.$baris, 'Kemas')
                            ->setCellValue('AC'.$baris, 'Prefered Flavour')
                            ->setCellValue('AD'.$baris, 'Product Benefits')
                            ->setCellValue('AE'.$baris, 'Mandatory Ingredient')
                            ->setCellValue('AF'.$baris, 'Price')
                            ->setCellValue('AG'.$baris, 'UOM')
                            ->setCellValue('AH'.$baris, 'Serving Suggestion');
                            
                $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$baris, 'PKP Number');

                $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('13DFE4');

                $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getAlignment()->setHorizontal('center');

                $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getAlignment()->setHorizontal('center');

                $objPHPExcel->getActiveSheet()->mergeCells('U'.$baris.':AB'.$baris);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('AB'.$baris, 'Kemas');

                $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('13DFE4');

                $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AC".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AC".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AD".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AD".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AE".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AE".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AG".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AG".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AH".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AH".$baris)->getAlignment()->setHorizontal('center');
                
        
                foreach($data as $_data){

                $Ty = $_data['type'];
                if($Ty=='1'){
                 $type= 'maklon';               
                }elseif($Ty=='2'){
                    $type= 'internal';
                }else{
                    $type='Maklon & Internal';
                }
                
                $line=$pertama;
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$pertama, $_data['pkp_number'])
                            ->setCellValue('B'.$pertama, $_data['ket_no'])
                            ->setCellValue('C'.$pertama, $_data['project_name'])
                            ->setCellValue('C'.$pertama, $_data['created_date'])
                            ->setCellValue('C'.$pertama, $_data['name'])
                            ->setCellValue('D'.$pertama, $type)
                            ->setCellValue('E'.$pertama, $_data['id_brand'])
                            ->setCellValue('F'.$pertama, $_data['prioritas'])
                            ->setCellValue('G'.$pertama, $_data['jenis'])
                            ->setCellValue('H'.$pertama, $_data['idea'])
                            ->setCellValue('I'.$pertama, $_data['gender'])
                            ->setCellValue('J'.$pertama, $_data['Uniqueness'])
                            ->setCellValue('K'.$pertama, $_data['reason'])
                            ->setCellValue('L'.$pertama, $_data['Estimated'])
                            ->setCellValue('M'.$pertama, $_data['competitive'])
                            ->setCellValue('N'.$pertama, $_data['selling_price'])
                            ->setCellValue('O'.$pertama, $_data['competitor'])
                            ->setCellValue('P'.$pertama, $_data['aisle'])
                            ->setCellValue('Q'.$pertama, $_data['product_form'])
                            ->setCellValue('R'.$pertama, $_data['tarkon'])
                            ->setCellValue('S'.$pertama, $_data['tersier'])
                            ->setCellValue('T'.$pertama, $_data['s_tersier'])
                            ->setCellValue('U'.$pertama, $_data['sekunder1'])
                            ->setCellValue('V'.$pertama, $_data['s_sekunder1'])
                            ->setCellValue('W'.$pertama, $_data['sekunder2'])
                            ->setCellValue('X'.$pertama, $_data['s_sekunder2'])
                            ->setCellValue('Y'.$pertama, $_data['primer'])
                            ->setCellValue('Z'.$pertama, $_data['s_primer'])
                            ->setCellValue('AA'.$pertama, $_data['prefered_flavour'])
                            ->setCellValue('AB'.$pertama, $_data['product_benefits'])
                            ->setCellValue('AC'.$pertama, $_data['mandatory_ingredient'])
                            ->setCellValue('AD'.$pertama, $_data['price'])
                            ->setCellValue('AE'.$pertama, $_data['UOM'])
                            ->setCellValue('AF'.$pertama, $_data['serving_suggestion']);
        
                            $pertama++;
                        }
        
            $no++;

        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PKP');

        $skrg=date('d m Y');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Tabulasi_PKP'.$skrg.'.xls"'); 

        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}