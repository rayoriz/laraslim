<?php
namespace ConceptCore\LaraSlim;

use Slim\App;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Respect\Validation\Validator as V;
use Illuminate\Database\Capsule\Manager;
use Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware;

class AppStarter extends App
{
    protected $container;
    private $baseConfig;

    public function __construct($container = [])
    {
        parent::__construct($container);
        V::with('App\\Validation\\Rules\\');
        $this->container = $this->getContainer();
        $this->baseConfig = $container['settings']['base'];
    }

    /**
     * This function will initiate all needed applications.
     * @return void
     */
    public function startUp()
    {
        // Run a few functions so we can startup the application.
        $this->isCsrfEnabled()
            ->loadMiddleWare()
            ->isAuthEnabled()
            ->isFlashEnabled()
            ->setUpViewEngine()
            ->setUpValidation()
            ->setUpDatabase()
            ->isLogEnabled();
    }

    /**
     * Check if the user has enabled csrf in the base config.
     * @return object
     */
    private function isCsrfEnabled()
    {
        if ($this->baseConfig['csrf'] == true) {
            // Slim csrf protection
            $this->container['csrf'] = function ($container) {
                return new \Slim\Csrf\Guard;
            };

        }

        return $this;
    }

    /**
     * Check if the user has enabled authentication in the base config
     * @return object
     */
    private function isAuthEnabled()
    {
        if ($this->baseConfig['auth'] == true) {
            // Enabling basic authentication
            $this->container['auth'] = function ($container) {
                return new \App\Auth\Auth;
            };
        }

        return $this;
    }

    /**
     * Check if the user has flash enabled
     * @return object
     */
    private function isFlashEnabled()
    {

        if ($this->baseConfig['flash'] == true) {
            $this->container['flash'] = function ($c) {
                return new \Slim\Flash\Messages;
            };
        }

        return $this;
    }

    /**
     * Set up the view engine.
     * @return object
     */
    private function setUpViewEngine()
    {
        // View engine
        $this->container['view'] = function ($c) {
            $view = new $this->baseConfig['viewEngine']['class'](
                $this->baseConfig['viewEngine']['resourcePath'],
                $this->baseConfig['viewEngine']['settings']
            );

            include $this->baseConfig['viewEngine']['settings']['extensions'];

            return $view;
        };

        return $this;
    }

    /**
     * Add validation instance.
     * @return object
     */
    private function setUpValidation()
    {
        $this->container['validator'] = function ($c) {
            return new \App\Validation\Validator($c);
        };

        return $this;
    }

    /**
     * Check if the database is enabled in the base config
     * @return object
     */
    private function setUpDatabase()
    {
        if ($this->baseConfig['db'] == true) {
            // Eloquent database
            $capsule = new Manager;
            $capsule->addConnection($this->baseConfig['dbConf']);
            $capsule->setAsGlobal();
            $capsule->bootEloquent();
            $this->container['db'] = function ($c) use ($capsule) {
                return $capsule;
            };
        }

        return $this;
    }

    /**
     * Check if log is enabled in the base config.
     * @return object
     */
    private function isLogEnabled()
    {
        if ($this->baseConfig['log'] == true) {
            // monolog
            $this->container['logger'] = function ($c) {
                $settings = $this->baseConfig['logger'];
                $logger = new Logger($settings['name']);
                $logger->pushProcessor(new UidProcessor());
                $logger->pushHandler(new StreamHandler($settings['path'], Logger::DEBUG));
                return $logger;
            };
        }
        return $this;
    }

    /**
     * Walk through the middleware config file and load the active middlewares in.
     * We also check if the whoops middleware is enabled.
     * @return object
     */
    private function loadMiddleWare()
    {
        $m = require __DIR__ . "/config/middleware.config.php";

        foreach ($m['active'] as $middleware) {
            if ($this->baseConfig['whoops'] == false) {
                if ($middleware == "\Zeuxisoo\Whoops\Provider\Slim\WhoopsMiddleware") {
                    continue;
                }
            }
            $this->add(new $middleware($this->container));
        }

        return $this;
    }
}