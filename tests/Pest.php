<?php

use Saloon\Config;
use Saloon\Http\Faking\MockClient;

uses()
    ->beforeEach(fn () => MockClient::destroyGlobal())
    ->in(__DIR__);

Config::preventStrayRequests();
