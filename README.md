# UX DataTables for Symfony

![Packagist Version](https://img.shields.io/packagist/v/willsprod/ux-datatables)
![License](https://img.shields.io/packagist/l/willsprod/ux-datatables)
![Symfony UX](https://img.shields.io/badge/Symfony%20UX-compatible-brightgreen)

This bundle integrates [DataTables.net](https://datatables.net) with [Symfony UX](https://symfony.com/doc/current/frontend.html) using Stimulus.

## Features

- Easy integration of DataTables in Symfony projects.
- Supports Symfony UX (Stimulus controllers).
- Customizable via Twig and Stimulus options.

## Installation

```bash
composer require willsprod/ux-datatables
```

Make sure StimulusBundle is installed:
```bash
composer require symfony/stimulus-bundle
```

## Usage

Build you dataTable in your controller:
```php
$table = new DataTable();

return $this->render('path/to/your/twig', [
    'table' => $table
])
```

Render the dataTable in your twig template:
```bash
render_datatable(table)
```