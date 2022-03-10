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
