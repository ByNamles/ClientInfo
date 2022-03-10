<?php


namespace ByNamles\ClientInfo\providers;

use ByNamles\ClientInfo\forms\ClientInfoForm;
use pocketmine\player\Player;

class UserInterfaceProvider extends Provider{

    /** @var int */
    public const SETTING_NUMBER = 2;

    public function __construct()
    {
    }

    public function showToClientInfo(Player $player, string $infoPlayer) : void{
        $player->sendForm(new ClientInfoForm($infoPlayer));
    }

    public function __toString() : string{
        return "UserInterfaceProvider";
    }
}