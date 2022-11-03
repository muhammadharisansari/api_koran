<?php

namespace App\Controllers;

use App\Models\ModelKoran;
use App\Models\ModelSetoran;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class Laporan extends BaseController
{

    function __construct()
    {
        $this->setoran = new ModelSetoran();
        $this->model = new ModelKoran();
        date_default_timezone_set("Asia/makassar");
    }

    public function index()
    {
        $data['mitra'] = $this->model->hitung();
        $data['setoran'] = $this->setoran->hitungsetoran();
        // dd($data['mitra'], $data['setoran']);

        return  view('template/header') .
            view('template/sidebar') .
            view('laporan_view', $data) .
            view('template/footer');
    }

    public function koranExcel()
    {

        $dataKoran = $this->model->findAll();

        $spreadsheet = new Spreadsheet();
        $no = 1;
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Nama Mitra')
            ->setCellValue('C1', 'Dibuat')
            ->setCellValue('D1', 'Diperbarui');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($dataKoran as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no)
                ->setCellValue('B' . $column, $data['koran'])
                ->setCellValue('C' . $column, $data['created_at'])
                ->setCellValue('D' . $column, $data['updated_at']);
            $column++;
            $no++;
        }

        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A1:D' . ($column - 1))
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THICK);

        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Data Mitra Koran';

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function setoranExcel()
    {
        $start_date = $this->request->getPost('dari');
        $end_date = $this->request->getPost('sampai');

        $dataKoran = $this->setoran->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"')->findAll();

        $arr = [];
        $tot = [];
        $jum = 0;

        $getAllMitra = $this->model->findAll();

        foreach ($getAllMitra as $key) {
            array_push($arr, $key['koran']);
        }

        for ($i = 0; $i < sizeof($arr); $i++) {
            $jum = $jum - $jum;
            $getSet = $this->setoran->where('tanggal BETWEEN "' . date('Y-m-d', strtotime($start_date)) . '" and "' . date('Y-m-d', strtotime($end_date)) . '"&& nama_koran LIKE "' . $arr[$i] . '"')->findAll();

            foreach ($getSet as $g) {
                $jum = $jum + $g['jumlah'];
            }
            array_push($tot, $jum);
        }

        // dd($tot, $arr);

        $spreadsheet = new Spreadsheet();

        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No')
            ->setCellValue('B1', 'Dibuat')
            ->setCellValue('C1', 'Diperbarui')
            ->setCellValue('D1', 'Nama Koran')
            ->setCellValue('E1', 'Bulan')
            ->setCellValue('F1', 'Tanggal transaksi')
            ->setCellValue('G1', 'Jumlah pcs');

        $column = 2;
        $total = 0;
        $no = 1;
        // tulis data mobil ke cell
        foreach ($dataKoran as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $no)
                ->setCellValue('B' . $column, $data['created_at'])
                ->setCellValue('C' . $column, $data['updated_at'])
                ->setCellValue('D' . $column, $data['nama_koran'])
                ->setCellValue('E' . $column, $data['bulan'])
                ->setCellValue('F' . $column, $data['tanggal'])
                ->setCellValue('G' . $column, $data['jumlah']);
            $total = $total + $data['jumlah'];
            $column++;
            $no++;
        }
        // dd($getAllMitra);
        for ($i = 0; $i < sizeof($arr); $i++) {
            $spreadsheet->setActiveSheetIndex(0)->mergeCells('A' . $column . ':' . 'F' . $column)->setCellValue('A' . $column, $arr[$i])->setCellValue('G' . $column, $tot[$i]);
            $column++;
        }
        $spreadsheet->setActiveSheetIndex(0)->mergeCells('A' . $column . ':' . 'F' . $column)->setCellValue('A' . $column, "Total");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('G' . $column, $total);

        $spreadsheet
            ->getActiveSheet()
            ->getStyle('A1:G' . $column)
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(Border::BORDER_THICK);

        $spreadsheet->getActiveSheet()->getStyle('A' . $column)->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A' . $column)->getAlignment()->setVertical('center');

        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Setoran Koran ' . $start_date . ' sd ' . $end_date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
