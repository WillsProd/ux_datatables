<?php

namespace WillsProd\UX\DataTables\Builder;

use WillsProd\UX\DataTables\Model\DataTable;

interface DataTableBuilderInterface
{
    public function createDataTable(?string $id = null) : DataTable;
}