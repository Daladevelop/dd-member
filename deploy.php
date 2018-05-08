<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'members.daladevelop.se');

// Project repository
set('repository', 'git@github.com:Daladevelop/dd-member.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 
set('http_user','www');
// Shared files/dirs between deploys 
add('shared_files', ['.env']);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('members.daladevelop.se')
    ->set('deploy_path', '/import/members.daladevelop.se/public_html');    
    
// Tasks

//task('build', function () {
//    run('cd {{release_path}} && git pull && npm install && composer install');
//});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

