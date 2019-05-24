<?php


namespace BotClient\Base\BaseClient;


abstract class BaseTelegramClient
{
    public const TG_API_LINK = 'https://api.telegram.org/bot';

    protected $link;

    //region Private Members
    private $token;
    private $base_url;
    //endregion

    public function __construct(string $token, string $link = null)
    {
        $this->link = $link;
        $this->token = $token;

        $this->base_url = self::TG_API_LINK . $this->token . '/';
    }

    protected function sendRequest($method, $params = [])
    {
        if (!empty($params)) {
            $url = $this->base_url . $method . '?' . http_build_query($params);
        } else {
            $url = $this->base_url . $method;
        }

        return json_decode(
            file_get_contents($url),
            JSON_OBJECT_AS_ARRAY
        );
    }

    abstract public function sendMessage(string $text, string $chat_id, string $username = null);
}