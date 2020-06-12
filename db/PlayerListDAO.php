<?php

abstract class PlayerListDAOImpl
{
    abstract function getPlayers($gameID, $ranks=NULL, $role = NULL);
    abstract function addPlayer($gameID, $userID, $rank, $role, $status);
    


}

class PlayerListDAO extends UserDAOImpl
{

}

?>