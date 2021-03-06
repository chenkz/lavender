<?php
namespace App\Handlers\Layout;

class BackendHandler
{
    /**
     * Base layout applied to all views
     *
     * @param $event
     */
    public function handle($event)
    {
        $this->header();

        $this->navigation();

        $this->layouts();
    }

    protected function navigation()
    {
        $backend_navigation = menu('top.navigation');

        $backend_navigation->add('home', [
            'href' => url('backend'),
            'text' => 'Dashboard',
        ]);

        $backend_navigation->add('catalog', [
            'href' => url('backend/catalog'),
            'text' => 'Catalog',
            'children' => [
                [
                    'href' => url('backend/product'),
                    'text' => 'Products'
                ],
                [
                    'href' => url('backend/category'),
                    'text' => 'Categories'
                ],
            ]
        ]);

        $backend_navigation->add('sales', [
            'href' => url('backend/sales'),
            'text' => 'Sales',
            'children' => [
                [
                    'href' => url('backend/sales/orders'),
                    'text' => 'Orders',
                ],
                [
                    'href' => url('backend/sales/reports'),
                    'text' => 'Reports',
                ],
            ]
        ]);

        $backend_navigation->add('account', [
            'href' => url('backend/account'),
            'text' => 'Accounts',
            'children' => [
                [
                    'href' => url('backend/customer'),
                    'text' => 'Customers',
                ],
                [
                    'href' => url('backend/admin'),
                    'text' => 'Administrators',
                ],
            ]
        ]);

        $backend_navigation->add('website', [
            'href' => url('backend/website'),
            'text' => 'Website',
            'children' => [
                [
                    'href' => url('backend/store'),
                    'text' => 'Stores',
                ],
                [
                    'href' => url('backend/theme'),
                    'text' => 'Themes',
                ],
                [
                    'href' => url('backend/config'),
                    'text' => 'Config',
                    'children' => [
                        [
                            'href' => url('backend/config/import'),
                            'text' => 'Import',
                        ],
                        [
                            'href' => url('backend/config/export'),
                            'text' => 'Export',
                        ],
                    ]
                ]
            ]
        ]);
    }

    protected function header()
    {
        $backend_links = menu('header.links');

        $backend_links->add('frontend', [
            'href' => url('/'),
            'text' => 'Go to frontend',
        ]);
    }

    protected function layouts()
    {
        view()->composer('page.partials.head', function($view){

            append_section('head.style', ['style' => 'css/util/tabs.css']);

            append_section('head.style', ['style' => 'css/util/code.css']);

            append_section('head.style', ['style' => 'css/jquery.dataTables.min.css']);

            append_section('head.script', ['script' => 'js/jquery-2.1.3.min.js']);

            append_section('head.script', ['script' => 'js/jquery.dataTables.min.js']);

        });

        view()->composer('page.partials.header.logo', function($view){

            $view->with('url', url('backend'));

        });

        view()->composer('page.partials.header', function($view){

            append_section('header.top.links', ['menu' => 'backend.links']);

            append_section('header.top.navigation', ['menu' => 'backend.navigation']);

        });
    }

}