<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;
use Slim\Flash\Messages;

final class UserController extends BaseController
{
    

    public function index(Request $request, Response $response, $args)
    {
        return $this->container->view->render($response, 'homepage.twig');
    }

    public function registerUser(Request $request, Response $response, $args)
    {
        return $this->container->view->render($response, 'user.twig');
    }

    public function formContact(Request $request, Response $response, $args)
    {
        return $this->container->view->render($response, 'formContact.twig');
    }

    public function userEnregistrer(Request $request, Response $response, $args)
    {
        $postDonne=$request->getParsedBody();
        $user=new User();

        $error=[];
        if(!array_key_exists('email',$_POST)|| $_POST['email']=='' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $error['email']="You didn't enter a valid email address";
        }
        
        if(!array_key_exists('password',$_POST) || $_POST['password']==''){
            $error['password']="You didn't enter a password";
        }
        
        if(!array_key_exists('passwordConfirm',$_POST) || $_POST['passwordConfirm']==''){
            $error['passwordConfirm']="You didn't confirm your password";
        }
        
        $_SESSION['errorSignupUser']=$error;


        if(isset ($postDonne) && $postDonne['bouttonEnvoyer']=="envoyer"){
            if(!empty($_SESSION['errorSignupUser'])){
                $this->container->flash->addMessage("Error", "Erreur :");
                return $response->withRedirect("/issam/ShoesRental/index.php/userRegister");
            }

            
            $existingUser=User::where("email",$postDonne["email"])->first();

            if(null !== $existingUser){
                $this->container->flash->addMessage("Erreur", "This user already exists");
                return $response->withRedirect("/issam/ShoesRental/index.php/userRegister");
            }

            if($postDonne["password"]!== $postDonne["passwordConfirm"]){
                $this->container->flash->addMessage("PassError","Your confirmation password does not match the password you entered");
                return $response->withRedirect("/issam/ShoesRental/index.php/userRegister");
            }
            
            $user->email=$postDonne["email"];
            $user->password=password_hash($postDonne["password"],PASSWORD_BCRYPT);
            $user->save();
            $this->container->flash->addMessage("RegisterSuccss","Your registration has been successful, you can sign in");
            return $response->withRedirect("/issam/ShoesRental/index.php/userRegister");

        }
    }
}