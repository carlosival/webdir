<?php

namespace Alinet\Nodo\TramiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Alinet\Nodo\TramiteBundle\Entity\Empresa;
use Alinet\Nodo\TramiteBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 */
class EmpresaController extends Controller
{

    /**
     * Lists all Empresa entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TramiteBundle:Empresa')->findAll();

        return $this->render('TramiteBundle:Empresa:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Empresa entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Empresa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empresa'));
        }

        return $this->render('TramiteBundle:Empresa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear'));

        return $form;
    }

    /**
     * Displays a form to create a new Empresa entity.
     *
     */
    public function newAction()
    {
        $entity = new Empresa();
        $form   = $this->createCreateForm($entity);

        return $this->render('TramiteBundle:Empresa:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Empresa entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:Empresa:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Empresa entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:Empresa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar'));

        return $form;
    }
    /**
     * Edits an existing Empresa entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('empresa_edit', array('id' => $id)));
        }

        return $this->render('TramiteBundle:Empresa:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Empresa entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empresa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empresa'));
    }

    /**
     * Creates a form to delete a Empresa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empresa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar'))
            ->getForm()
        ;
    }


    public function cambiarfacturaAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $entity->setEstadofacturas(!$entity->getEstadofacturas());
        $em->persist($entity);
        $em->flush();


        return $this->render('TramiteBundle:Default:ajax1.html.twig', array('entity'=>$entity));


    }


    public function cambiarcuentaAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $entity->setEstadocuentas(!$entity->getEstadocuentas());
        $em->persist($entity);
        $em->flush();


        return $this->render('TramiteBundle:Default:ajax.html.twig', array('entity'=>$entity));


    }



   public function notificacionmasivaAction()
   {

       $request = $this->getRequest();


 if($request->isXmlHttpRequest()){

     $em = $this->getDoctrine()->getManager();
     $entities = $em->getRepository('TramiteBundle:Empresa')->findByestadofacturas(false);

     foreach ($entities as $empresa)
       {
          foreach($empresa->getCorreos() as $correo)
           {
           $message = \Swift_Message::newInstance()
               ->setSubject('Notificacion de recogida de factura')
               ->setFrom('webmaster@alimatic.alinet.cu')
               ->setBody('Texto del mensaje')
               ->setTo($correo->getcorreo());

           $this->get('mailer')->send($message);
          }
       }

     return new Response(json_encode(array('nombre'=>'Enviado')), 200, array(
         'Content-Type', 'application/json'
     ));
 }


}


/*public function notificacionindividualAction($id){

    if($request->isXmlHttpRequest()){
    $em = $this->getDoctrine()->getManager();

    $entity = $em->getRepository('TramiteBundle:Empresa')->find($id);

    if (!$entity) {
        throw $this->createNotFoundException('Unable to find Empresa entity.');
    }


    foreach($entity->getCorreos() as $correo)
    {
        $message = \Swift_Message::newInstance()
            ->setSubject('Notificacion de recogida de factura')
            ->setFrom('webmaster@alimatic.alinet.cu')
            ->setBody('Texto del mensaje')
            ->setTo($correo->getcorreo());

        if ($this->get('mailer')->getTransport() instanceof \Swift_Transport_SpoolTransport){
            $this->get('instant_mailer')->send($message);
        } else {
            $this->get('mailer')->send($message);
        }
    }


    return new Response(json_encode(array('nombre'=>'Enviado')), 200, array(
        'Content-Type', 'application/json'
    ));

}
}*/


}
