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


task('build', function () {
    run('cd {{release_path}} && build');
});


set('bin/php', function () {
    return '/usr/local/php7.4/bin/php';
});

set('bin/composer', function () {
    return '/usr/local/php7.4/bin/php /usr/local/bin/composer.phar';
});

desc('Compile .env files to improve performance');
task('deploy:dump-env', function () {
    run('cd {{release_path}} && {{bin/composer}} dump-env prod');
});

// Hosts
host('preprod')
    ->setHostname('ssh.cluster003.hosting.ovh.net')
    ->setRemoteUser('ibepform-cellule')
    ->set('deploy_path', '~/landingpage/preprod-prepaprojet')
    ->set('writable_mode', 'chmod')
    ->set('branch', 'develop');

    before('deploy:symlink', 'deploy:dump-env');

after('deploy:failed', 'deploy:unlock');
