<?php
class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $form = $this->getForm();
        $req = $this->getRequest();
        if ($req->getPost() && $form->isValid($req->getPost())) {
            $message = new Message();
            $message->name = $this->getRequest()->getPost('name');
            $message->message = $this->getRequest()->getPost('message');
            $message->posted = new Doctrine_Expression('NOW()');
            $message->save();
        }
        $this->view->form = $form;

        $messages = Doctrine_Query::create()
                    ->from('Message m')
                    ->orderBy('m.posted DESC')
                    ->execute();
        $this->view->messages = $messages;
    }

    private function getForm()
    {
        $form = new Zend_Form();
        $form->addElement('text', 'name', array(
                    'label' => 'Your name',
                    'required' => true
                    ));
        $form->addElement('textarea', 'message', array(
                    'label' => 'Message',
                    'required' => true,
                    'rows' => 4
                    ));
        $form->addElement('submit', 'send');
        return $form;
    }
}
?>
