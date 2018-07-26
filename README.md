# MyLife API

Welcome to MyLife Team.

## Installation
MyLife requires **PHP 7.0 or later**

* ```git clone git@github.com:amagumolabs/mylife-api.git api```

* ```cd api```

* ```composer install```

Please make sure you have [Composer](https://getcomposer.org/doc/00-intro.md) installed on your machine.

* Update **.env** file:

Rename **.env.example** to **.env**. Then update **DB_*** base on your information

* ```php artisan migrate```

* ```php artisan db:seed```

## Resolve some problem
After config, if your project not yet running, please try run 2 command:

* ```php artisan config:cache```
* ```php artisan cache:clear```

## Resources
You can find some development resources:

* [Postman](https://drive.google.com/drive/u/1/folders/1mBmnX-AARcd8jxlVHYnDGPAHwbQu1RGv?ogsrc=32)
* [Slack](https://amagumolabs.slack.com/messages/CBALGA50S/details/)