<?php

namespace App\Test;

use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\{
    FromQuery, WithCustomQuerySize, WithHeadings, WithMapping
};

class EloquentExport implements FromQuery, WithMapping, WithHeadings, WithCustomQuerySize
{
    public Builder $query;
    public ?array $heading;
    public int $querySize;

    /**
     * EloquentExport constructor.
     *
     * @param Builder $query
     * @param null    $heading
     * @param int     $querySize
     */
    public function __construct(Builder $query, $heading = null, $querySize = 500)
    {
        $this->query = $query;
        $this->heading = $heading;
        $this->querySize = $querySize;
    }

    /**
     * @return Builder
     */
    public function query()
    {
        return $this->query;
    }

    /**
     * @param $item
     *
     * @return array
     */
    public function map($item): array
    {
        return $item->exportData();
    }

    /**
     * @return int
     */
    public function querySize(): int
    {
        return $this->querySize;
    }

    /**
     * @inheritDoc
     */
    public function headings(): array
    {
        return $this->heading;
    }
}
