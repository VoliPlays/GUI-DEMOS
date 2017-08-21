<?php


namespace CKylin;

//COMMON Uses
use pocketmine\command\Command;
use pocketmine\customUI\elements\customForm\Input;
//use pocketmine\plugin\Plugin;
use pocketmine\utils\TextFormat as Color;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
//use pocketmine\utils\Config;
use pocketmine\Server;
//use pocketmine\Player;
use pocketmine\command\CommandSender;
//use pocketmine\customUI\CustomUI;
use pocketmine\customUI\windows\CustomForm;
use pocketmine\customUI\elements\customForm\Input as InputFrame;
use pocketmine\customUI\elements\customForm\Label;
use pocketmine\customUI\elements\customForm\Slider;
use pocketmine\customUI\elements\customForm\StepSlider;
use pocketmine\customUI\elements\customForm\Dropdown;
use pocketmine\customUI\elements\customForm\Toggle;


class GUIDemoInputs extends PluginBase implements Listener
{

    public function onEnable() {
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		if($this->getServer()->getCodename()!="Katana")
		    $this->getLogger()->info(Color::GREEN . 'Enabled for Steadfast2');
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
		    $demolabel = new Label("There is a demo label element");
		    $dropdown = new DemoDropdown("a dropdown");
		    $dropdown->addOption("Option Default",true);
            $dropdown->addOption("Option #2");
            $dropdown->addOption("Option #3");
            $silder = new DemoSlider("a silder",0.0,100.0,1);
            $stepsilder = new DemoStepSlider("a step silder");
            $stepsilder->addStep("defaultStep",true);
            $stepsilder->addStep("secondStep");
            $toggle = new DemoToggle("a toggle");
            $toggle2 = new DemoToggle2("another toggle",true);
            $modal->addElement($demolabel);
		    $modal->addElement($input);
            $modal->addElement($dropdown);
            $modal->addElement($silder);
            $modal->addElement($stepsilder);
            $modal->addElement($toggle);
            $modal->addElement($toggle2);
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

class DemoDropdown extends Dropdown {
    public function handle($value, $player)
    {
        Server::getInstance()->getLogger()->info("{$player->getName()} has been selected {$value}");
    }
}

class DemoToggle extends Toggle {
    public function handle($value, $player)
    {
        if($value) $text = "on"; else $text = "off";
        Server::getInstance()->getLogger()->info("{$player->getName()} has been toggled toggle1 to {$text}");
    }
}

class DemoToggle2 extends Toggle {
    public function handle($value, $player)
    {
        if($value) $text = "on"; else $text = "off";
        Server::getInstance()->getLogger()->info("{$player->getName()} has been toggled toggle2 to {$text}");
    }
}

class DemoStepSlider extends StepSlider {
    public function handle($value, $player)
    {
        Server::getInstance()->getLogger()->info("{$player->getName()} has been changed the StepSilder to {$value}");
    }
}

class DemoSlider extends Slider {
    public function handle($value, $player)
    {
        Server::getInstance()->getLogger()->info("{$player->getName()} has been changed the Silder to {$value}");
    }
}
