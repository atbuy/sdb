FROM php:apache AS runtime

RUN docker-php-ext-install mysqli && \
  docker-php-ext-enable mysqli

CMD ["apache2-foreground"]
