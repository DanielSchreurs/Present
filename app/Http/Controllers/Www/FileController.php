<?php

    namespace App\Http\Controllers\Www;

    use Illuminate\Http\Request;

    use App\Http\Requests;
    use App\Http\Controllers\Controller;
    use Symfony\Component\HttpFoundation\File\File;

    class FileController extends Controller
    {
        protected $valideMyme = array(
            'text/csv',
            'text/plain',
            'application/csv',
            'text/comma-separated-values',
            'application/excel',
            'application/vnd.ms-excel',
            'application/vnd.msexcel',
            'text/anytext',
            'application/octet-stream',
            'application/txt',
        );

        /**
         * @return mixed
         */
        public function getCSVExemple()
        {
            return \Response::download(storage_path() . '/app/CSV/exemple/exemple-file-2.csv', 'fichierExemple.csv', ['Content-Type: text/cvs']);
        }

        /**
         * @return mixed
         */
        public function getXlsExemple()
        {
            return \Response::download(storage_path() . '/app/XLSX/exemple/exemple-file.xls', 'fichierExemple.xls', ['Content-Type: application/vnd.ms-excel']);
        }

        /**
         * @param $file
         *
         * @return bool
         */
        public function isValideExelFile($file)
        {
            return in_array($this->getMime($file), $this->valideMyme);
        }

        /**
         * Get image mime type
         *
         * @param $file
         *
         * @return mixed
         */
        public function getMime($file)
        {
            return (finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file));
        }
    }
