<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ParseCsvToArr
{
    static function parse(UploadedFile $document): array
    {
        if (($handle = fopen($document->getRealPath(), "r")) !== FALSE) {
            $csvs = [];
            while (!feof($handle)) {
                $csvs[] = fgetcsv($handle);
            }

            $data = [];
            $column_names = [];

            foreach ($csvs[0] as $single_csv) {
                $column_names[] = $single_csv;
            }

            foreach ($csvs as $key => $csv) {
                if ($csv) {
                    if ($key === 0) {
                        continue;
                    }

                    $item = [];
                    foreach ($column_names as $column_key => $column_name) {
                        $item[Str::snake($column_name)] = $csv[$column_key];
                    }

                    array_push($data, $item);
                }
            }

            fclose($handle);

            return $data;
        }
    }
}
