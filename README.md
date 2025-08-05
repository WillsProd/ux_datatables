# UX DataTables for Symfony

![Packagist Version](https://img.shields.io/packagist/v/willsprod/ux-datatables)
![License](https://img.shields.io/packagist/l/willsprod/ux-datatables)
![Symfony UX](https://img.shields.io/badge/Symfony%20UX-compatible-brightgreen)

This bundle integrates [DataTables.net](https://datatables.net) with [Symfony UX](https://symfony.com/doc/current/frontend.html) using Stimulus.

## Features

- Easy integration of DataTables in Symfony projects.

## Requirements
- PHP 8.1 or higher
- StimulusBundle
- Composer

## Installation

```bash
composer require WillsProd/ux-datatables
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

Example to show users List in Symfony 
```php
    //App/Controller/UserController.php
    #[Route(name: 'app_user_index', methods: ['GET'])]
    public function index(DataTableBuilderInterface $builder): Response
    {
        $table = $builder->createDataTable('userTable');

        $table->setOptions([
            "columns" => [
                ["title" => 'ID'],
                ["title" => 'Email'],
                ["title" => 'Roles'],
                ["title" => 'Actions'],
            ],
            "ajax" => [
                'url' => $this->generateUrl("app_user_list"),
                'dataSrc' => ''
            ],
            'language' => [
                'url' => 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/fr-FR.json' //use https://datatables.net/plug-ins/i18n/ to find your langage
            ],
            "columnDefs" => [
                [
                    "targets" => [0], // ID column
                    "visible" => false,
                    "searchable" => false,
                ],
                [
                    "targets" => [3], // Actions column
                    "className" => "text-base !font-normal text-slate-600 border-b !border-b-slate-100 !p-1 text-right dt-head-right" // Using tailwind classes - you can install tailwind by using composer require symfonycasts/tailwindBundle - Please refer to the official documentation : https://symfony.com/bundles/TailwindBundle/current/index.html
                ],
                [
                    "targets" => [1, 2, 3],
                    "className" => "text-base !font-normal text-slate-600 border-b !border-b-slate-100 !p-1"
                ],
            ],
            "search_input" => [
                "className" => "!border-0 shadow rounded-lg"
            ]
        ]);

        return $this->render('user/index.html.twig', [
            'table' => $table
        ]);
    }
```
```php
    #[Route("/api/users", name: 'app_user_list', methods: ['GET'])]
    public function usersList(UserRepository $userRepository): JsonResponse
    {
        $showRoute = "app_user_show";
        $editRoute = "app_user_edit";

        return $this->json($userRepository->findUsers($showRoute, $editRoute));
    }
```
```php
    //App/Repository/UserRepository
    public function findUsers(string $showRoute, string $editRoute): array
    {

        $qb = $this->createQueryBuilder('u');
        $qb->select('u.id', 'u.email', 'u.roles');

        // On utilise getArrayResult() pour obtenir un tableau associatif,
        // puis on transforme chaque ligne en tableau indexé sans clé
        $result = $qb->getQuery()->getScalarResult();

        // On passe les props à la closure via 'use'
        return array_map(function ($row) use ($showRoute, $editRoute) {
            return [
                $row['id'],
                $row['email'],
                $row['roles'],
                sprintf(
                    "<a href='%s' class='text-blue-500'>Details</a> | <a href='%s' class='text-green-500'>Edit</a>",
                    $this->urlGenerator->generate($showRoute, ['id' => $row['id']]),
                    $this->urlGenerator->generate($editRoute, ['id' => $row['id']])
                )
            ];
        }, $result);
    }
```