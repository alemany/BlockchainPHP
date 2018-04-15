<?php

/* 
 Creació del block. Seguint especificacions: 
 https://www.albertalemany.com/2018/04/com-funciona-i-que-es-el-blockchain.html
 */
class Block
{
    public $nonce; //num. minable

    public function __construct($index, $timestamp, $data, $previousHash = null)
    {
        $this->index = $index;
        $this->timestamp = $timestamp;
        $this->data = $data;
        $this->previousHash = $previousHash;
        $this->hash = $this->calculateHash();
        $this->nonce = 0;
    }
    public function calculateHash()
    {
          // retorna hash utilitzant sha512 string de char(128)
        return hash("sha512", $this->index.$this->previousHash.$this->timestamp.((string)$this->data).$this->nonce);
    }
}