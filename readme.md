# Google Api pro Nette Framework

Nastavení v **config.neon**
```neon
extensions:
    googleApi: NAtrreid\GoogleApi\DI\GoogleApiExtension

googleApi:
    gaClientId: 'googleAnalyticsclientId'
    webMasterHash: 'hash'
```

Použití
```php
/** @var NAttreid\GoogleApi\GoogleApiFactory @inject */
public $googleApiFactory;

protected function createComponentGoogleApi() {
    return $this->googleApiFactory->create();
}

public function someRender(){
    $this['googleApi']->search('searchWord');       // vyhledavani
}
```

v latte
```latte
<html>
<head>
    <!-- html kod -->
    {control googleApi:webMaster}
</head>
<body>
    <!-- html kod -->
    {control googleApi}
</body>
</html>

```
