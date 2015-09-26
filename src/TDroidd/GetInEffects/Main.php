<?php
namespace TDroidd\GetInEffects;
use pocketmine\Player;
use pocketmine\entity\Effect;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\level\sound\FizzSound;
use pocketmine\level\sound\BatSound;
use pocketmine\level\sound\DoorSound;
use pocketmine\level\sound\GenericSound;
use pocketmine\level\sound\LaunchSound;
use pocketmine\level\sound\PopSound;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\TextFormat;
use pocketmine\event\player\PlayerRespawnEvent;
class Main extends PluginBase implements Listener {
    private $Sound;
    public function onEnable(){
	$this->saveDefaultConfig();
	$this->reloadConfig();
	$this->getServer()->getPluginManager()->registerEvents($this,$this);
	$this->getLogger()->info("§eGetInEffects 1.6 By §bTDroidd §aEnabled!");
    }
    public function receiveEffect(Player $p){
        $cfg = $this->getConfig();
	$level = $p->getLevel();
        $Sound = "pocketmine\\level\\sound\\".$cfg->get("Sound");
        if(is_object($Sound)) $level->addSound(new $Sound($p));
	if($p->hasPermission("gieffects.effect")){
	    $effectid = $cfg->get("Effect-ID");
	    $duration = $cfg->get("Duration");
	    $particles = $cfg->get("Particles");
	    $amplifier = $cfg->get("Amplifier");
	    $msgtype = $cfg->get("Message-Type");
	    $msg = $cfg->get("Join-Effect-Message");
	    $health = $cfg->get("Fill-Player-Health");
	    $effect = Effect::getEffect($effectid); //Effect ID
	    $effect->setVisible($particles); //Particles
	    $effect->setAmplifier($amplifier);
	    $effect->setDuration($duration); //Ticks
	    $p->addEffect($effect);
     	    if($health === true) $p->setHealth(20);
	    switch(strtolower($msgtype)){
	    	case "tip":
	    	    $p->sendTip($msg);
	    	    break;
	    	case "popup":
	    	    $p->sendPopup($msg);
	    	    break;
	    	case "chat":
	    	    $p->sendMessage($msg);
	    	    break;
	    }
        }
    }
    public function onJoin(PlayerJoinEvent $event) {
        $cfg = $this->getConfig();
        $p = $event->getPlayer();
        $this->getServer()->getScheduler()->scheduleDelayedTask(new JTask([$this,"receiveEffect"],[$p]),0);
    }
    public function onRespawn(PlayerRespawnEvent $event){
        $cfg = $this->getConfig();
        $p = $event->getPlayer();
        $this->getServer()->getScheduler()->scheduleDelayedTask(new JTask([$this,"receiveEffect"],[$p]),0);
    }
    public function onDisable() {
	$this->getLogger()->info("§eGetInEffects By §bTDroidd §av1.6 §4Unloaded!");
    }
}
