<?php

namespace Deployer;

require 'recipe/symfony.php';

// Config

set('repository', 'git@github.com:CelluleDigitale/gamme-prepa.git');
set('http_user', 'ibepform-cellule');

if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    set('git_tty', false);
    set('ssh_multiplexing', false);
}
set('keep_releases', 3);

set('shared_dirs', [
    'var/log',
    'public/uploads',
]);
set('allow_anonymous_stats', false);

// Hosts
host('preprod')
    ->setHostname('ftp.cluster003.hosting.ovh.net')
    ->setRemoteUser('ibepform-cellule')
    ->set('deploy_path', '~/preprod-prepaprojet')
    ->set('writable_mode', 'chmod')
    ->set('branch', 'develop');



after('deploy:failed', 'deploy:unlock');
