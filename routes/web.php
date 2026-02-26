<?php

use App\Services\RadarrService;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function (RadarrService $radarrService) {
    dd($radarrService->moveFile());
    return Inertia::render('Home', [

    ]);
});

Route::get('/files', function (RadarrService $radarrService) {
    return Inertia::render('Files', [
        "paths" => $radarrService->getMoviePaths(),
        "files" => $radarrService->getDownloadFiles(),
    ]);
});

Route::post('/move-files', function (RadarrService $radarrService) {
//    dd();
    $radarrService->moveFile();
    return back();
});
