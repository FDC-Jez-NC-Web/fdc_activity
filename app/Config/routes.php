<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

		Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	
	// 	Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
	// 	Router::connect('/register', array('controller' => 'users', 'action' => 'register'));
	// 	Router::connect('/', array('controller' => 'users', 'action' => 'login'));
	// Router::connect('/dashboard', array('controller' => 'users', 'action' => 'dashboard'));

		


		// Router::connect('/*', array('controller' => 'pages', 'action' => 'display', 'dashboard'));
/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();


	require CAKE . 'Config' . DS . 'routes.php';
