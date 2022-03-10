<?php

namespace ByNamles\ClientInfo\managers;

use ByNamles\ClientInfo\ClientDatas;
use ByNamles\ClientInfo\ClientInfo;
use ByNamles\ClientInfo\providers\ChatProvider;
use ByNamles\ClientInfo\providers\UserInterfaceProvider;
use pocketmine\utils\TextFormat;

class ProviderManager implements ClientDatas{

    public static function init() : void{
        $plugin = ClientInfo::getInstance();
        switch(self::PROVIDER_SETTINGS){
            case 1:
                $plugin->provider = new ChatProvider();
                break;
            case 2:
                $plugin->provider = new UserInterfaceProvider();
                break;
        }
        $plugin->getLogger()->info(TextFormat::GREEN . "Your provider setting is set to " . TextFormat::WHITE . $plugin->provider->__toString() . TextFormat::GREEN . ".");
    }
}