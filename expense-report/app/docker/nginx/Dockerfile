FROM nginx:alpine

ENV TZ=Europe/Paris
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

COPY . /app
COPY docker/nginx/default.conf /nginx.conf.template

CMD ["/bin/sh" , "-c" , "envsubst '$PHP_HOST' < /nginx.conf.template > /etc/nginx/conf.d/default.conf && exec nginx -g 'daemon off;'"]

EXPOSE 80