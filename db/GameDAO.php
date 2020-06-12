<?php

abstract class GameDAOImpl
{
    abstract function getGames();
    abstract function getGamesByTag($tag);
    abstract function getGame($gameID);

}

class GameDAO extends UserDAOImpl
{

}

?>