<?php


namespace ByNamles\ClientInfo\providers;

use ByNamles\ClientInfo\ClientInfo;
use pocketmine\player\Player;

abstract class Provider{

    /** @var ClientInfo */
    protected ClientInfo $plugin;

    /** @var int */
    protected const SETTING_NUMBER = null;

    abstract public function __construct();

    abstract public function showToClientInfo(Player $player, string $infoPlayer) : void;

    abstract public function __toString() : string;
}