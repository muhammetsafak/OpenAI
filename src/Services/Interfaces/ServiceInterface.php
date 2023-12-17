<?php

namespace MuhammetSafak\OpenAI\Services\Interfaces;

use MuhammetSafak\OpenAI\OpenAI;

interface ServiceInterface
{

    public function __construct(OpenAI $openAI);

    /**
     * @return array
     */
    public function get(): array;

}
