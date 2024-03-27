<?php

arch('it will not use dd or dump function')
    ->expect(['dd', 'dump'])
    ->each->not->toBeUsed();
