<?php
if (!defined('BASE_PATH'))
    exit('No direct script access allowed');

/**
 * Before router checks to make sure the logged in user
 * us allowed to access admin.
 */
$app->before('GET|POST', '/login', function() use($app) {
    $app->hook->{'do_action'}('before_router_login');
});

$app->group('/login', function() use ($app) {
    /**
     * Before route check.
     */
    $app->before('GET|POST', '/', function() use($app) {
        if (is_user_logged_in()) {
            $redirect_to = ($app->req->get['redirect_to'] != null ? $app->req->get['redirect_to'] : get_base_url());
            ttcms_redirect($redirect_to);
        }
    });

    $app->match('GET|POST', '/', function () use($app) {

        if ($app->req->isPost()) {
            /**
             * Filters where the admin should be redirected after successful login.
             */
            $login_link = $app->hook->{'apply_filter'}('admin_login_redirect', get_base_url() . 'admin' . '/');
            /**
             * This function is documented in app/functions/auth-function.php.
             * 
             * @since 1.0.0
             */
            ttcms_authenticate_user($app->req->post['user_login'], $app->req->post['user_pass'], $app->req->post['rememberme']);

            ttcms_redirect($login_link);
        }

        $app->view->display('login/index', [
            'title' => _t('Login', 'tritan-cms')
            ]
        );
    });
});
