

```php


class AvitoService 
{
    protected AvitoClient $client;



    public function __construct($config)
    {
        $this->setupClient();
    }
    
    private function setupClient()
    {
        $config = 
        $client = new AvitoClient( $config );
        
        $this->client = $client;
    }    
}

```