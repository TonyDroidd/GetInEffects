<?php

namespace TDroidd\JoinEffect;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerJoinEvent;

class Main extends PluginBase implements Listener {
	/**
	 * OnEnable
	 *
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onEnable()
	 */	
	public function onEnable(){
	        $this->saveDefaultConfig();
			$c = yaml_parse(file_get_contents($this->getDataFolder() . "config.yml"));
			$this->effect = $c["EffectID"];
                $this->getLogger()->info(TextFormat::RED . "JoinEffect By TDroidd  0.1 Enabled!");

}

	public function onJoin(PlayerJoinEvent $event) {
			$p = $event->getPlayer();
			$effect = Effect::getEffect($this->effect = $c["EffectID"]); //Effect ID
			$effect->setVisible(false); //Particles
			$effect->setDuration(1200); //Ticks
			$p->addEffect($effect);
	}
	/**
	 * OnDisable
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onDisable()
	 */
	public function onDisable() {
		$this->save ();
		$this->getLogger()->info(TextFormat::RED . "JoinEffect By TDroidd 0.1 Unloaded!");
	}
}
