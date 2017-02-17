# Google Api pro Nette Framework

Nastavení v **config.neon**
```neon
extensions:
    googleApi: NAtrreid\GoogleApi\DI\GoogleApiExtension

googleApi:
    gaClientId: 'UA-XXXXXXXX-X'
    webMasterHash: 'i5S-XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
    adWordsConversionId: '1234567890'
    adWordsConversionLabel: 'xxx1XXx1xXXX123X1xX'
```

Použití
```php
/** @var NAttreid\GoogleApi\GoogleApiFactory @inject */
public $googleApiFactory;

protected function createComponentGoogleApi() {
    return $this->googleApiFactory->create();
}

public function someRender(){
    $this['googleApi']->conversion(3.5, 'CZK');       // konverze
}
```

v @layout.latte
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

na konverzní stránce (nejčastěji 'ThankYou')
```html
<html>
<body>
    <!-- html kod -->
    {control googleApi:adWords}
</body>
</html>
```
