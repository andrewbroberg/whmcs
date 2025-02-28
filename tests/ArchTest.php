<?php

it('will not use debugging functions')
    ->expect(['dd', 'dump', 'ray'])
    ->not->toBeUsed();

arch('dtos are read only')
    ->expect('AndrewBroberg\WHMCS\DataTransferObjects')
    ->toBeReadonly();

arch('strict types is used')
    ->expect('AndrewBroberg\WHMCS')
    ->toUseStrictTypes();

arch()->preset()->php();
arch()->preset()->security();
