# Aye Aye Formatters

Aye Aye Formatters are a tool that to streamline the conversion of PHP data (arrays or objects) into serialised data
formats, such as JSON or XML. Other formats can be easily added by extending the Formatter abstract.

**License**: [MIT](https://opensource.org/licenses/MIT)

Development Build Status:

Travis CI: [![Build Status](https://travis-ci.org/AyeAyeApi/Formatters.svg?branch=master)]
 (https://travis-ci.org/AyeAyeApi/Formatters)
 [Report](https://travis-ci.org/AyeAyeApi/Formatters)

## Formatting Data

To format data into any specific serialised data format, just instantiate the formatter and pass it the data.

```php
use AyeAye\Formatter\Writer\Json;

$data = ['boolean' => true];

$json = new Json();
echo $json->format($data); // {"boolean":true}
```

The fullFormat method always assumes you want a valid file output. If you want only a partial format, just use the
 `partialFormat()` method. For example:

```php
use AyeAye\Formatter\Writer\Xml;

$data = ['boolean' => true];

$xml = new Xml();
echo $xml->format($data); // <?xml version="1.0" encoding="UTF-8" ?><array><boolean>true</boolean></array>
echo $xml->partialFormat($data); // <array><boolean>true</boolean></array>
```

## The FormatFactory

The above functionality isn't particularly useful on it's own, that's where the FormatFactory comes in. Using the
 Factory, we can predefine a set of Formatters and then choose one later.

```php
use AyeAye\Formatter\FormatFactory;
use AyeAye\Formatter\Writer\Json;

$formatFactory = new FormatFactory([
    'json' => new Json(),                    // Instantiate
    'xml' => 'AyeAye\Formatter\Writer\Xml', // or don't
]);

$formatFactory->getFormatterFor('json'); // returns the same Json instance every time.
$formatFactory->getFormatterFor('xm'); // returns a new XML instance every time.
```

More importantly you can request a formatter using an array of possible formats. This is useful as there are multiple
 ways an HTTP request could tell you what data format is desired. The correct way of course is to use the `Accepts`
 header. However, you could use a file suffix. What if the request came through without either, or none that are known
 to you? Then a default would be appropriate.
 
```php
use AyeAye\Formatter\FormatFactory;
use AyeAye\Formatter\Writer\Json;
use AyeAye\Formatter\Writer\Xml;

$xmlFormatter = new Xml();
$jsonFormatter = new Json();
$this->formatFactory = new FormatFactory([
    // xml
    'xml' => $xmlFormatter,
    'text/xml' => $xmlFormatter,
    'application/xml' => $xmlFormatter,
    // json
    'json' => $jsonFormatter,
    'application/json' => $jsonFormatter,
]);

$formatFactory->getFormatterFor([
    $_HEADER['Accepts'], // The header that requests a specific format
    getRequestSuffix(),  // A result of looking at suffix of the requested resource
    'json',              // A fallback option
]);
```

## Creating New Formats

If you wish to return data in a format that isn't the included Json, Jsonp or Xml (or, if you want to improve on those
 provided), you can do so by extending the FormatFactory abstract class. You should be aware of the serializable
 interface described below.
 
## Customising Output

A Serializable interface is provided to help customise the output. Any object implementing the interface just needs
 to return the data it wants to be serialised by the formatters from the method `ayeAyeSerialize()` in a keyed array
 much like Php's own JsonSerializable interface works.
 
Formatters will recurse through objects in order to only collect only the data you wish to give them.
