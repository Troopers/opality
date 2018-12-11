set :stage, :prod

server fetch(:server),
    user: fetch(:user),
    port: 22,
    roles: %w{web app db}