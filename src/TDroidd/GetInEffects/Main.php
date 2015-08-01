<?php
namespace TDroidd\GetInEffects;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\level\Level;
use pocketmine\Server;

use pocketmine\level\sound\FizzSound;
use pocketmine\level\sound\BatSound;
use pocketmine\level\sound\DoorSound;
use pocketmine\level\sound\GenericSound;
use pocketmine\level\sound\LaunchSound;
use pocketmine\level\sound\PopSound;

use pocketmine\event\player\PlayerPreLoginEvent;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\player\PlayerLoginEvent;
use pocketmine\event\player\PlayerDropItemEvent;
use pocketmine\event\player\PlayerMoveEvent;
use pocketmine\event\player\PlayerKickEvent;
use pocketmine\event\player\PlayerDeathEvent;

use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerRespawnEvent;
use pocketmine\command\PluginCommand;
class Main extends PluginBase implements Listener {
    
    private $Sound;

    /**
    * @priority HIGHEST
    */
    
	 public function onEnable(){
		$this->saveDefaultConfig();
		$this->reloadConfig();
		$this->getServer()->getPluginManager()->registerEvents($this,$this);
		$this->getLogger()->info("§eGetInEffects 1.5 By §bTDroidd §aEnabled!");
}
		public function onJoin(PlayerJoinEvent $event) {
                    $cfg=$this->getConfig();
			$p = $event->getPlayer();
			$level = $p->getLevel();
                        $Sound = "pocketmine\\level\\sound\\" . $cfg->get("Sound");
                        $level->addSound(new $Sound ($p));
		if($p->hasPermission("gieffects.effect")) {
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
                /**
	 * OnDisable 
	 * (non-PHPdoc)
	 * 
	 * @see \pocketmine\plugin\PluginBase::onDisable()
	 */
	public function onDisable() {
		$this->getLogger()->info("§eGetInEffects By §bTDroidd §av1.5 §4Unloaded!");
	}
}
