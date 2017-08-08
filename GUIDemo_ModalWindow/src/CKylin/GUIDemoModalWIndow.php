<?php


namespace CKylin;

//COMMON Uses
use pocketmine\command\Command;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as Color;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\customUI\CustomUI;
use pocketmine\customUI\windows\ModalWindow;

class GUIDemoModalWIndow extends PluginBase implements Listener
{

    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getLogger()->info(Color::GREEN . 'Enabled for Katana');
	}

	public function onDisable() {
		$this->getLogger()->info(Color::BLUE . 'Disabled.');
	}

	public function onCommand(CommandSender $s, Command $cmd, $label, array $args) {
		if($cmd=="showgui"){
            $modal = new MyUI('Demo Modal Window','Here is the content','YES!','Nope...');
            $back = $s->showModal($modal);
            if(!$back){
                $s->sendMessage('xxx ');
            }
            return true;
		}
	}

}

class MyUI extends ModalWindow {
    public function handle($response,$player){
        $parser = new ParseUI($this);
        $parser->parseResponse($response,$player);
    }
}

class ParseUI extends PluginBase {

    private $server;

    public function __construct(MyUI $pl){
        $this->server = Server::getInstance();
    }

    public function parseResponse($response,$player){
        if($response) $this->server->getLogger()->info("{$player->getName()} pressed the YES button");
        else $this->server->getLogger()->info("{$player->getName()} pressed the NO button");
    }
}
