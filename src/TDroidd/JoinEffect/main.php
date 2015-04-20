<?php

namespace TDroidd\JoinEffect;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class JoinEffect extends PluginBase implements Listener{

	public function onEnable(){
			@mkdir($this->getServer()->getDataFolder() . "JoinEffect");
		$this->effects = new Config($this->getServer()->getDataFolder() . "JoinEffect" . "config.yml", Config::YAML, )["EffectID" => 1]->getAll();
}

	public function onJoin(PlayerJoinEvent $event) {
		$p = $event->getPlayer();
			$effect = Effect::getEffect(1); //Effect ID
			$effect->setVisible(false); //Particles
			$effect->setDuration(1200); //Ticks
			$p->addEffect($effect);
	}
}
