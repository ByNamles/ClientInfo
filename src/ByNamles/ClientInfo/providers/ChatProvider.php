<?php

namespace ByNamles\ClientInfo\providers;

use JetBrains\PhpStorm\Pure;
use ByNamles\ClientInfo\ClientInfo;
use pocketmine\player\Player;

class ChatProvider extends Provider{

    /** @var int */
    public const SETTING_NUMBER = 1;

    protected ClientInfo $plugin;

    #[Pure] public function __construct(){
        $this->plugin = ClientInfo::getInstance();
    }

    public function showToClientInfo(Player $player, string $infoPlayer) : void{
        $player->sendMessage($this->plugin->getClientTitle($infoPlayer));

        foreach($this->plugin->getClientInfo($infoPlayer) as $info){
            $player->sendMessage($info);
        }
    }

    public function __toString() : string{
        return "ChatProvider";
    }
}