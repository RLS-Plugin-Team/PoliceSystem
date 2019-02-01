<?php

namespace PoliceSystem;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecuter;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\Player;
use pocketmine\entity\EffectInstance;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;

class main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("PoliceSystemを読み込みました");
		if(!file_exists($this->getDataFolder())){
			mkdir($this->getDataFolder(), 0744, true);
		}
		$this->police = new Config($this->getDataFolder() ."Police.yml", Config::YAML);
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
		    case "patrol":
		    if($sender instanceof Player){
		        if(!$this->police->exists($sender->getName())){
		            $this->police->set($sender->getName(),count($this->police->getAll())+1);
		            $this->police->save();
		            $this->police->reload();
		            $sender->addEffect(new EffectInstance(Effect::getEffect(14), 36000, 1, true));
		            $sender->sendMessage("パトロールモードに設定しました");
		        }else{
		            $this->police->remove($sender->getName());
		            $this->police->save();
		            $this->police->reload();
		            $sender->removeEffect(14);
		            $sender->sendMessage("パトロールモードを解除しました");
		        }
		    }else{
		        $sender->sendMessage("ゲーム内で実行してください");
		    }
		}
    }
}
