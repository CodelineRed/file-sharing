FROM adminer:latest

USER root
RUN mkdir -p /var/www/html/designs/custom
COPY ./adminer.css /var/www/html/designs/custom/adminer.css
USER adminer