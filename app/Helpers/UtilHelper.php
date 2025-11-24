<?php

const PAGINATION = [10, 25, 50, 100];

function enumValues(string $enum)
{
    return array_column($enum::cases(), 'value');
}


