<?php

namespace MuhammetSafak\OpenAI\Services;

use MuhammetSafak\OpenAI\Clientable;
use MuhammetSafak\OpenAI\OpenAI;
use MuhammetSafak\OpenAI\Services\Interfaces\ServiceInterface;

class Chat implements ServiceInterface
{

    use Clientable;

    protected OpenAI $openAI;

    protected string $userMessage;

    protected string $url = 'https://api.openai.com/v1/chat/completions';

    public function __construct(OpenAI $openAI)
    {
        $this->openAI = $openAI;
    }

    /**
     * @param string $userMessage
     * @return $this
     */
    public function setUserMessage(string $userMessage): self
    {
        $this->userMessage = $userMessage;

        return $this;
    }

    /**
     * @return string
     */
    public function getUserMessage(): string
    {
        return $this->userMessage;
    }

    public function get(): array
    {
        $body = [
            'messages'      => [
                [
                    'role'      => 'system',
                    'content'   => $this->openAI->getPrompt(),
                ],
                [
                    'role'      => 'user',
                    'content'   => $this->getUserMessage(),
                ]
            ],
        ];
        if (null !== ($model = $this->openAI->getModel())) {
            $body['model'] = $model;
        }
        if (null !== ($engine = $this->openAI->getEngine())) {
            $body['engine'] = $engine;
        }
        if ($engine === null && $model === null) {
            $body['model'] = 'gpt-3.5-turbo';
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
