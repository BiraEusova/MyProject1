<?php

$ID = 1;
function setUserID($userID)
{
    $GLOBALS['ID'] = $userID;
}

function getCurUserID()
{
    return $GLOBALS['ID'];
}
