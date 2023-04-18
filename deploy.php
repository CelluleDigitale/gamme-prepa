<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:CelluleDigitale/gamme-prepa.git');
set('http_user', 'ibepform-cellule');

set('keep_releases', 3);

set('shared_dirs', [
    'var/log',
    'public/uploads',
]);

// Hosts
host('preprod')
    ->setHostname('ftp.cluster003.hosting.ovh.net')
    ->setRemoteUser('ibepform-cellule')
    ->set('deploy_path', '~/preprod-prepaprojet')
    ->set('branch', 'develop');



after('deploy:failed', 'deploy:unlock');
