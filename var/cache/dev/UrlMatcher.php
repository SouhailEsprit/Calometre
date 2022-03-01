<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/admin/home' => [[['_route' => 'admin_home', '_controller' => 'App\\Controller\\AdminHomeController::index'], null, null, null, false, false, null]],
        '/aliment' => [[['_route' => 'aliment_index', '_controller' => 'App\\Controller\\AlimentController::index'], null, ['GET' => 0], null, true, false, null]],
        '/aliment/new' => [[['_route' => 'aliment_new', '_controller' => 'App\\Controller\\AlimentController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/aliment/crud/new' => [[['_route' => 'aliment_crud_new', '_controller' => 'App\\Controller\\AlimentCrudController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/home' => [[['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/recette' => [[['_route' => 'recette_index', '_controller' => 'App\\Controller\\RecetteController::index'], null, ['GET' => 0], null, true, false, null]],
        '/recette/new' => [[['_route' => 'recette_new', '_controller' => 'App\\Controller\\RecetteController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
        '/recette/crud/new' => [[['_route' => 'recette_crud_new', '_controller' => 'App\\Controller\\RecetteCrudController::new'], null, ['GET' => 0, 'POST' => 1], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/aliment/(?'
                    .'|([^/]++)(?'
                        .'|(*:192)'
                        .'|/edit(*:205)'
                        .'|(*:213)'
                    .')'
                    .'|crud(?'
                        .'|(*:229)'
                        .'|/([^/]++)(?'
                            .'|(*:249)'
                            .'|/edit(*:262)'
                            .'|(*:270)'
                        .')'
                    .')'
                .')'
                .'|/recette/(?'
                    .'|([^/]++)(?'
                        .'|(*:304)'
                        .'|/edit(*:317)'
                        .'|(*:325)'
                    .')'
                    .'|crud(?'
                        .'|(*:341)'
                        .'|/([^/]++)(?'
                            .'|(*:361)'
                            .'|/edit(*:374)'
                            .'|(*:382)'
                        .')'
                    .')'
                .')'
            .')/?$}sD',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        192 => [[['_route' => 'aliment_show', '_controller' => 'App\\Controller\\AlimentController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        205 => [[['_route' => 'aliment_edit', '_controller' => 'App\\Controller\\AlimentController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        213 => [[['_route' => 'aliment_delete', '_controller' => 'App\\Controller\\AlimentController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        229 => [[['_route' => 'aliment_crud_index', '_controller' => 'App\\Controller\\AlimentCrudController::index'], [], ['GET' => 0], null, true, false, null]],
        249 => [[['_route' => 'aliment_crud_show', '_controller' => 'App\\Controller\\AlimentCrudController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        262 => [[['_route' => 'aliment_crud_edit', '_controller' => 'App\\Controller\\AlimentCrudController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        270 => [[['_route' => 'aliment_crud_delete', '_controller' => 'App\\Controller\\AlimentCrudController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        304 => [[['_route' => 'recette_show', '_controller' => 'App\\Controller\\RecetteController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        317 => [[['_route' => 'recette_edit', '_controller' => 'App\\Controller\\RecetteController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        325 => [[['_route' => 'recette_delete', '_controller' => 'App\\Controller\\RecetteController::delete'], ['id'], ['POST' => 0], null, false, true, null]],
        341 => [[['_route' => 'recette_crud_index', '_controller' => 'App\\Controller\\RecetteCrudController::index'], [], ['GET' => 0], null, true, false, null]],
        361 => [[['_route' => 'recette_crud_show', '_controller' => 'App\\Controller\\RecetteCrudController::show'], ['id'], ['GET' => 0], null, false, true, null]],
        374 => [[['_route' => 'recette_crud_edit', '_controller' => 'App\\Controller\\RecetteCrudController::edit'], ['id'], ['GET' => 0, 'POST' => 1], null, false, false, null]],
        382 => [
            [['_route' => 'recette_crud_delete', '_controller' => 'App\\Controller\\RecetteCrudController::delete'], ['id'], ['POST' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
