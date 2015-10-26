<?php

namespace Alinet\Nodo\TramiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Alinet\Nodo\TramiteBundle\Entity\Traslados;
use Alinet\Nodo\TramiteBundle\Form\TrasladosType;

/**
 * Traslados controller.
 *
 */
class TrasladosController extends Controller
{

    /**
     *
     * Editar una solictud
     *
     */
    public function editarAction(){

        $id=$_POST['id'];

        $em = $this->getDoctrine()->getManager();

        $tramite = $em->getRepository('TramiteBundle:Traslados')->find($id);

        if (!$tramite) {
            throw $this->createNotFoundException('Unable to find Traslados entity.');
        }
        //Bloque de codigo de lo viaja por post pasarlos para la entidad.
        if(isset($_POST['desc_hab'])) {
            $desc_hab=$_POST['desc_hab'];
            $tramite->setDescripcion($desc_hab);

        }
        if(isset($_POST['desc_prov'])) {
            $desc_prov=$_POST['desc_prov'];
            $tramite->setDescripcionUeb($desc_prov);
        }
        if(isset($_POST['empresa'])) {
            $empresa=$_POST['empresa'];
            $tramite->setEmpresa($empresa);
        }
        if(isset($_POST['estado_hab'])) {
            $estado_hab=$_POST['estado_hab'];
            $tramite->setEstado($estado_hab);
        }
        if(isset($_POST['estado_prov'])) {
            $estado_prov=$_POST['estado_prov'];
            $tramite->setEstadoUeb($estado_prov);
        }
        if(isset($_POST['fecha_ejecucion']) && $_POST['fecha_ejecucion']!= null ) {

            $fecha_ejecucion= new \DateTime($_POST['fecha_ejecucion']);
            $tramite->setFechaEjec($fecha_ejecucion);
        }else{
            $tramite->setFechaEjec(null);
        }
        if(isset($_POST['provincia'])) {
            $provincia=$_POST['provincia'];
            $tramite->setProvincia($provincia);
        }
        if(isset($_POST['solicitud']) && $_POST['solicitud']!=null) {
            $solicitud= new \DateTime ( $_POST['solicitud']);
            $tramite->setFechaSolNodo( $solicitud);
        }else{
            $tramite->setFechaSolNodo( null);
        }
        if(isset($_POST['solicitud_etecsa'])&& $_POST['solicitud_etecsa']) {
            $solicitud_etecsa= new \DateTime( $_POST['solicitud_etecsa']);
            $tramite->setFechaSolEtecsa($solicitud_etecsa);
        }else{
            $tramite->setFechaSolEtecsa(null);
        }
        if(isset($_POST['observaciones'])) {
            $observaciones= $_POST['observaciones'];
            $tramite->setObservaciones($observaciones);
        }


        if(true){  //aqui va la validacion si la entidad es correcta
            $em->persist($tramite);
            $em->flush();
        }
        $estado= "realizado";
        return new \Symfony\Component\HttpFoundation\Response(
            json_encode($estado)
            , 200
            , array('content-type'=>'application/json')
        );

    }

    /**
     *
     * Adicionar una solicitud
     *
     *
     */
    public function adicionarAction(){

        //Valores cogidos por Post[]
        $tramite = new Traslados();

        $desc_hab=$_POST['desc_hab'];
        $desc_prov=$_POST['desc_prov'];
        $empresa=$_POST['empresa'];
        $estado_hab= $_POST['estado_hab'];// Validacion y formateo de fecha
        $estado_prov= $_POST['estado_prov'];// Validacion y formateo de fecha
        if(isset($_POST['fecha_ejecucion'])&& $_POST['fecha_ejecucion'] !=""){
            $fecha_ejecucion= new \DateTime($_POST['fecha_ejecucion']);// Validacion y formateo de fecha
            $tramite->setFechaEjec($fecha_ejecucion);
        }else{
            $tramite->setFechaEjec(null);
        }

        if(isset($_POST['solicitud'])&& $_POST['solicitud'] !=""){
            $solicitud= new \DateTime($_POST['solicitud']);// Validacion y formateo de fecha
            $tramite->setFechaSolNodo($solicitud);
        }else{
            $tramite->setFechaSolNodo(null);
        }

        if(isset($_POST['solicitud_etecsa'])&& $_POST['solicitud_etecsa'] !=""){
            $solicitud_etecsa= new \DateTime($_POST['solicitud_etecsa']);// Validacion y formateo de fecha
            $tramite->setFechaSolEtecsa ($solicitud_etecsa);
        }else{
            $tramite->setFechaSolEtecsa(null);
        }

//  $orden= $_POST['orden']; ///Es la subido del archivo no va por aqui
        $provincia= $_POST['provincia'];
        $observaciones= $_POST['observaciones'];




        // valores estaticos de prueba

        $tramite->setDescripcion($desc_hab);
        $tramite->setDescripcionUeb($desc_prov);
        $tramite->setEmpresa($empresa);
        $tramite->setEstado($estado_hab);
        $tramite->setEstadoUeb($estado_prov);


        $tramite->setObservaciones($observaciones);
        $tramite->setProvincia($provincia);

        //Esta validacion quiere decir si la entidad despues dde creada es Valida pasado por el validador
        if(true){
            $em = $this->getDoctrine()->getManager();
            $em->persist($tramite);
            $em->flush();

}
        $estado= "realizado";
        return new \Symfony\Component\HttpFoundation\Response(
            json_encode($estado)
            , 200
            , array('content-type'=>'application/json')
        );

    }

