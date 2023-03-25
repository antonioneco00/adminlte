<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function xlsx_json()
    {
        $reader = new XlsxReader();
        $sheets = $reader->load('../Eventos.xlsx');
        $sheet = $sheets->getActiveSheet();

        $rows = $sheet->getHighestRow();

        $events = [];

        for ($i = 2; $i <= $rows; $i++) {
            $inicio = ($sheet->getCell("B$i")->getValue() - 25569) * 86400;
            $fin = ($sheet->getCell("C$i")->getValue() - 25569) * 86400;

            array_push($events, [
                "Titulo" => $sheet->getCell("A$i")->getValue(),
                "Inicio" => date('Y-m-d H:m', $inicio),
                "Fin" => date('Y-m-d H:m', $fin),
                "Tipo" => $sheet->getCell("D$i")->getValue(),
            ]);
        }

        return response()->json($events);
    }
}
