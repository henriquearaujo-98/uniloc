Project carried out within the scope of the Project subject of the Computer Engineering course at the Polytechnic Institute of Bragança

The project revolves around gathering information about the portuguese higher education instituitions and make them searchable through an interactive map powered by OpenLayers.

## Crawler

The web crawler can be found in the ```uniloc_crawler``` folder. Within that folder there will be another subfolder with my name. It is necessary to install the ```Scrapy``` framework in Python with the following command:

```bash
pip install scrapy
```

You can run the following command to execute each spider individually and produce the output to the file

```bash
scrapy crawl <spider name> -o.json file
```

## Laravel

The laravel project located in the ```laravel``` folder can be started with the following command:

```bash
php artisan serve --port=3500
```

The .env file contains the configuration parameters for connecting to the MySQL database.

## VueJS

The VueJS project can be found at ```laravel > vue```. To initialize the project, use the following command:

```bash
npm run serves
```


## Contributors

Diogo Castro
Henrique Araujo
