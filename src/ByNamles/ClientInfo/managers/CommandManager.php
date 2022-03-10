<?php


namespace ByNamles\ClientInfo\managers;

use ByNamles\ClientInfo\commands\ClientInfoCommand;
use ByNamles\ClientInfo\commands\ClientInfoRequestCommand;
use JetBrains\PhpStorm\ArrayShape;
use pocketmine\Server;

class CommandManager{

    public static function init() : void{
        foreach(self::getCommands() as $command => $class){
            Server::getInstance()->getCommandMap()->register($command, $class);
        }
    }

    #[ArrayShape(["clientinfo" => "\ByNamles\ClientInfo\commands\ClientInfoCommand", "clientrequest" => "\ByNamles\ClientInfo\commands\ClientInfoRequestCommand"])] public static function getCommands() : array{
        return [
            "clientinfo" => new ClientInfoCommand(),
            "clientrequest" => new ClientInfoRequestCommand()
        ];
    }
}