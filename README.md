# testo
Simple wrapper over built-in php server for tests

## Usage
```php
$server = new Testo\Server(Testo\SimpleResponse::class);
echo file_get_contents($server->getUrl() . "/some_uri_with/?get=param");
```

### Output
```
{"headers":{"Host":"127.0.0.1:12345","Connection":"close"},"host":"127.0.0.1:12345","uri":"/some_uri_with/?get=param","get":{"get":"param"},"post":[]}
```