<?php


namespace CKylin;

//COMMON Uses
use pocketmine\command\Command;
use pocketmine\customUI\elements\customForm\Input;
use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as Color;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Server;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\customUI\CustomUI;
use pocketmine\customUI\windows\CustomForm;
use pocketmine\customUI\elements\customForm\Input as InputFrame;

class GUIDemoInputs extends PluginBase implements Listener
{

    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if($this->getServer()->getCodename()!="Katana")
		    $this->getLogger()->info(Color::GREEN . 'Enabled for Spreadfast2');
		else
		    $this->getLogger()->warning("Not avaiable for your server core. Try to work...");
	}

	public function onDisable() {
		$this->getLogger()->info(Color::BLUE . 'Disabled.');
	}

	public function onCommand(CommandSender $s, Command $cmd, $label, array $args) {
		if($cmd=="showgui"){
		    $modal = new CustomForm("Input Demos");
		    $input = new DemoInput("There is a Input", "Type something?", "Delete me!");
		    $modal->addElement($input);
		    $modal->addIconUrl("https://ss0.bdstatic.com/5aV1bjqh_Q23odCf/static/superman/img/logo/logo_white_fe6da1ec.png");
            $back = $s->showModal($modal);
            if(!$back){
                $s->sendMessage('xxx ');
            }else{
                $this->getLogger()->warning("This player is not support Custom GUI: Client outdated.");
            }
            return true;
		}
	}

}

class DemoInput extends InputFrame {
    public function handle($value, $player)
    {
        Server::getInstance()->getLogger()->info("{$player->getName()} has been inputted {$value}");
    }
}
