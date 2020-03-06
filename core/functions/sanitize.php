<?php
function escape($string) 
{
    return html_entity_decode($string, ENT_QUOTES, 'UTF-8');
}
?>

