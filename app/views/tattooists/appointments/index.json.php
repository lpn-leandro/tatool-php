<?php

$appointmentsToJson = [];

foreach ($appointments as $appointment) {
    $appointmentsToJson[] = ['id' => $appointment->getId(), 'title' => $appointment->getTitle()];
}

$json['appointments'] = $appointmentsToJson;
$json['pagination'] = [
    'page'                       => $paginator->getPage(),
    'per_page'                   => $paginator->perPage(),
    'total_of_pages'             => $paginator->totalOfPages(),
    'total_of_registers'         => $paginator->totalOfRegisters(),
    'total_of_registers_of_page' => $paginator->totalOfRegistersOfPage(),
];