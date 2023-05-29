<?php

it('will not use debugging functions')
    ->expect(['dump', 'ray'])
    ->each->not->toBeUsed();
