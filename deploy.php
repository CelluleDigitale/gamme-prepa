<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'gamme-prepa');

// Project repository

set('repository', 'git@github.com:CelluleDigitale/gamme-prepa.git');
set('http_user', 'ibepform-cellule');
set('git_ssh_command', 'ssh');
if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    set('git_tty', false);
    set('ssh_multiplexing', false);
    set('use_ssh_agent', true);
    set('git_ssh_command', true);
}

set('keep_releases', 3);

add('shared_dirs', [  'var/log',
'public/uploads',]);
set('allow_anonymous_stats', false);



// Hosts
host('preprod')
    ->setHostname('ftp.cluster003.hosting.ovh.net')
    ->setRemoteUser('ibepform-cellule')
    ->set('deploy_path', '~/landingpage/preprod-prepaprojet')
    ->set('branch', 'develop')
;

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');