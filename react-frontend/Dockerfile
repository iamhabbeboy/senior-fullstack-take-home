FROM node:12-alpine as build-step
RUN mkdir /app
WORKDIR /app
COPY package.json /app
COPY yarn.lock /app
RUN yarn install
COPY . /app
RUN yarn run build
CMD [ "yarn", "start" ]