    /**
     * Eliminar una solicitud
     *
     *
     *
     */

    public function eliminarAction()
    {

        $id=$_POST['id'];

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('TramiteBundle:Traslados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Traslados entity.');
        }

        $em->remove($entity);
        $em->flush();

        $estado= "realizado";
        return new \Symfony\Component\HttpFoundation\Response(
            json_encode($estado)
            , 200
            , array('content-type'=>'application/json')
        );
    }


    /**
     *
     * List all the solictudes in Json Format
     *
     */

    public function solicitudesAction(){

        $em = $this->getDoctrine()->getManager();
        $entities=null;
        $security_context=$this->get('security.context');

        //Seleccionar que solicitudes servir en dependencia de la autenticacion
        if( $security_context->isGranted('ROLE_HABANA')  ){

            $entities = $em->getRepository('TramiteBundle:Traslados')->findAll();
            $this->get('logger')->info('Roles presentes:'.'ROLE_HABANA');
        }
        elseif (  $security_context->isGranted('ROLE_PINAR')) {
            $entities = $em->getRepository('TramiteBundle:Traslados')->findByProvincia('Pinar');
            $this->get('logger')->info('Roles presentes:'.'ROLE_PINAR');
        }
        elseif (  $security_context->isGranted('ROLE_VILLA_CLARA')) {
            $entities = $em->getRepository('TramiteBundle:Traslados')->findByProvincia('Villa Clara');
            $this->get('logger')->info('Roles presentes:'.'ROLE_VILLA_CLARA');
        }
        elseif (  $security_context->isGranted('ROLE_CAMAGUEY')) {
            $entities = $em->getRepository('TramiteBundle:Traslados')->findByProvincia('Camaguey');
            $this->get('logger')->info('Roles presentes:'.'ROLE_CAMAGUEY');
        }
        elseif (  $security_context->isGranted('ROLE_GRANMA')) {
            $entities = $em->getRepository('TramiteBundle:Traslados')->findByProvincia('Granma');
            $this->get('logger')->info('Roles presentes:'.'ROLE_GRANMA');
        }
        elseif (  $security_context->isGranted('ROLE_SANTIAGO')) {
            $entities = $em->getRepository('TramiteBundle:Traslados')->findByProvincia('Santiago');
            $this->get('logger')->info('Roles presentes:'.'ROLE_SANTIAGO');
        }else{
            $entities = $em->getRepository('TramiteBundle:Traslados')->findAll();
        }


        $renglones = array();
        foreach(  $entities as $entity ){
            if($entity->getFechaSolEtecsa()!=null){
                $soletecsa=$entity->getFechaSolEtecsa()->format('m/d/Y');
            }else{
                $soletecsa=null;
            }
            if($entity->getFechaSolNodo()!=null){
                $solnodo=$entity->getFechaSolNodo()->format('m/d/Y');
            }else{
                $solnodo="";
            }
            if($entity->getFechaEjec()!=null){
                $solejecucion=$entity->getFechaEjec()->format('m/d/Y');
            }else{
                $solejecucion="";
            }


            $renglones[] = array('id'=>$entity->getId(), 'cell'=> array($entity->getId(), $entity->getEmpresa(),$solnodo, $soletecsa,  $solejecucion, $entity->getEstado(), $entity->getDescripcion(),$entity->getEstadoUeb(), $entity->getDescripcionUeb(),$entity->getProvincia(),$entity->getObservaciones()));

        };

        $contenidoParaJqGrid = array(
            'total'=>1,
            'page'=>1,
            'records'=>100,
            'rows'=>$renglones
        );
        return new \Symfony\Component\HttpFoundation\Response(
            json_encode($contenidoParaJqGrid)
            , 200
            , array('content-type'=>'application/json')
        );
    }











    /**
     * Lists all Traslados entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TramiteBundle:Traslados')->findAll();

        return $this->render('TramiteBundle:Traslados:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Traslados entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Traslados();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('traslados_show', array('id' => $entity->getId())));
        }

        return $this->render('TramiteBundle:Traslados:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a Traslados entity.
    *
    * @param Traslados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Traslados $entity)
    {
        $form = $this->createForm(new TrasladosType(), $entity, array(
            'action' => $this->generateUrl('traslados_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Traslados entity.
     *
     */
    public function newAction()
    {
        $entity = new Traslados();
        $form   = $this->createCreateForm($entity);

        return $this->render('TramiteBundle:Traslados:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Traslados entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Traslados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Traslados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:Traslados:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Traslados entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Traslados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Traslados entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:Traslados:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Traslados entity.
    *
    * @param Traslados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Traslados $entity)
    {
        $form = $this->createForm(new TrasladosType(), $entity, array(
            'action' => $this->generateUrl('traslados_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Traslados entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:Traslados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Traslados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('traslados_edit', array('id' => $id)));
        }

        return $this->render('TramiteBundle:Traslados:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Traslados entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TramiteBundle:Traslados')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Traslados entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('traslados'));
    }

    /**
     * Creates a form to delete a Traslados entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('traslados_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
