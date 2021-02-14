Laravel 8 Rating Package
=====

Rating Package using jQuery Raty plugin for item ratings + optional microdata format.


![alt text](https://i.imgur.com/4H7jwUb.png "1")
![alt text](https://i.imgur.com/WTban3m.png "2")
![alt text](https://i.imgur.com/7yPN7YL.png "3")
![alt text](https://i.imgur.com/ol9a79M.png "4")
![alt text](https://i.imgur.com/hxeUqPF.png "5")

The package is doing everything for you - from displaying rating to receiving rating and stores it into database.

This package is a re-edited, reorganized and maintained version of escapeboy/jraty, which is no longer maintained.
***
Installation
=====


Require this package with composer:
```
composer require wikigods/jraty
```
`The service provider will be auto-discovered. You do not need to add the provider anywhere.`

Configuration
To use your own settings, publish config.
```
php artisan vendor:publish --provider="Wikigods\Jraty\JratyServiceProvider"
```
Config file `config/jraty.php` should like this
```
return [
    'route' => 'save/item_rating'
];
```
Prepare for usage
====
First you need to load jQuery
```html
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
```
then need to load Raty plugin. You can use it like this:
```php
echo Jraty::js()
```
or
```html
<script src="vendor/wikigods/jraty/js/jquery.raty.min.js"></script>
```
After we need to initialize Raty plugin.

Using library:
```php
echo Jraty::js_init($params=[]);
```
Jraty::js_init accepts array with options for Raty. More info can be found on [Raty website](http://wbotelhos.com/raty)

For example this and it is default:
```php
Jraty::js_init([
    'score' => 'function() { return $(this).attr(\'data-score\'); }',
    'number' => 5,
    'click' => 'function(score, evt) {
                $.post(\'save/item_rating\',{
                    item_id: $(\'[data-item]\').attr(\'data-item\'),
                    score: score
                });
              }',
    'path' => '\'vendor/wikigods/jraty/img\''
]);
```
returns
```javascript
$(document).ready(function () {
    $('#item-rating').raty({
        'score': function () {
            return $(this).attr('data-score');
        },
        'number': 5,
        'click': function (score, evt) {
            $.post('save/item_rating', {
                item_id: $('[data-item]').attr('data-item'),
                score: score
            });
        },
        'path': 'vendor/wikigods/jraty/img'
    });
});
```
**Important:** If you noticed in php call single quotes are escaped.

Usage
=====
```php
echo Jraty::html($item_id, $item_name='', $item_photo='', $seo=true);
```
*If you are using seo option (true by default) its good to set a item_name*

And result will be
![alt text](https://i.imgur.com/4H7jwUb.png "1")
![alt text](https://i.imgur.com/WTban3m.png "2")
![alt text](https://i.imgur.com/7yPN7YL.png "3")
![alt text](https://i.imgur.com/ol9a79M.png "4")
![alt text](https://i.imgur.com/hxeUqPF.png "5")



*Library is accepting only one rating per item from single IP.*

Additional
----
Deleting record
```php
Jraty::delete($id)
```
Adding manual rating
```php
$data = [
        'item_id'    => Request::get('item_id'),
        'score'      => Request::get('score'),
        'added_on'   => DB::raw('NOW()'),
        'ip_address' => Request::getClientIp()
		];
Jraty::add($data);
```
Getting rating data for item
```php
$rating = Jraty::get($item_id);
echo $rating->avg; // avarage score
echo $rating->votes; // total votes
```
