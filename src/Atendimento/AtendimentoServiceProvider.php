<?php 

namespace Manzoli2122\Salao\Atendimento;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AtendimentoServiceProvider extends ServiceProvider
{

 
    protected $defer = false;
    protected $namespace = 'Manzoli2122\Salao\Atendimento\Http\Controllers'  ;
    
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' =>  config_path('atendimento.php'), 
        ], 'atendimento_config');
        $this->mapWebRoutes();     
        $this->loadViewsFrom(__DIR__.'/Views', 'atendimento');
    }


    private function mapWebRoutes()
    {                
        Route::middleware('web')
                ->namespace($this->namespace)
                ->group(__DIR__.'/Http/routes.php');
    }



    public function register()
    {
       
        $this->mergeConfig();
    }


   

    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'atendimento'
        );
    }

   



   
}

