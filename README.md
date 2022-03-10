# ClientInfo
ClientInfo plugin for PocketMine-MP 4!

## ClientInfo Commands
| Default command | Parameter | Description | Default Permission |
| :-----: | :-------: | :---------: | :-------: |
| /clientrequest | | Request your data | `All` |
| /clientinfo | `[?playerName: string` | See your device information | `OP` |

## For developers
You can acces to ClientInfo `ClientInfo::getInstance()`

Get Client Info from Player Name:
```php
ClientInfo::getInstance()->getClientInfo($playerName);
```

## Screenshots
![Use /clientinfo](https://github.com/ByNamles/ClientInfo/blob/main/assests/image0.png?raw=true)
![Use /clientrequest](https://github.com/ByNamles/ClientInfo/blob/main/assests/image1.png?=raw=true)

## Example Json File

```json
{"CreationTime":"14.29.46 10:03:2022","CreationDay":"Thursday","Creator":"ByNamlesTR_File_System","Name":"ByNamles","UUID":"cbd4dc11-ba5b-3ebe-87eb-da88c51bd5c2","ThirdPartyName":"ByNamles","Ping":48,"GameVersion":"1.18.12","LanguageCode":"tr_TR","CurrentInputMode":1,"DeviceOS":7,"DeviceModel":"","UIProfile":0,"GuiScale":0,"Query":"127.0.0.1","Country":"\u00a7cUnknown","CountryCode":"\u00a7cUnknown","Region":"\u00a7cUnknown","RegionCode":"\u00a7cUnknown","PostCode":"\u00a7cUnknown","TimeZone":"\u00a7cUnknown","InternetProvider":"\u00a7cUnknown","Latitude":"\u00a7cUnknown","Longitude":"\u00a7cUnknown"}
```

## Note

If you want to change provider type, open ClientDatas.php file and follow the steps below.

```php
/**
     * 1 = If you want to use ChatProvider
     * 2 = If you want to use UserInterfaceProvider
     *
     * @var string
     */
    public const PROVIDER_SETTINGS = 2; // 1 || 2
```
