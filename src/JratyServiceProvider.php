<?php namespace Wikigods\Jraty;

use Illuminate\Support\ServiceProvider;

class JratyServiceProvider extends ServiceProvider {


	public function boot()
	{
        $this->loadViewsFrom(
            $this->basePath('resources/views'),
            'jraty'
        );
		
	
	//$this->loadMigrationsFrom($this->basePath('database/migrations'));
        

        $this->publishes([
            $this->basePath('database/migrations') => database_path('migrations')
        ], 'jraty-migrations');



        $this->publishes([
            $this->basePath('config/jraty.php') => base_path('config/jraty.php')
        ], 'jraty-config');

        $this->publishes([
            $this->basePath('resources/jraty') => public_path('vendor/wikigods/jraty')
        ], 'wikigods-jraty');
	}

    public function register()
    {
        $this->app->bind('jraty', function() {
            return new Jraty;
        });

        $this->mergeConfigFrom(
            $this->basePath('config/jraty.php'),
            'jraty'
        );

    }
    protected function basePath($path = '')
    {
        return __DIR__ . '/../' . $path;
    }

}
