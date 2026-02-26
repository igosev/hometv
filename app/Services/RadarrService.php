<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class RadarrService
{
    private function api($endpoint, $data = [], $method = 'GET')
    {
        if ($method === 'GET'){
            $response = Http::withHeaders([
                'X-Api-Key' => env('RADARR_TOKEN'),
            ])->get(env('RADARR_URL') ."/api/v3" . $endpoint);
        }else{
            $response = Http::withHeaders([
                'X-Api-Key' => env('RADARR_TOKEN'),
            ])->post(env('RADARR_URL') ."/api/v3" . $endpoint, $data);
        }

        return $response->json();
    }

    public function getMovies(){
        return $this->api("/movie");
    }

    public function getMoviePaths(){
        $movies = $this->api("/movie");

        return collect($movies)->lazy()->map(function ($m) {
            return [
                'id' => $m['id'],
                'title' => $m['title'],
                'hasFile' => $m['hasFile'],
                'path' => $m['path'],
            ];
        })->toArray();
    }

    public function getDownloadFiles()
    {
        return collect(File::allFiles(env('MEDIA_DIR') . "/downloads"))->map(function ($file) {
            return [
                'name' => $file->getFilename(),
                'path' => $file->getPathname(),
            ];
        })->toArray();
    }

    public function rescanMovie($movieId){
        return $this->api("/command", [
            'name'    => 'RescanMovie',
            'movieId' => $movieId,
        ], 'POST');
    }

    public function moveFile($file, $dir, $movieId)
    {
        // make a dir
        File::ensureDirectoryExists($dir, 0775);

        $filename = explode("/", $file);
        $filename = end($filename);

        // move file
        File::move($file, $dir . "/" . $filename);

        // rescan
        $this->rescanMovie($movieId);
        return "ok";
    }
}
