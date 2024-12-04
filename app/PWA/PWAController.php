<?php

namespace App\PWA;

use Illuminate\Routing\Controller;

class PWAController extends Controller
{
    public function manifestJson(): \Illuminate\Http\JsonResponse
    {
        $output = (new ManifestService)->generate();

        return response()->json($output);
    }

    public function offline(): \Illuminate\Contracts\View\View
    {
        return view('pwa.offline');
    }
}
