<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class example extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:example {cammand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $command = $this->argument('cammand');

        switch ($command) {
            case 'create':
                // przyklad zapisu plikow
                Storage::put('file.text', 'kontent pliku na domyslnym dysku');
                //Storage::disk('local')->put('file.text', 'konkretnym dysku -local');
                //Storage::disk('public')->put('files/file.text', 'konkretnym dysku - public');
                break;

            case 'read':
                // odczyt danych z pliku
                $content = Storage::get('file.text'); //  pobierze z domyslnego
                $content2 = Storage::disk('local')->get('file.text'); // pobiera z zadanego
                $this->info($content);
                $this->error($content2);
                break;

            case 'exist':
                // Czy plik istnieje?
                $exists = Storage::exists('file.text');  // czy istnieje 
                $missing = Storage::missing('file.text'); // czy nie istnieje
                $this->info($exists);
                $this->error((int) $missing); // musi być rzutowany na int bo bool nic nie wyswietli
                break;

            case 'download':
                // pobieranie (ogarnij sobie to jeszcze)
                $name = 'nameForDownload.txt';
                return Storage::download('file.text'); // zwraca plik pobrany
                return  Storage::download('file.text', $name); //zwraca plik pobrany z zadaną nazwą $name
                break;

            case 'localization':
                // pobieranie lokalizacji danego pliku
                // $url = Storage::disk('public')->url('files/example.txt'); // pobiera adres do pliku 
                $url = Storage::url('files/example.txt'); // pobiera adres do pliku (ale bez localhosta)
                $path = Storage::path('file.text'); // pobiera scieszję do pliku
                $this->info("URL: $url");
                $this->error("Path: $path");
                break;

            case 'relocation':
                // relokacja pliku
                Storage::copy('file.text', 'copy_file.txt');  // kopiuj 
                Storage::move('file.text', 'new_name_path_file.txt');  // przenieś (zmień nazwę )
                break;

            case 'delete':
                // delete file
                Storage::delete('file.text');  // usuń (mozna podać tablice z kilkoma plikami)  
                break;

            case 'dirOperation':
                // swtóż usuń folder
                Storage::makeDirectory('nowy_folder');
                Storage::deleteDirectory('folder_to_trash');
                break;

            default:
                # code...
                break;
        }
    }
}
