<?php

const PAGINATE = [10, 25, 50, 100];
const DEFAULT_PAGINATE = 25;

const PAGINATION = 16;

function enumValues(string $enum)
{
    return array_column($enum::cases(), 'value');
}


