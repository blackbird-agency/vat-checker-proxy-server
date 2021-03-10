# Vat Checker Proxy Server

[![Latest Stable Version](https://img.shields.io/packagist/v/blackbird/vat-checker-proxy-server.svg?style=flat-square)](https://packagist.org/packages/blackbird/vat-checker-proxy-server)
[![License: MIT](https://img.shields.io/github/license/blackbird-agency/vat-checker-proxy-server.svg?style=flat-square)](./LICENSE)

This solution is a proxy server to validate VAT Numbers with [Europa VIES](https://ec.europa.eu/taxation_customs/vies/?locale=fr) and offer a solution to Magento Sever that are issuing temporary "IP BLOCKED" or "IP BANNED".
The proxy server should be installed in separate server with a distinct IP address from the server where the magento client is installed.

It aims to be used with [Vat Checker Proxy Client](https://github.com/blackbird-agency/vat-checker-proxy-client) for Magento 2.

### Requirements

This solution is requiring [php](https://www.php.net/manual/) 7.0 or greater and   [composer](https://getcomposer.org/) to work with autoload classes.

## Setup

### Get the package

**Composer Package:**

```
composer require blackbird/vat-checker-proxy-server
```

**Zip Package:**

Unzip the package and associate the pub/index.php file with an url. 

### Install the module

If you don't have 'vendor/autoload.php' and 'vendor/composer', use `composer dump-autoload` to get the autoloader of the classes.

- Make the index.php file available and associate it with an url.

- Edit the value of `PROTECTION_KEY` in [conf.php](conf.php) to define your authentication token.
Then enter your authentication token and the url of the proxy server to the client in the config.

## Support

- If you have any issue with this code, feel free to [open an issue](https://github.com/blackbird-agency/vat-checker-proxy-server/issues/new).
- If you want to contribute to this project, feel free to [create a pull request](https://github.com/blackbird-agency/vat-checker-proxy-server/compare).

## Contact

For further information, contact us:

- by email: hello@bird.eu
- or by form: [https://black.bird.eu/en/contacts/](https://black.bird.eu/contacts/)

## Authors

- **Bruno FACHE** - *Maintainer* - [It's me!](https://github.com/bruno-blackbird)
- **Blackbird Team** - *Contributor* - [They're awesome!](https://github.com/blackbird-agency)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

***That's all folks!***