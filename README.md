# Runner

Runner for stack middlewares based on HttpKernelInterface.

## Example

```php
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MyKernel implements HttpKernelInterface
{
    public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
    {
        return new Response("Hello");
    }
}

$app = (new Stack\Builder())->resolve(new MyKernel());
(new Runner($app))->run();
```
## Inspiration

* [HttpKernel middlewares](https://igor.io/2013/02/02/http-kernel-middlewares.html)
* [Stack](http://stackphp.com/)
