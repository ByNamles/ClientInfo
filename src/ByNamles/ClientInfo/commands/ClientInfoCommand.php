<?php

namespace ByNamles\ClientInfo\commands;

use ByNamles\ClientInfo\ClientInfo;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\utils\TextFormat;

class ClientInfoCommand extends Command{

    /** @var ClientInfo */
    private ClientInfo $plugin;

    public function __construct(){
        parent::__construct(
            "clientinfo",
            "See your device information"
        );
        $this->plugin = ClientInfo::getInstance();
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args){
        if($sender instanceof Player){
            if(!empty($args[0])){
                if(Server::getInstance()->isOp($sender->getName())){
                    if($this->plugin->getServer()->getPlayerByPrefix($args[0]) instanceof Player){
                        $this->plugin->provider->showToClientInfo($sender, $args[0]);
                    }else{
                        $sender->sendMessage(TextFormat::RED . "Couldn't found player.");
                    }
                }else{
                    $sender->sendMessage(TextFormat::RED . "You don't have permission for looking at someone else's information.");
                }
            }else{
                $this->plugin->provider->showToClientInfo($sender, $sender->getName());
            }
        }
    }
}