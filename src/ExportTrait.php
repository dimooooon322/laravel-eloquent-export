<?php

namespace dimooooon322\Export;

use Illuminate\Database\Eloquent\Builder;

trait ExportTrait
{
    public function exportData(): array
    {
        return $this->toArray();
    }

    public static function heading(): array
    {
        return \DB::table('INFORMATION_SCHEMA.COLUMNS')
                  ->where('TABLE_NAME', self::query()->toBase()->from)
                  ->select(['COLUMN_NAME'])
                  ->get()
                  ->pluck('COLUMN_NAME')
                  ->toArray();
    }

    public static function querySize(): int
    {
        return 500;
    }

    public static function excelFileName(): string
    {
        return (new \ReflectionClass(self::class))->getShortName().'_'.date('d-m-Y').'.xlsx';
    }

    public static function export(?Builder $query = null)
    {
        if (is_null($query)) {
            $query = self::query();
        }

        $heading = self::heading();
        $querySize = self::querySize();
        $filename = self::excelFileName();

        return \Excel::store(new EloquentExport($query, $heading, $querySize), $filename);
    }
}