<?php

use FriendsOfRedaxo\YrewriteMetainfo\Domain;

if(count(Domain::query()->find()) === 0) {
    $domain = Domain::create();
    $domain->setName(rex::getServerName());
    $domain->setYrewriteDomainId(1);
    $domain->save();
}
