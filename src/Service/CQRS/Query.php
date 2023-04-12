<?php


interface Query
{
}

interface QueryBus
{
    /** @return mixed */
    public function handle(Query $query);
}

interface QueryHandler
{
}