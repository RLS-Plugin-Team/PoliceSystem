<?php

namespace PoliceSystem;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;
use pocketmine\entity\Effect;
use pocketmine\entity\EffectInstance;
use pocketmine\Player;
use pocketmine\Server;

class main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->getServer()->getLogger()->info("PoliceSystemを読み込みました");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
		    case "patrol":
		    if($sender instanceof Player){
		        if(!$sender->hasEffect(14)){
		            $sender->addEffect(new EffectInstance(Effect::getEffect(14), 36000, 1, false));
		            $sender->sendMessage("[Police] §eパトロールモードに設定しました");
		        }else{
		            $sender->removeEffect(14);
		            $sender->sendMessage("[Police] §eパトロールモードを解除しました");
		        }
		    }else{
		        $sender->sendMessage("[Police] §cゲーム内で実行してください");
		    }
		    return true;
		}
		return true;
    }
}
