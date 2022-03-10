<?php

namespace ByNamles\ClientInfo\forms;

use ByNamles\ClientInfo\ClientInfo;
use dktapps\pmforms\CustomForm;
use dktapps\pmforms\element\Label;

class ClientInfoForm extends CustomForm
{

    public function __construct(string $player)
    {
        parent::__construct(
            ClientInfo::getInstance()->getClientTitle($player),
                [
                    new Label("element0",implode("\n",ClientInfo::getInstance()->getClientInfo($player)))
                ],
            function (): void {
            }
        );
    }
}