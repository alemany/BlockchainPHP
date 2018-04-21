<?php
require_once('./blockchain.php');
/*
 Exemple de minat de 2 blocs i mostrar informació.
*/
echo "<html><body><h1>BlockchainPHP en memoria, exemple:</h1>";
$testCoin = new BlockChain();
echo "Minant block 1 [..]<br/>\n";
$testCoin->push(new Block(1, strtotime("now"), "Import: 100"));
echo "<br>Minant block 2 [..]<br/>\n";
$testCoin->push(new Block(2, strtotime("now"), "Import: 1020"));
echo '<br><br><i>'.json_encode($testCoin, JSON_PRETTY_PRINT).'</i><br>';
/*
 Test en el minat de blocs 3 i 4. 
*/
echo "<br>Minant block 3 [..]<br/>\n";
$testCoin->push(new Block(3, strtotime("now"), "Import: 45"));
echo "<br>Minant block 4 [..]<br/>\n";
$testCoin->push(new Block(4, strtotime("now"), "Import: 2983"));
echo "<br>El blockchain és vàlid? ".($testCoin->isValid() ? "Correcte" : "Incorrecte")."\n";
echo "<br>Canviant el block 4...<br/>\n";
$testCoin->chain[1]->data = "amount: 300";
$testCoin->chain[1]->hash = $testCoin->chain[1]->calculateHash();
echo "El blockchain és vàlid? ".($testCoin->isValid() ? "Correcte" : "Incorrecte")."\n";
