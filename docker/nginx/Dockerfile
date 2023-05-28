FROM nginx:stable-alpine

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf

WORKDIR /var/www

CMD ["nginx"]

EXPOSE 80 443
