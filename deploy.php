<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project repository
set('repository', 'git@github.com:CelluleDigitale/gamme-prepa.git');
set('http_user', 'ibepform-cellule');

set('keep_releases', 3);

add('shared_dirs', [  'var/log',
'public/uploads',]);
set('allow_anonymous_stats', false);

// Hosts
host('preprod')
    ->setHostname('ftp.cluster003.hosting.ovh.net')
    ->set('remote_user','ibepform-cellule')
    ->set('deploy_path', '~/landingpage/preprod-prepa-projet')
    ->set('branch', 'develop')
;


// Hooks

after('deploy:failed', 'deploy:unlock');
