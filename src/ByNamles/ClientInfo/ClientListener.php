<?php

namespace ByNamles\ClientInfo;

use pocketmine\event\Listener;
use pocketmine\event\server\DataPacketReceiveEvent;
use pocketmine\network\mcpe\JwtUtils;
use pocketmine\network\mcpe\protocol\LoginPacket;

class ClientListener implements Listener{

    public function onDataReceive(DataPacketReceiveEvent $event){
        $pk = $event->getPacket();
        if($pk instanceof LoginPacket){
            $cd = JwtUtils::parse($pk->clientDataJwt)[1];
            ClientInfo::getInstance()->property[$cd["ThirdPartyName"]] = [
                "CurrentInputMode" => $cd["CurrentInputMode"],
                "DeviceModel" => $cd["DeviceModel"],
                "DeviceOS" => $cd["DeviceOS"],
                "LanguageCode" => $cd["LanguageCode"],
                "GameVersion" => $cd["GameVersion"],
                "GuiScale" => $cd["GuiScale"],
                "UIProfile" => $cd["UIProfile"],
                "ThirdPartyName" => $cd["ThirdPartyName"]
            ];
        }
    }
}