# Jakub Łuczyński CV #

**This CV is created using PHP 7 with Zend Framework 3 and TCPDF library (https://tcpdf.org)**

Latest version of PDF file can be found here: http://cv.creolink.pl/


# Nginx, example configuration #

```
#!txt
server {
    server_name cv.dev en.cv.dev pl.cv.dev de.cv.dev;
    root /path/to/cv/public;

    listen       80;
    access_log   /path/to/nginx/log/cv.access.log;
    error_log    /path/to/nginx/log/cv.error.log;

    send_timeout 60;
    client_header_timeout 60;
    client_body_timeout 60;
    client_max_body_size 40M;
    fastcgi_read_timeout 60;
    fastcgi_send_timeout 60;

    fastcgi_buffers 16 16k;
    fastcgi_buffer_size 32k;

    location / {
      index    index.php;
      root     /path/to/cv/public;
      client_max_body_size 4M;
      client_body_buffer_size 128k;

      if (!-e $request_filename) {
        rewrite ^(.+?\/*)$   /?path=$1 last;
      }
    }

    location ~ \.php$ {
      client_max_body_size 4M;
      client_body_buffer_size 128k;

      root           /path/to/cv/public;
      fastcgi_pass   127.0.0.1:8181;
      fastcgi_index  index.php;
      fastcgi_param  SCRIPT_FILENAME  /path/to/cv$fastcgi_script_name;

      include fastcgi_params;
    }
}

```

# Testing #

Behat:
```
make behat
```

PHPUnit:
```
make phpunit
```


------------------------


# ZF3 books: #
* https://olegkrivtsov.github.io/using-zend-framework-3-book/html/
* http://neverstopbuilding.com/set-up-zend-framework-2-with-behat-and-twig
* http://zf2cheatsheet.com/
* https://docs.zendframework.com/
* https://docs.zendframework.com/tutorials/
* https://framework.zend.com/learn
* https://framework.zend.com/manual/2.4/en/index.html
* https://zfmodules.com/
* https://github.com/zendframework
* https://github.com/zendframework/zf3-web
* https://zend-expressive.readthedocs.io/en/latest/
* http://circlical.com/blog/2016/3/9/preparing-for-zend-f
* https://www.youtube.com/watch?v=sXTaWb7Tg6k&list=PLXRC3l-ZhN3rQrtVm9nLe_vRi7AB-iWOX
* http://www.zendcon.com/tutorial
* http://www.zimuel.it/slides/midwestphp2016/expressive


# Behat / BDD #
* https://www.jverdeyen.be/php/behat-file-downloads/
* http://matmati.net/testing-pdf-with-behat-and-php/
* https://php-xpdf.readthedocs.io/en/latest/
* https://github.com/Behat/MinkExtension
* https://github.com/Behat/WebApiExtension
* https://www.slideshare.net/JessicaMauerhan/behat-beyond-the-basics
* http://mink.behat.org/en/latest/
* https://www.pavlakis.info/php/23-having-a-go-at-creating-a-behat-3-extension
* https://speakerdeck.com/weaverryan/behavioral-driven-development-with-behat-and-zend-framework-2
* https://www.slideshare.net/marcello.duarte/bdd-for-zend-framework-with-php-spec
* https://github.com/alteris/behat-zendframework-extension
* https://github.com/mvlabs/zf2behat-extension


# PDF #
https://github.com/schmengler/PdfBox