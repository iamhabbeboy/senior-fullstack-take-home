FROM python:3.8-slim-buster
RUN mkdir /app
WORKDIR /app

COPY requirements.txt requirements.txt
ENV SOAP_SERVICE_TOKEN 123
ENV SOAP_SERVICE_HOST http://php-soapservice.test/server.php
RUN pip3 install -r requirements.txt

COPY . ./app

CMD [ "python", "app.py"]