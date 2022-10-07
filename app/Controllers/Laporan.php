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
            ->setCellValue('A1', 'Nama Koran')
            ->setCellValue('B1', 'Bulan')
            ->setCellValue('C1', 'Tanggal')
            ->setCellValue('D1', 'Jumlah')
            ->setCellValue('E1', 'Dibuat')
            ->setCellValue('F1', 'Diperbarui');

        $column = 2;
        // tulis data mobil ke cell
        foreach ($dataKoran as $data) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $column, $data['nama_koran'])
                ->setCellValue('B' . $column, $data['bulan'])
                ->setCellValue('C' . $column, $data['tanggal'])
                ->setCellValue('D' . $column, $data['jumlah'])
                ->setCellValue('E' . $column, $data['created_at'])
                ->setCellValue('F' . $column, $data['updated_at']);
            $column++;
        }
        // tulis dalam format .xlsx
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Setoran Koran '. $start_date.' s/d '.$end_date;

        // Redirect hasil generate xlsx ke web client
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $fileName . '.xlsx');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
