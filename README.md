### The goal

An opensource generic api to retrieve common data needed by anyone like:
- Countries and related data like cities, towns, region, continent, currency etc...
- Many more

## Credits

Created by [Edouard Kombo](https://medium.com/@edouard.kombo). 

## Setup

sudo sysctl -w vm.max_map_count=262144 #Elasticsearch
sudo docker network create api_platform_network
sudo docker-compose pull # Download the latest versions of the pre-built images

Create those subdomains

grafana._yoursite_._yourextension_
kibana._yoursite_._yourextension_
elastic-api._yoursite_._yourextension_
elastic-api2._yoursite_._yourextension_
mercure._yoursite_._yourextension_
admin._yoursite_._yourextension_
api._yoursite_._yourextension_
cache._yoursite_._yourextension_
logstash._yoursite_._yourextension_

## Run

sudo docker-compose up -d # Running in detached mode