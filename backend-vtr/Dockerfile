FROM ubuntu:latest
ENV DEBIAN_FRONTEND=NONINTERACTIVE
RUN apt update
RUN apt install -y \
    php \
    php-bcmath \
    php-curl \
    php-json \
    php-mbstring \
    php-mysql \
    php-tokenizer \
    php-xml \
    php-zip \
    git \
    && \
    apt clean && \
    apt autoremove -y && \
    rm -rf /etc/apt/sources.list

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /app

COPY start.sh .
RUN chmod +x start.sh
ENTRYPOINT [ "bash", "-c", "/app/start.sh" ]