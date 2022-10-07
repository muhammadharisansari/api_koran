<?php

namespace App\Controllers;

use App\Models\ModelKoran;
use App\Models\ModelSetoran;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{

    function __construct()
    {
        $this->setoran = new ModelSetoran();
        $this->model = new ModelKoran();
    }

    public function index()
    {
        $data['mitra'] = $this->model->hitung();
        $data['setoran'] = $this->setoran->hitungsetoran();
        // dd($data['mitra'], $data['setoran']);

        return  view('template/header') .
            view('laporan_view', $data) .
            view('template/footer');
    }

    public function koranExcel()
    {

        $dataKoran = $this->model->findAll();

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Nama Mitra')
            ->setCellValue('B1', 'Dibuat')
            ->setCellValue('C1', 'Diperbarui');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($dataKoran as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['koran'])
                ->setCellValue('B' . $column, $data['created_at'])
                ->setCellValue('C' . $column, $data['updated_at']);
            $column++;
        }
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

        $spreadsheet = new Spreadsheet();
        // tulis header/nama kolom 
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Dibuat')
            ->setCellValue('B1', 'Diperbarui')
            ->setCellValue('C1', 'Nama Koran')
            ->setCellValue('D1', 'Bulan')
            ->setCellValue('E1', 'Tanggal')
            ->setCellValue('F1', 'Jumlah');

        $column = 2;
        $total = 0;
        // tulis data mobil ke cell
        foreach ($dataKoran as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['created_at'])
                ->setCellValue('B' . $column, $data['updated_at'])
                ->setCellValue('C' . $column, $data['nama_koran'])
                ->setCellValue('D' . $column, $data['bulan'])
                ->setCellValue('E' . $column, $data['tanggal'])
                ->setCellValue('F' . $column, $data['jumlah']);
            $total = $total + $data['jumlah'];
            $column++;
        }
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('E' . $column, "Total");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('F' . $column, $total);
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Setoran Koran ' . $start_date . ' s/d ' . $end_date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
