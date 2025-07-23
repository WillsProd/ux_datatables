<?php

namespace WillsProd\UX\DataTables\Builder;

use WillsProd\UX\DataTables\Model\DataTable;

class DataTableBuilder implements DataTableBuilderInterface
{
    public function createDataTable(?string $id = null): DataTable
    {
        return new DataTable($id);
    }
}