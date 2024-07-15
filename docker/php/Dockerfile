FROM php:8.2-fpm

# Instalar dependências
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    default-mysql-client \
    netcat-openbsd \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli

# Instalar e habilitar redis
RUN pecl install redis \
    && docker-php-ext-enable redis

# Copiar o arquivo de configuração customizado
COPY docker/php/local.ini /usr/local/etc/php/conf.d/

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar todos os arquivos para o contêiner
COPY . /var/www

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Executar o Composer install para garantir que as dependências estão instaladas
RUN composer install

# Permitir a escrita no diretório de cache do Composer
RUN chmod -R 755 /root/.composer

# Copiar o script de entrada
COPY docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh

# Definir permissões de execução para os scripts
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expor a porta 9000 para comunicação com o Nginx
EXPOSE 9000

RUN rm .env
RUN cp .env.container .env

# Definir o entrypoint
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Comando padrão
CMD ["php-fpm"]