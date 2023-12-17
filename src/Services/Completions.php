<?php
/**
 * OpenAI API Client
 *
 * This file is part of OpenAI API Client.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2023 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);
namespace MuhammetSafak\OpenAI\Services;

use MuhammetSafak\OpenAI\Clientable;
use MuhammetSafak\OpenAI\OpenAI;
use MuhammetSafak\OpenAI\Services\Interfaces\ServiceInterface;

class Completions implements ServiceInterface
{

    use Clientable;

    protected OpenAI $openAI;

    protected string $url = 'https://api.openai.com/v1/completions';

    public function __construct(OpenAI $openAI)
    {
        $this->openAI = $openAI;
    }

    public function get(): array
    {
        $body = [];
        if (null !== ($model = $this->openAI->getModel())) {
            $body['model'] = $model;
        }
        if (null !== ($engine = $this->openAI->getEngine())) {
            $body['engine'] = $engine;
        }
        if ($engine === null && $model === null) {
            $body['model'] = 'davinci-002';
        }

        return $this->sendRequest('POST', $this->url, [
            "Content-Type"      => "application/json",
            "Authorization"     => "Bearer " . $this->openAI->getSecretKey(),
        ], array_merge($body, [
            'prompt'            => $this->openAI->getPrompt(),
            'max_tokens'        => $this->openAI->getMaxTokens(),
            'top_p'             => $this->openAI->getTopP(),
            'temperature'       => $this->openAI->getTemperature(),
            'frequency_penalty' => $this->openAI->getFrequencyPenalty(),
            'presence_penalty'  => $this->openAI->getPresencePenalty(),
        ]));
    }

}
