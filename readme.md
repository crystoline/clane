### Installation
* clone/download project
* `Run docker-composer up -d`
* `Run docker container exec -it clane_app_1 bash`
* `Run compsoer install`
* `Run php artisan migrate:fresh --seed`

The application URL is http://localhost:8080 

### Testing
 * `Run docker container exec -it clane_app_1 bash`
 * `Run ./vendor/bin/phpunit`
 
 #### Login Detail
```
email: crystoline@hotmail.com
passord: password
```
#### Note
Use the appropriate  container Name/ID (clane_app_1) for each of the docker command.
