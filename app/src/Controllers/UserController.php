<?php

namespace App\Controllers;

use Psr\Log\LoggerInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\Models\User;
use App\Models\Shoes;
use App\Models\Brand;
use Slim\Flash\Messages;

final class UserController extends BaseController
{
    

    public function index(Request $request, Response $response, $args)
    {
        $shoes=Shoes::all();
        return $this->container->view->render($response, 'homepage.twig',['shoes' => $shoes]);
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
        if(!array_key_exists('name',$_POST)|| $_POST['name']=='' ||  !preg_match("/[a-zA-Z]+$/", $_POST['name'])){
            $error['name']="You didn't enter your full name or full name incorrect ";
        }

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


        if(isset ($postDonne) && $postDonne['buttonSubmit']=="submit"){
            if(!empty($_SESSION['errorSignupUser'])){
                $this->container->flash->addMessage("Error", "Registration error :");
                return $response->withRedirect("/userRegister");
            }

            
            $existingUser=User::where("email",$postDonne["email"])->first();

            if(null !== $existingUser){
                $this->container->flash->addMessage("Erreur", "This user already exists");
                return $response->withRedirect("/userRegister");
            }

            if($postDonne["password"]!== $postDonne["passwordConfirm"]){
                $this->container->flash->addMessage("PassError","Your confirmation password does not match the password you entered");
                return $response->withRedirect("/userRegister");
            }
            
            $user->full_name=$postDonne["name"];
            $user->email=$postDonne["email"];
            $user->password=password_hash($postDonne["password"],PASSWORD_BCRYPT);
            $user->save();
            $this->container->flash->addMessage("RegisterSuccss","Your registration has been successful, you can sign in");
            return $response->withRedirect("/userRegister");

        }
    }

    public function userConnected(Request $request, Response $response, $args){

        $postDonne=$request->getParsedBody();
            if(isset ($postDonne) && $postDonne["buttonConnect"]=="connect"){
                $password=$postDonne ["password"];
                $user=User::where("email",$postDonne["email"])->first();

                if (null === $user){
                    $this->container->flash->addMessage("ErrorEmail","Your email is incorrect");
                    return $response->withRedirect("/userRegister");
            }

            $pass=$user->password;

            if (password_verify($password, $pass)){
                if(isset($postDonne["remember"])){
                    $token= $this->randomString(20);
                    setcookie("remember",$token,time()+60*60,"/");
                    $user->token=$token; 
                    $user->save();

                }

                $_SESSION['isConnected'] = $user;
                            
                
                $this->container->flash->addMessage("Info","successful connection");
                return $response->withRedirect("/");
            }else{
                $this->container->flash->addMessage("Erreur","Your password is incorrect");
                return $response->withRedirect("/userRegister");
            }
            
        }
    }

    public function userLogOut(Request $request, Response $response, $args){
        unset($_SESSION['isConnected']);
        setcookie("remember",null,-1,"/");
        $this->container->flash->addMessage("InfoDeconnected","You have been logged out");
        return $response->withRedirect("/");
    }

    public function postContact(Request $request, Response $response, $args){
        $postDonne=$request->getParsedBody();
        $To="contact@ShoesRental.fr";
        $errorContact=[];
        if(!array_key_exists('name',$_POST)|| $_POST['name']=='' ||  !preg_match("/[a-zA-Z]+$/", $_POST['name'])){
            $errorContact['name']="You didn't enter your full name or full name incorrect ";
        }

        if(!array_key_exists('email',$_POST)|| $_POST['email']=='' || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errorContact['email']="You didn't enter a valid email address";
        }

        if(!array_key_exists('subject',$_POST)|| $_POST['subject']=='' ||  !preg_match("/[a-zA-Z]+$/", $_POST['subject'])){
            $errorContact['subject']="You didn't enter a subject or subject incorrect";
        }

        if(!array_key_exists('message',$_POST)|| $_POST['message']==''){
            $errorContact['message']="You didn't enter your message";
        }

        $_SESSION['errorContact']=$errorContact;   

        if(isset ($postDonne) && $postDonne['buttonSubmit']=="submit"){
            if(!empty($_SESSION['errorContact'])){
                $this->container->flash->addMessage("ErrorMessage", "Error sending message :");
                return $response->withRedirect("/contact");
            }

            mail($To,$postDonne["subject"],$postDonne["message"], $postDonne["email"], $postDonne["name"]);
            $this->container->flash->addMessage("SuccesMessage", "Your message has been sent successfully");
            return $response->withRedirect("/contact");
        }
    }

    // method generates a random string for tocken
    function randomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
}

unset($_SESSION['errorSignupUser']);
unset($_SESSION['errorContact']);