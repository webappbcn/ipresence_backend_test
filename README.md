<h1>Installation</h1>
<ol>
<li>Clone repository inside your project</li>
<li>Set the docker compose file</li>
<li>Configure in your hosts file the following line: 192.168.13.35 api.ipresence.docker</li>
<li>Execute composer install inside docker image: phpsrv -> /srv/www/vhosts/apirest</li>
<li>Configure the api test:
<br>1 Remove the file: api.suite.yml
<br>2 Execute in docker: php vendor/bin/codecept generate:suite api
<br>3 Restore the file api.suite.yml
</li>
</ol>

<h2>A bit explanation</h2>
<ol>
<li>The application follows the DDD model: Application, Domain, Infrastructure layers, UI(not set because is api rest)</li>
<li>I use a api/src/Application/EventListener/ExceptionListener to manage the exceptions, <br>
The response of the API should include the response status and response message, it's not set because I follow the model of the exercise,
but you can see an example if you access to the url with worng parameter: http://api.ipresence.docker/shout/steve-jobs?limit=test
</li>
<li>I use the DTO concept to modify the response object</li>
<li>The test I did are: unit and api test, to execute, run the test inside docker: ./vendor/codeception/codeception/codecept run tests/
</li>
<li>I use codesniffer to have better quality code</li>
</ol>


