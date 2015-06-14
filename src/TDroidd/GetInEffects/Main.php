<?php
namespace TDroidd\GetInEffects;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\level\Level;

use pocketmine\level\sound\FizzSound;
use pocketmine\level\sound\BatSound;
use pocketmine\level\sound\DoorSound;
use pocketmine\level\sound\GenericSound;
use pocketmine\level\sound\LaunchSound;
use pocketmine\level\sound\PopSound;

use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerMoveEvent;
//use pocketmine\event\player\PlayerDeathEvent; for the next update
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
		$this->getLogger()->info("§eGetInEffects By §bTDroidd 1.4 §aEnabled!");
}
		public function onJoin(PlayerJoinEvent $event) {
			$p = $event->getPlayer();
			$level = $p->getLevel();
			$level->addSound(new FizzSound($p));
		if($p->hasPermission("gieffects.effect")) {
		$cfg=$this->getConfig();
			$effectid=$cfg->get("Effect-ID");
			$duration=$cfg->get("Duration");
			$particles=$cfg->get("Particles");
			$amplifier=$cfg->get("Amplifier");
			$msgtype=$cfg->get("Message-Type");
			$msg=$cfg->get("Join-Effect-Message");
			$health=$cfg->get("Fill-Player-Health");
	$effect = Effect::getEffect($effectid); //Effect ID
	$effect->setVisible($particles); //Particles
	$effect->setAmplifier($amplifier);
	$effect->setDuration($duration); //Ticks
	$p->addEffect($effect);
     if($health === true){
		$p->setHealth(20);
	}
		if($msgtype === "Tip"){
			$p->sendTip($msg);
		}elseif($msgtype === "PopUp"){
			$p->sendPopup($msg);
		}elseif($msgtype === "Chat"){
			$p->sendMessage($msg);
		}
	}
}
	public function onDrop(PlayerDropItemEvent $event){
		$p = $event->getPlayer();
		$p->kick("§4Tirar Items Causa Lag\n§ePor favor, No los tires... §fEstos se te borran \n§aautomaticamente §fcuando mueres.");
	}
	/**
	 * OnDisable 
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onDisable()
	 */
	public function onDisable() {
		$this->getLogger()->info("§eGetInEffects By §bTDroidd §av1.4 §4Unloaded!");
	}
}
