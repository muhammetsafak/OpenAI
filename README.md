# OpenAI

This library was created to facilitate communication with OpenAI services in the simplest and most understandable way using PHP.

### Installation

```
composer require muhammetsafak/openai-client
```

### Required

- PHP 7.4 or later
- cURL Extension

## Usage

### Completions

```php
use MuhammetSafak\OpenAI\OpenAI;
use MuhammetSafak\OpenAI\Services\Completions;
const SECRET_KEY = "";

$openai = new OpenAI(SECRET_KEY);
$openai->setPrompt($_GET['prompt'])
    ->setTemperature(0.7);

$res = (new Completions($openai))->get();

echo $res['response']['choices'][0]['text'];
```

The exact equivalent of the `$res` variable should be something similar to the following.

```php
[
    'status'        => true,
    'message'       => '',
    'response'      => [
        "id" => "cmpl-8WlS2x6looAGlj8Z182D3M...",
        "object" => "text_completion",
        "created" => 1702819590,
        "model" => "davinci-002",
        "choices" => [
            0 => [
                "text" => "...",
                "index" => 0,
                "logprobs" => null,
                "finish_reason" => "stop",
            ],
        ],
        "usage" => [
                "prompt_tokens" => 1,
                "completion_tokens" => 81,
                "total_tokens" => 32,
        ],
    ]
]
```

### Chat

```php
use MuhammetSafak\OpenAI\OpenAI;
use MuhammetSafak\OpenAI\Services\Chat;
const SECRET_KEY = "";

$openai = new OpenAI(SECRET_KEY);
$openai->setPrompt($systemMessage)
    ->setTemperature(0.7);
    
$res = (new Chat($openai))
    ->setUserMessage($userMessage)
    ->get();

echo $res['response']['choices'][0]['message']['content'];
```

The exact equivalent of the `$res` variable should be something similar to the following.

```php
[
    'status'        => true,
    'message'       => '',
    'response'      => [
        "id" => "chatcmpl-8WmzZ2uCDqBZ83BFWbAaifeDNHmlG",
        "object" => "chat.completion",
        "created" => 1702825513,
        "model" => "gpt-3.5-turbo-0613",
        "choices" => [
            0 => [
                "index" => 0,
                "message" => [
                    "role" => "assistant",
                    "content" => "",
                ],
                "logprobs" => null,
                "finish_reason" => "stop",
            ],
        ],
        "usage" => [
                "prompt_tokens" => 121,
                "completion_tokens" => 8,
                "total_tokens" => 129,
        ],
        "system_fingerprint" => null,
    ]
]
```

## Getting Help

If you have questions, concerns, bug reports, etc, please file an issue in this repository's Issue Tracker.

## Getting Involved

> All contributions to this project will be published under the MIT License. By submitting a pull request or filing a bug, issue, or feature request, you are agreeing to comply with this waiver of copyright interest.

There are two primary ways to help:

- Using the issue tracker, and
- Changing the code-base.

### Using the issue tracker

Use the issue tracker to suggest feature requests, report bugs, and ask questions. This is also a great way to connect with the developers of the project as well as others who are interested in this solution.

Use the issue tracker to find ways to contribute. Find a bug or a feature, mention in the issue that you will take on that effort, then follow the Changing the code-base guidance below.

### Changing the code-base

Generally speaking, you should fork this repository, make changes in your own fork, and then submit a pull request. All new code should have associated unit tests that validate implemented features and the presence or lack of defects. Additionally, the code should follow any stylistic and architectural guidelines prescribed by the project. In the absence of such guidelines, mimic the styles and patterns in the existing code-base.

## Credits

- [Muhammet ŞAFAK](https://www.muhammetsafak.com.tr) <<info@muhammetsafak.com.tr>>

## License

Copyright &copy; 2023 [MIT License](./LICENSE)