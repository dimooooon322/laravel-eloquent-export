<?php

namespace App\Test;

interface Exportable
{
    public function exportData(): array;
    public static function heading(): array;
    public static function excelFileName(): string;
    public static function querySize(): int;
    public static function export();
}