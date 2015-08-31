# Aye Aye Formatters

Aye Aye Formatters are a tool that to streamline the conversion of PHP data (arrays or objects) into serialised data
formats, such as JSON or XML. Other formats can be easily added by following the Formatter interface.

**License**: [GPL-3.0+](https://www.gnu.org/copyleft/gpl.html)

Development Build Status:

Travis CI: [![Build Status](https://travis-ci.org/AyeAyeApi/Formatters.svg?branch=master)]
(https://travis-ci.org/AyeAyeApi/Formatters)
[Report](https://travis-ci.org/AyeAyeApi/Formatters)

## Formatting Data

To format data into any specific serialised data format, just instantiate the formatter and pass it the data.

```php
use AyeAye\Formatter\Formats\Json;

$data = ['boolean' => true];

$json = new Json();
echo $json->fullFormat($data); // {"boolean":true}
```

The fullFormat method always assumes you want a valid file output. If you want only a partial format, just use the
`format` method. For example:

```php
use AyeAye\Formatter\Formats\Xml;

$data = ['boolean' => true];

$xml = new Xml();
echo $xml->format($data); // <array><boolean>true</boolean></array>
echo $xml->fullFormat($data); // <?xml version="1.0" encoding="UTF-8" ?><array><boolean>true</boolean></array>
```