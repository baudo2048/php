<?php

function table_exists($array, $tabName){

    foreach ( $array as $element ) {
        if ( $id == $element->tabName ) {
            return $element;
        }
    }

    return false;
}


$collectionName = "firstCollection";

$obj->Project = (object)[];
$obj->name = "first project name";
$obj->Project->name = "first project";
$obj->Project->Components = array();
$obj->Project->Components[0]->fileName = "first component";


//echo json_encode($obj);


// QUI POSSIAMO INIZIARE A CREARE LA STRUTTURA CHE FORMA LA BASE PER CREARE LE TABELLE

$array = get_object_vars($obj);
$properties = array_keys($array);

$prefix = "";
$nodes = array();
foreach($properties as $p){

    $node = (object)[];
    $node->prefix = $prefix;
    $node->property = $p;
    $node->obj = $obj;
    $node->tableOwner = $collectionName;

    array_push($nodes,$node);
}


$tables = array();

while(sizeof($nodes)>0){
    $node = array_pop($nodes);
    $propName = $node->property;

    //echo "working on $propName<br>";

    $nodeObj = $node->obj;

    $p = $nodeObj->$propName;

    if(is_object($p)){
        $array = get_object_vars($p);
        $properties = array_keys($array);
        
        foreach($properties as $pr){

            $n = (object)[];
            $n->prefix = "$node->prefix _ $propName";
            $n->property = $pr;
            $n->obj = $p;
            $n->tableOwner = "$node->tableOwner _ $node->prefix";

            array_push($nodes,$n);
        }
    }

    if(is_array($p)){
        // Devo analizzare il primo elemento dell'array - sto supponendo tutti elementi uguali !!!
        $firstEl = null;
        if(sizeof($p)>0){
            $firstEl = $p[0];

            $n = (object)[];
            $n->prefix = "$node->prefix _ $propName";
            $n->property = $propName;
            $n->obj = $p;
            $n->tableOwner = $n->prefix;

            array_push($nodes,$n);
        }
    }

    if(!is_object($p) and !is_array($p)){
        //echo "is field $node->prefix $node->property $p<br>";
        echo "FIELD IN TABLE: $node->tableOwner + $node->prefix<br>";

        $el = table_exists($tables,$node->tableOwner);
        if($el){
            array_push($el->fields, "$node->prefix _ $propName");
        } else {
            $t = (object)[];
            $t->name = $node->tableOwner;
            $t->fields = array();
            
            array_push($t->fields, "$node->prefix _ $propName");
            array_push($tables, $t);
        }

    }

  

}


echo json_encode($tables);

?>
