<?php
class IndexController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $form = $this->getForm();
        $req = $this->getRequest();
        if ($req->getPost() && $form->isValid($req->getPost())) {
            // TODO: Insert message into database
        }
        $this->view->form = $form;

        // TODO: Retrieve all messages.
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
