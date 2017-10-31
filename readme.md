# Google Api pro Nette Framework

Nastavení v **config.neon**
```neon
extensions:
    googleApi: NAtrreid\GoogleApi\DI\GoogleApiExtension

googleApi:
    gaClientId: 'UA-XXXXXXXX-X'
    webMasterKey: 'xxx1x1xxxx1xx1xx12XXXX123x1x1234xx1x12x123x'
    merchantKey: 'xxx1x1xxxx1xx1xx12XXXX123x1x1234xx1x12x123x'
    adWordsConversionId: '1234567890'
    adWordsConversionLabel: 'xxx1XXx1xXXX123X1xX'
```

Použití
```php
/** @var NAttreid\GoogleApi\IGoogleApiFactory @inject */
public $googleApiFactory;

protected function createComponentGoogleApi() {
    return $this->googleApiFactory->create();
}

public function someRender(){
    // adwords
    $this['googleApi']->remarketingEcomm('product', 3.5, 123);   // remarketing
    $this['googleApi']->conversion(3.5, 'CZK');                  // konverze
    
    // eCommerce
    $transaction = new Transaction;
    $transaction->id = 12345;
    $transaction->revenue = 5.5;
    $transaction->shipping = 1;

    $item = new Item;
    $item->name = 'Item';
    $item->sku = 'code';
    $item->category = 'category';
    $item->price = 5.5;
    $item->quantity = 1;
    $transaction->addItem($item);
}
```

v @layout.latte
```latte
<html>
<head>
    <!-- html kod -->
    {control googleApi:head}
</head>
<body>
    <!-- html kod -->
    {control googleApi}
</body>
</html>
```
