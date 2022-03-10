<?php

namespace ByNamles\ClientInfo;

use pocketmine\utils\TextFormat;

interface ClientDatas{

    /**
     * 1 = ChatProvider
     * 2 = UserInterfaceProvider
     *
     * @var string
     */
    public const PROVIDER_SETTINGS = 2;

    /** @var string */
    public const UNKNOWN = TextFormat::RED . "Unknown";

    /** @var string */
    public const FILE_LOCALE = DIRECTORY_SEPARATOR . "client_data" . DIRECTORY_SEPARATOR;

    /** @var array */
    public const LANGUAGES = [
        "tr_TR" => "Turkish",
        "az_AZ" => "Azerbaijanese",
        "de_DE" => "German",
        "en_AU" => "Australian English ",
        "en_CA" => "Canadian English",
        "en_GB" => "British English",
        "en_NZ" => "New Zealand English",
        "en_7S" => "English",
        "en_US" => "American English",
        "es_ES" => "Spanish",
        "fr_FR" => "French"
    ];

    /** @var array */
    public const OS = [
        1 => "Android",
        2 => "IOS",
        3 => "MacOS",
        4 => "Fire OS",
        5 => "Gear VR",
        6 => "HoloLens",
        7 => "Windows 10",
        8 => "Windows 32",
        9 => "Dediacted - VDS",
        10 => "Orbis",
        11 => "NX"
    ];

    /** @var array */
    public const INPUT = [
        1 => "Computer",
        2 => "Phone",
        3 => "XBox",
        4 => "VR"
    ];

    /** @var array */
    public const GUI_SCALE = [
        "Maximum",
        "Mid",
        "Minimum"
    ];

    /** @var array */
    public const UI_PROFILE = [
        "Classic",
        "Pocket"
    ];
}