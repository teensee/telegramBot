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

    /**
     * BaseTelegramClient constructor.
     * @param string $token telegram bot token
     * @param string|null $link file.php which processing all webhook's message
     */
    public function __construct(string $token, string $link = null)
    {
        $this->link = $link;
        $this->token = $token;

        $this->base_url = self::TG_API_LINK . $this->token . '/';
    }

    /**
     * @param string $text message test
     * @param string $chat_id chat_id where to send message
     * @param string|null $username
     * @return mixed true if message was sent
     */
    abstract public function sendMessage(string $text, string $chat_id, string $username = null);

    public function registerWebhook()
    {
        if ($this->link == null)
            return "You dont specify $this->link.php for perform webhook notification";
        else $this->sendRequest('setWebhook', ['url' => $this->link]);

        return true;
    }

    public function deleteWebhook()
    {
        if ($this->link == null)
            return "You dont specify $this->link.php for perform webhook notification";
        else $this->sendRequest('deleteWebhook', ['url' => $this->link]);

        return true;
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

}