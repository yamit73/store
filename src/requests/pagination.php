<?php
namespace App;

$offset=0;
$noofProduct = (Functions::noOfProducts());
$noOfPages = ceil($noofProduct['count'] / 5);
if (isset($_REQUEST['atpage'])) {
    $atpage=$_REQUEST['atpage'];
    if ($atpage>=2) {
        $offset=5;
        $offset *=$atpage-1;
    }
    
}

function pagination()
{
    $noofProduct = (Functions::noOfProducts());
    $noOfPages = ceil($noofProduct['count'] / 5);
    $html='';
    for ($i=1; $i<=$noOfPages; $i++) {
        $html .='<li class="page-item"><a class="page-link" href="?currentSection=Products&atpage='.$i.'">'.$i.'</a></li>';
    }
    return $html;
}
