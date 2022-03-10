<?php

namespace ByNamles\ClientInfo\commands;

use ByNamles\ClientInfo\ClientInfo;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\utils\TextFormat;

class ClientInfoRequestCommand extends Command{

    /** @var ClientInfo */
    private ClientInfo $plugin;

    public function __construct(){
        parent::__construct(
            "clientrequest",
            "Request your data"
        );
        $this->plugin = ClientInfo::getInstance();
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            $sender->sendMessage(TextFormat::GREEN . "Your data is being prepared...");
            $this->plugin->setJsonType($sender->getName(), $this->plugin->getPlayerData($sender));
            $sender->sendMessage(TextFormat::AQUA . "Your player data has been successfully created. You can get your data in `.json` data type by contacting the admins.");
        }
    }
}