<?php
/**
 * This file is from Slimworks and developed by Cyberbyte Studios
 */

namespace Slimworks\Services\Auth\Social\Steam;

use LightOpenID;
use Slimworks\Exceptions\InvalidConfigurationException;
use Slimworks\Models\ArmaLife\PlayerQuery;
use Slimworks\Models\Core\User;
use Http\Adapter\Guzzle6\Client;
use Slimworks\Exceptions\AuthException;
use Slimworks\Models\Core\UserQuery;

class SteamService
{
    private $openId;
    private $playerId;

    public function __construct()
    {
        $this->openId = new LightOpenID($this->currentUrl());
        $this->openId->identity = 'http://steamcommunity.com/openid';
    }

    public function attemptLogin(): bool
    {
        if ($this->openId->validate()) {
            preg_match("/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/", $this->openId->identity,$matches);
            if (count($matches) === 2) {
                $this->playerId = $matches[1];
                return true;
            }
        }
        return false;
    }

    /**
     * @todo: Clean this up, lets not get http vars use slims wrapper
     */
    private function currentUrl(): string
    {
        return $_SERVER['HTTP_HOST'];
    }

    public function getLoginUrl(): string
    {
        if (!$this->openId->mode) {
            return $this->openId->authUrl();
        }
        throw new AuthException('Steam Mode Invalid');
    }

    public function getUser(): User
    {
        if (!isset($this->playerId)) {
            throw new AuthException('No player ID found');
        }

        $user = UserQuery::create()->findOneBySteamId($this->playerId);
        if (isset($user)) {
            return $user;
        }

        $request = new \GuzzleHttp\Psr7\Request('GET', $this->getProfileUrl($this->playerId));
        $httpClient = new Client();
        $response = $httpClient->sendRequest($request);

        if ($response->getStatusCode() !== 200) {
            throw new AuthException('User could not be found from steam');
        }

        $content = json_decode($response->getBody());
        $player = $content->response->players[0];

        $user = new User;
        $user->setSteamId($this->playerId);
        $user->setName($player->personaname);
        $user->setAvatar($player->avatarfull);
        $user->save();

        return $user;
    }

    /**
     * @todo: get API key from config
     * @return string
     * @throws InvalidConfigurationException
     */
    private function getSteamApiKey()
    {
        $thing = '1EF902ABC5CD1EA3FF57A01471D7192E';
        if (isset($thing)) {
            return $thing;
        }
        throw new InvalidConfigurationException('No Steam Api key set');
    }

    private function getProfileUrl(string $steamId)
    {
        $apiKey = $this->getSteamApiKey();
        return "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=$apiKey&steamids=$steamId";
    }
}
