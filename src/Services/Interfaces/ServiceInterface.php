<?php
/**
 * OpenAI API Client
 *
 * This file is part of OpenAI API Client.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com>
 * @copyright  Copyright © 2023 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.0
 * @link       https://muhammetsafak.com
 */

declare(strict_types=1);
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
