FROM php:7-apache AS runtime

RUN docker-php-ext-install mysqli && \
  docker-php-ext-enable mysqli

CMD ["apache2-foreground"]
