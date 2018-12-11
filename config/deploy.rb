set :application, 'opality.troopers.agency'
set :server, '62.210.94.193'
set :repo_url, 'ssh://git@gitlab.troopers.agency:22022/troopers/opality.git'
set :branch, 'master'
set :user, "opality"

set :symfony_roles, :all
set :symfony_deploy_roles, :all

# Default deploy_to directory is /var/www/#{fetch(:application)}
set :deploy_to, '/var/www/' + fetch(:application)

#### COMPOSER ########
set :composer_install_flags, '--no-interaction --prefer-dist'
set :uploads_path,          fetch(:web_path) + "/uploads"

set :pty, true

set :linked_dirs, [
    fetch(:var_path),
    fetch(:uploads_path)
]

# Dirs that need to be writable by the HTTP Server (i.e. cache, log dirs)
set :file_permissions_paths, [
    fetch(:var_path),
    fetch(:uploads_path)
]

# Name used by the Web Server (i.e. www-data for Apache)
set :file_permissions_users, ['www-data']

# Name used by the Web Server (i.e. www-data for Apache)
set :webserver_user,        "www-data"

# Method used to set permissions (:chmod, :acl, or :chgrp)
#set :permission_method, :all

# --------------
set :ssh_options, {
    keys: %w(~/.ssh/opality_id_rsa),
    forward_agent: false
}

namespace :doctrine do
    desc <<-DESC
        Doctrine migrations
    DESC
    task :migrate do
        invoke 'symfony:console', 'doctrine:migrations:migrate', '--no-interaction'
    end
end
namespace :fos do
    desc <<-DESC
        Dump js routes
    DESC
    task :dump_js_routes do
        on roles(:app) do
            execute "cd #{release_path} && php " + fetch(:symfony_console_path) + " --env=prod fos:js-routing:dump --format=json --target=public/js/fos_js_routes.json"
        end
    end
end

set :npm_flags, ''
before 'composer:install', 'npm:install'

before 'deploy:updated', 'doctrine:migrate'
before 'deploy:updated', 'deploy:set_permissions:acl'
before 'deploy:updated', 'symfony:assets:install'

after 'symfony:assets:install', 'fos:dump_js_routes'
