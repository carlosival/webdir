<?php

namespace Alinet\Nodo\TramiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Alinet\Nodo\TramiteBundle\Entity\Telefono;
use Alinet\Nodo\TramiteBundle\Form\TelefonoType;

/**
 * Telefono controller.
 *
 */
class TelefonoController extends Controller
{

    /**
     * Lists all Telefono entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TramiteBundle:Telefono')->findAll();

        return $this->render('TramiteBundle:Telefono:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Telefono entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Telefono();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('telefono_show', array('id' => $entity->getId())));
        }

        return $this->render('TramiteBundle:Telefono:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Telefono entity.
    *
    * @param Telefono $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Telefono $entity)
    {
        $form = $this->createForm(new TelefonoType(), $entity, array(
            'action' => $this->generateUrl('telefono_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Telefono entity.
     *
     */
    public function newAction()
    {
        $entity = new Telefono();
        $form   = $this->createCreateForm($entity);

        return $this->render('TramiteBundle:Telefono:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Telefono entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Telefono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Telefono entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:Telefono:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Telefono entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Telefono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Telefono entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:Telefono:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Telefono entity.
    *
    * @param Telefono $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Telefono $entity)
    {
        $form = $this->createForm(new TelefonoType(), $entity, array(
            'action' => $this->generateUrl('telefono_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Telefono entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Telefono')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Telefono entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('telefono_edit', array('id' => $id)));
        }

        return $this->render('TramiteBundle:Telefono:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Telefono entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TramiteBundle:Telefono')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Telefono entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('telefono'));
    }

    /**
     * Creates a form to delete a Telefono entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('telefono_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
