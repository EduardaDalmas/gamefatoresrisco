#!/bin/sh

echo "Starting entrypoint script..."

# Verificar se as variáveis de ambiente necessárias estão definidas
if [ -z "$DB_HOST" ]; then
  echo "DB_HOST is not set. Exiting."
  exit 1
fi

if [ -z "$DB_PORT" ]; then
  echo "DB_PORT is not set. Exiting."
  exit 1
fi

if [ -z "$DB_USERNAME" ]; then
  echo "DB_USERNAME is not set. Exiting."
  exit 1
fi

if [ -z "$DB_PASSWORD" ]; then
  echo "DB_PASSWORD is not set. Exiting."
  exit 1
fi

# Função para verificar a conexão com o banco de dados
check_mysql_connection() {
  echo "Checking MySQL connection..."
  mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SHOW DATABASES;" > /dev/null 2>&1
}

# Esperar até que o MySQL esteja pronto
while ! nc -z "$DB_HOST" "$DB_PORT"; do
  echo "Waiting for MySQL to be ready..."
  sleep 0.5
done

echo "MySQL is up"

# Aguardar até que a conexão com o banco de dados seja bem-sucedida
until check_mysql_connection; do
  echo "Waiting for MySQL database connection..."
  sleep 0.5
done

echo "MySQL database connection established"

# Instalar dependências do Composer
echo "Running composer install..."
composer install

# Executar migrações do banco de dados
echo "Running php artisan migrate..."
php artisan migrate

# Executar o comando php artisan user:admin
echo "Running php artisan user:admin..."
php artisan user:admin

echo "Entrypoint script completed"

# Manter o PHP-FPM rodando
php-fpm