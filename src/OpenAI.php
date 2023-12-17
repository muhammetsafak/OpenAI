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
namespace MuhammetSafak\OpenAI;

use InvalidArgumentException;

class OpenAI
{

    /**
     * @var string
     */
    private string $engine;

    /**
     * @var string
     */
    private string $model;

    /**
     * @var string
     */
    private string $secretKey;

    /**
     * @var string
     */
    private string $prompt;

    /**
     * @var int
     */
    private int $maxTokens = 256;

    /** @var int|float */
    private $temperature = 0.4;

    /**
     * @var int|float
     */
    private $topP = 1;

    /**
     * @var int|float
     */
    private $frequencyPenalty = 0.3;

    /**
     * @var int|float
     */
    private $presencePenalty = 0;

    public function __construct(string $secretKey)
    {
        $this->secretKey = $secretKey;
    }

    /**
     * @return string
     */
    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    /**
     * @return string
     */
    public function getPrompt(): string
    {
        return $this->prompt;
    }

    /**
     * @param string $prompt
     * @return $this
     */
    public function setPrompt(string $prompt): self
    {
        $prompt = trim($prompt);
        if (empty($prompt)) {
            throw new InvalidArgumentException();
        }
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * @return int
     */
    public function getMaxTokens(): int
    {
        return $this->maxTokens ?? 1;
    }

    /**
     * @param int $maxTokens
     * @return $this
     */
    public function setMaxTokens(int $maxTokens = 50): self
    {
        $this->maxTokens = $maxTokens;

        return $this;
    }

    /**
     * @param string $engine
     * @return $this
     */
    public function setEngine(string $engine): self
    {
        $this->engine = $engine;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getEngine(): ?string
    {
        return $this->engine ?? null;
    }

    /**
     * @param string $model
     * @return $this
     */
    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getModel(): ?string
    {
        return $this->model ?? null;
    }

    /**
     * @param int|float $temperature
     * @return $this
     */
    public function setTemperature($temperature): self
    {
        if (!is_numeric($temperature) || $temperature < 0 || $temperature > 1) {
            throw new InvalidArgumentException();
        }
        $this->temperature = $temperature;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @return float|int
     */
    public function getFrequencyPenalty()
    {
        return $this->frequencyPenalty;
    }

    /**
     * @param float|int $frequencyPenalty <p>0-1</p>
     * @return $this
     */
    public function setFrequencyPenalty($frequencyPenalty): self
    {
        if (!is_numeric($frequencyPenalty) || $frequencyPenalty < 0 || $frequencyPenalty > 1) {
            throw new InvalidArgumentException();
        }

        $this->frequencyPenalty = $frequencyPenalty;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getPresencePenalty()
    {
        return $this->presencePenalty;
    }

    /**
     * @param int|float $presencePenalty <p>0-1</p>
     * @return $this
     */
    public function setPresencePenalty($presencePenalty): self
    {
        if (!is_numeric($presencePenalty) || $presencePenalty < 0 || $presencePenalty > 1) {
            throw new InvalidArgumentException();
        }

        $this->presencePenalty = $presencePenalty;

        return $this;
    }

    /**
     * @return float|int
     */
    public function getTopP()
    {
        return $this->topP;
    }

    /**
     * @param int|float $topP <p>0-1</p>
     * @return $this
     */
    public function setTopP($topP): self
    {
        if (!is_numeric($topP) || $topP < 0 || $topP > 1) {
            throw new InvalidArgumentException();
        }

        $this->topP = $topP;

        return $this;
    }

}
