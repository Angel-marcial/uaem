<?php

namespace App\Http\Controllers\Guardias;
use App\Http\Controllers\Controller;

class GuardiasController extends Controller
{
    public function indexGuardias()
    {
        return view('guardias.indexGuardia');
    }
}