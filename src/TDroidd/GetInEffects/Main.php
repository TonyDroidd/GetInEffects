<?php
namespace TDroidd\GetInEffects;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\entity\InstantEffect;
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
		$this->reloadConfig();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("GetInEffects By TDroidd 1.0 Enabled!");
}
		public function onJoin(PlayerJoinEvent $event) {
		if($event->getPlayer()->hasPermission("gieffects.effect")) {
		$cfg=$this->getConfig();
		$effectid=$cfg->get("Effect-ID");
		$duration=$cfg->get("Duration");
		$particles=$cfg->get("Particles");
		$amplifier=$cfg->get("Amplifier");
		$p = $event->getPlayer();
		$effect = Effect::getEffect($effectid); //Effect ID
		$effect->setVisible($particles); //Particles
		$effect->setAmplifier($amplifier);
		$effect->setDuration($duration); //Ticks
		$p->addEffect($effect);
		}
	}
	/**
	 * OnDisable 
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onDisable()
	 */
	public function onDisable() {
		$this->getLogger()->info("GetInEffects By TDroidd v1.0 Unloaded!");
	}
}
