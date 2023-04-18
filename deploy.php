<?php
namespace Deployer;

require 'recipe/symfony.php';

// Project name
set('application', 'gamme-prepa');

// Project repository

set('repository', 'git@github.com:CelluleDigitale/gamme-prepa.git');
set('http_user', 'ibepform-cellule');
// Windows Compatibility
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

set('bin/php', function() {
    return '/opt/php8.0/bin/php';
});

set('bin/composer', function () {
    return '/opt/php8.0/bin/php /opt/php8.0/bin/composer.phar';
});


// Tâches customs
desc('View migrations\'s status');
task('database:status', function () {
    run("cd {{release_or_current_path}} && {{bin/console}} doctrine:migrations:status {{console_options}}");
});

desc('Compile .env files to improve performance');
task('deploy:dump-env', function () {
    run('cd {{release_path}} && {{bin/composer}} dump-env prod');
});





// Hosts
host('preprod')
    ->setHostname('ftp.cluster003.hosting.ovh.net')
    ->setRemoteUser('ibepform-cellule')
    ->set('deploy_path', '~/landingpage/preprod-prepaprojet')
    ->set('branch', 'develop')
;
before('deploy:symlink', 'deploy:dump-env');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');