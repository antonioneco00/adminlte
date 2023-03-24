<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as XlsxReader;

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
        $reader = new XlsxReader();
        $sheets = $reader->load('../Eventos.xlsx');
        $sheet = $sheets->getActiveSheet();

        // Recorrer esto y por cada vez obtener todos los valores
        $value = $sheet->getCell('A2')->getValue();

        return view('home');
    }

    /* public function xlsx_json()
    {
        $reader = new XlsxReader();
        $reader->load('../Eventos.xlsx');
        
        return response()->json([
            'Clave' => 'Valor'
        ]);
    } */
}
