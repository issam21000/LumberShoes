<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

final class UserController
{
    private $view;
    private $logger;

    public function __construct($view, LoggerInterface $logger, $user)
    {
        $this->view = $view;
        $this->logger = $logger;
    }

    public function index(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'homepage.twig');
    }

    public function registerUser(Request $request, Response $response, $args)
    {
        return $this->view->render($response, 'user.twig');
    }

    public function formContact(Request $request, Response $response, $args)
    {
		return $this->view->render($response, 'formContact.twig');
    }
}