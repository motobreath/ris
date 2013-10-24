<?php

namespace Application\Services\Email;

use Zend\Mail\Message;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

use \Zend\View\Renderer\PhpRenderer;
use \Zend\View\Resolver\TemplateMapResolver;
use \Zend\View\Model\ViewModel;

class EmailService
{
    private $transport;
    private $sendErrorEmails;

    public function __construct($transport,$sendErrorEmails){
        $this->transport=$transport;
        $this->sendErrorEmails=$sendErrorEmails;

    }
    public function sendError(\Exception $e){
        if(false===$this->sendErrorEmails){
            return;
        }
        //set up view and renderer
        $renderer = new PhpRenderer();
        $view= new ViewModel(array("exception"=>$e));
        $resolver = new TemplateMapResolver();
        $resolver->setMap(array(
            'errorTemplate' => __DIR__ . '/templates/errorTemplate.phtml'
        ));
        $renderer->setResolver($resolver);
        $view->setTemplate("errorTemplate");

        //render view, output will be stored in variable
        $output=$renderer->render($view);

        //setup html email mime type
        $html = new MimePart($output);
        $html->type = "text/html";

        //set body of message
        $body = new MimeMessage();
        $body->setParts(array($html));

        //message object
        $message = new Message();
        $message->addTo('cmitchell@ucmerced.edu')
            ->addFrom('ap-reviews.error.reporter@ucmerced.edu.com')
            ->setSubject('An error occured')
            ->setBody($body);

        //try to send email. if fails, no biggie, better to not crash here
        try{
            $this->transport->send($message);
        }
        catch(\Exception $e){
            //do nothing, email didn't send
            //should log emails didn't send.
        }

    }



}

?>
