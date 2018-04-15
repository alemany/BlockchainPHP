<?php
require_once("./block.php");
/*
  Blockchain simple amb sistema de PoW (minatge) amb seguretat SHA512.
  (hash identificador començant per "ae" el num. de caracters defineix la dificultat)
 */
class BlockChain
{
    /*
      Instanciació de nou blockchain
     */
    public function __construct()
    {
        $this->chain = [$this->createGenesisBlock()];
        $this->difficulty = 2;  // numero de caracters.
        $this->initialchars='ae';  //ull que ha de quadrar amb la dificultat
    }
    /*
      Creació del block "genesis"
     */
    private function createGenesisBlock()
    {
        return new Block(0, strtotime("2017-01-01"), "Genesis Block");
    }
    /*
      Funció per minar un block en base a dificultat dels caracters seleccionats.
     */
    public function mine($block)
    {
        while (strcmp(substr($block->hash, 0, $this->difficulty), $this->initialchars) !== 0) {
            $block->nonce++;
            $block->hash = $block->calculateHash();
        }
        echo "Block minat: ".$block->hash."\n";
    }
    /*
      Obtenir el darrer block
     */
    public function getLastBlock()
    {
        return $this->chain[count($this->chain)-1];
    }
    /*
        Afegim un block a la cadena.
     */
    public function push($block)
    {
        $block->previousHash = $this->getLastBlock()->hash;
        $this->mine($block);
        array_push($this->chain, $block);
    }
    /*
        Validem la integritat del blockchain. Si és cert retorna True, sino False. 
     */
    public function isValid()
    {
        for ($i = 1; $i < count($this->chain); $i++) {
            $currentBlock = $this->chain[$i];
            $previousBlock = $this->chain[$i-1];
            if ($currentBlock->hash != $currentBlock->calculateHash()) {
                return false;
            }
            if ($currentBlock->previousHash != $previousBlock->hash) {
                return false;
            }
        }
        return true;
    }
}