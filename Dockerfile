FROM php:8.2-apache
ENV DEBIAN_FRONTEND=noninteractive
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
EXPOSE 80
CMD ["apache2-foreground"]
