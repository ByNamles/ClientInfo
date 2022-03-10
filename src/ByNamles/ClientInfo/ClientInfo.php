<?php

namespace ByNamles\ClientInfo;

use ByNamles\ClientInfo\managers\CommandManager;
use ByNamles\ClientInfo\managers\ProviderManager;
use ByNamles\ClientInfo\providers\Provider;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class ClientInfo extends PluginBase implements ClientDatas{
    /** @var array */
    public array $property = [];

    /** @var Provider */
    public Provider $provider;

    /** @var ClientInfo */
    public static ClientInfo $api;

    public function onLoad() : void{
        self::$api = $this;
    }

    public function onEnable() : void{
        @mkdir($this->getDataFolder());
        @mkdir($this->getDataFolder() . self::FILE_LOCALE);

        CommandManager::init();
        ProviderManager::init();

        $this->getServer()->getPluginManager()->registerEvents(new ClientListener(), $this);
    }

    public static function getInstance() : ClientInfo{
        return self::$api;
    }

    public function getClientInfo(string $infoPlayer) : array{
        $info = Server::getInstance()->getPlayerByPrefix($infoPlayer);
        $data = $this->getPlayerData($info);

        return [
            TextFormat::GOLD . "Name: " . TextFormat::WHITE . $data["Name"],
            TextFormat::GOLD . "Third Party Name: " . TextFormat::WHITE . $data["ThirdPartyName"],
            TextFormat::GOLD . "Ping: " . self::getPingString($data["Ping"]),
            TextFormat::GOLD . "UUID: " . TextFormat::YELLOW . $data["UUID"],
            TextFormat::GOLD . "Game Version: " . TextFormat::DARK_PURPLE . $data["GameVersion"],
            TextFormat::GOLD . "Game Language: " . TextFormat::DARK_PURPLE . (self::LANGUAGES[$data["LanguageCode"]] ?? self::UNKNOWN),
            TextFormat::GOLD . "Platform: " . TextFormat::DARK_PURPLE . (self::INPUT[$data["CurrentInputMode"]] ?? self::UNKNOWN),
            TextFormat::GOLD . "OS: " . TextFormat::DARK_PURPLE . (self::OS[$data["DeviceOS"]] ?? self::UNKNOWN),
            TextFormat::GOLD . "Model: " . TextFormat::DARK_PURPLE . $data["DeviceModel"],
            TextFormat::GOLD . "UI Profile: " . TextFormat::DARK_PURPLE . (self::UI_PROFILE[$data["UIProfile"]] ?? self::UNKNOWN),
            TextFormat::GOLD . "GUI Scale: " . TextFormat::DARK_PURPLE . (self::GUI_SCALE[$data["GuiScale"]] ?? self::UNKNOWN),
            TextFormat::GOLD . "IP: " . TextFormat::AQUA . $data["Query"],
            TextFormat::GOLD . "Country: " . TextFormat::AQUA . $data["Country"] . " - " . $data["CountryCode"],
            TextFormat::GOLD . "Region: " . TextFormat::AQUA . $data["Region"] . " - " . $data["RegionCode"],
            TextFormat::GOLD . "Post Code: " . TextFormat::AQUA . $data["PostCode"],
            TextFormat::GOLD . "Timezone: " . TextFormat::AQUA . $data["TimeZone"],
            TextFormat::GOLD . "Internet Provider: " . TextFormat::AQUA . $data["InternetProvider"],
            TextFormat::GOLD . "Latitude - Longitude: " . TextFormat::AQUA . $data["Latitude"] . " - " . $data["Longitude"]
        ];
    }

    public function getClientTitle(string $infoPlayer) : string{
        return TextFormat::DARK_GRAY . "-==[" . TextFormat::RED . $infoPlayer . TextFormat::DARK_GRAY . TextFormat::YELLOW . " Device Information" . TextFormat::DARK_GRAY . "]==-";
    }

    public function getPlayerData(Player $player) : array{
        $property = $this->property[$player->getName()] ?? [];
        $ipProperty = self::getIPInfo($player->getNetworkSession()->getIp());

        return [
            "Name" => $player->getName(),
            "UUID" => $player->getUniqueId(),
            "ThirdPartyName" => $property["ThirdPartyName"] ?? self::UNKNOWN,
            "Ping" => $player->getNetworkSession()->getPing(),
            "GameVersion" => $property["GameVersion"] ?? self::UNKNOWN,
            "LanguageCode" => $property["LanguageCode"] ?? self::UNKNOWN,
            "CurrentInputMode" => $property["CurrentInputMode"] ?? self::UNKNOWN,
            "DeviceOS" => $property["DeviceOS"] ?? self::UNKNOWN,
            "DeviceModel" => $property["DeviceModel"] ?? self::UNKNOWN,
            "UIProfile" => $property["UIProfile"] ?? self::UNKNOWN,
            "GuiScale" => $property["GuiScale"] ?? self::UNKNOWN,
            "Query" => $ipProperty["query"] ?? self::UNKNOWN,
            "Country" => $ipProperty["country"] ?? self::UNKNOWN,
            "CountryCode" => $ipProperty["countryCode"] ?? self::UNKNOWN,
            "Region" => $ipProperty["regionName"] ?? self::UNKNOWN,
            "RegionCode" => $ipProperty["region"] ?? self::UNKNOWN,
            "PostCode" => $ipProperty["zip"] ?? self::UNKNOWN,
            "TimeZone" => $ipProperty["timezone"] ?? self::UNKNOWN,
            "InternetProvider" => $ipProperty["isp"] ?? self::UNKNOWN,
            "Latitude" => $ipProperty["lat"] ?? self::UNKNOWN,
            "Longitude" => $ipProperty["lon"] ?? self::UNKNOWN
        ];
    }

    public function setJsonType(string $player, array $data) : void{
        $dir = $this->getDataFolder() . self::FILE_LOCALE . $player . ".json";
        if(!file_exists($dir)) touch($dir);
        $file = fopen($dir, "a");
        fwrite($file, json_encode(array_merge(["CreationTime" => date("H.i.s d:m:Y"), "CreationDay" => date("l"), "Creator" => "ByNamlesTR_File_System"], $data)));
        fclose($file);
    }

    public static function getPingString(int $ping) : string{
        return $ping <= 120 ? TextFormat::GREEN . $ping . " [Good]" : ($ping <= 240 ? TextFormat::YELLOW . $ping . " [Mid]" : TextFormat::RED . $ping . " [Bad]");
    }

    public static function getIPInfo(string $ip) : array{

            if ($ipInfo = file_get_contents("http://ip-api.com/json/" . $ip)) {
                return json_decode($ipInfo, true);
            }else return [];

    }
}