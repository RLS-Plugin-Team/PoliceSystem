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
use pocketmine\event\player\PlayerEvent;
use pocketmine\level\Position;
use pocketmine\level;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\utils\Config;

class main extends PluginBase implements Listener{

	public function onEnable(){
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
		$this->Config = new Config($this->getDataFolder() ."Config.yml", Config::YAML, array(
                "itemid" => "450",
                "x" => "1",
                "t" => "4",
                "z" => "1",
                "world" => "world"
                ));
		$this->getServer()->getLogger()->info("PoliceSystemを読み込みました");
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
		switch($command->getName()){
		    case "patrol":
		    if($sender instanceof Player){
		        if(!$sender->hasEffect(14)){
		            $sender->addEffect(new EffectInstance(Effect::getEffect(14), 36000, 1, false));
		            $sender->sendMessage("パトロールモードに設定しました");
		        }else{
		            $sender->removeEffect(14);
		            $sender->sendMessage("パトロールモードを解除しました");
		        }
		    }else{
		        $sender->sendMessage("ゲーム内で実行してください");
		    }
		    return true;
		}
		return true;
	}
	
	public function onDamage(EntityDamageEvent $event){
		if($event instanceof EntityDamageByEntityEvent){
			$damager = $event->getDamager();
			$entity = $event->getEntity();
			$itemid = $this->Config->get("itemid");
			$x = $this->Config->get("x");
			$y = $this->Config->get("t");
			$z = $this->Config->get("z");
			$world = $this->Config->get("world");
			if($damager instanceof Player && $entity instanceof Player){
				$item = $damager->getInventory()->getItemInHand();
				if($item->getId() === $itemid){
					$event->setCancelled();
					$pos = new Position($x,$y,$z, $this->getServer()->getLevelByName("{$world}"));
					$abc = $entity->getName();
					$def = $damager->getName();
					$entity->teleport($pos);
					$damager->sendMessage("
              }
          }
      }
  }
}
