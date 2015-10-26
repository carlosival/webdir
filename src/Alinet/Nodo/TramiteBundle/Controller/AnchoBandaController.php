<?php

namespace Alinet\Nodo\TramiteBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Alinet\Nodo\TramiteBundle\Entity\AnchoBanda;
use Alinet\Nodo\TramiteBundle\Form\AnchoBandaType;

/**
 * AnchoBanda controller.
 *
 */
class AnchoBandaController extends Controller
{

    /**
     *
     * Editar un ancho de banda
     *
     */
    public function editarAction(){

        $id=$_POST['id'];

        $em = $this->getDoctrine()->getManager();

        $anchobanda = $em->getRepository('TramiteBundle:AnchoBanda')->find($id);

        if (!$anchobanda) {
            throw $this->createNotFoundException('Unable to find AnchoBanda entity.');
        }
        //Bloque de codigo de lo viaja por post pasarlos para la entidad.
        if(isset($_POST['ancho_solicitado'])) {
            $ancho_solicitado=$_POST['ancho_solicitado'];
            $anchobanda->setAnchoBandSol($ancho_solicitado);

        }
        if(isset($_POST['ancho_actual'])) {
            $ancho_actual=$_POST['ancho_actual'];
            $anchobanda->setAnchoBandActual($ancho_actual);
        }




        if(isset($_POST['desc_hab'])) {
            $desc_hab=$_POST['desc_hab'];
            $anchobanda->setDescripcion($desc_hab);

        }
        if(isset($_POST['desc_prov'])) {
            $desc_prov=$_POST['desc_prov'];
            $anchobanda->setDescripcionUeb($desc_prov);
        }
        if(isset($_POST['empresa'])) {
            $empresa=$_POST['empresa'];
            $anchobanda->setEmpresa($empresa);
        }
        if(isset($_POST['ancho_solicitado'])) {
            $ancho_solicitado=$_POST['ancho_solicitado'];
            $anchobanda->setAnchoBandSol($ancho_solicitado);
        }
        if(isset($_POST['ancho_actual'])) {
            $ancho_actual=$_POST['ancho_actual'];
            $anchobanda->setAnchoBandActual($ancho_actual);
        }

        if(isset($_POST['estado_hab'])) {
            $estado_hab=$_POST['estado_hab'];
            $anchobanda->setEstado($estado_hab);
        }
        if(isset($_POST['estado_prov'])) {
            $estado_prov=$_POST['estado_prov'];
            $anchobanda->setEstadoUeb($estado_prov);
        }
        if(isset($_POST['fecha_ejecucion']) && $_POST['fecha_ejecucion']!= null ) {

            $fecha_ejecucion= new \DateTime($_POST['fecha_ejecucion']);
            $anchobanda->setFechaEjec($fecha_ejecucion);
        }else{
            $anchobanda->setFechaEjec(null);
        }
        if(isset($_POST['provincia'])) {
            $provincia=$_POST['provincia'];
            $anchobanda->setProvincia($provincia);
        }
        if(isset($_POST['solicitud']) && $_POST['solicitud']!=null) {
            $solicitud= new \DateTime ( $_POST['solicitud']);
            $anchobanda->setFechaSolNodo( $solicitud);
        }else{
            $anchobanda->setFechaSolNodo( null);
        }
        if(isset($_POST['solicitud_etecsa'])&& $_POST['solicitud_etecsa']) {
            $solicitud_etecsa= new \DateTime( $_POST['solicitud_etecsa']);
            $anchobanda->setFechaSolEtecsa($solicitud_etecsa);
        }else{
            $anchobanda->setFechaSolEtecsa(null);
        }
        if(isset($_POST['observaciones'])) {
            $observaciones= $_POST['observaciones'];
            $anchobanda->setObservaciones($observaciones);
        }


        if(true){  //aqui va la validacion si la entidad es correcta
            $em->persist($anchobanda);
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
        $anchobanda = new AnchoBanda();

        $desc_hab=$_POST['desc_hab'];
        $desc_prov=$_POST['desc_prov'];
        $empresa=$_POST['empresa'];
        $anchoactual = $_POST['ancho_actual'];
        $anchosol = $_POST['ancho_solicitado'];
        $estado_hab= $_POST['estado_hab'];// Validacion y formateo de fecha
        $estado_prov= $_POST['estado_prov'];// Validacion y formateo de fecha

        if(isset($_POST['ancho_actual'])&& $_POST['ancho_actual'] !=""){

            $anchobanda->setAnchoBandActual($anchoactual);
        }else{
            $anchobanda->setAnchoBandActual("");
        }


        if(isset($_POST['ancho_solicitado'])&& $_POST['ancho_solicitado'] !=""){

            $anchobanda->setAnchoBandSol($anchosol);
        }else{
            $anchobanda->setAnchoBandSol("");
        }

        if(isset($_POST['solicitud'])&& $_POST['solicitud'] !=""){
            $solicitud= new \DateTime($_POST['solicitud']);// Validacion y formateo de fecha
            $anchobanda->setFechaSolNodo($solicitud);
        }else{
            $anchobanda->setFechaSolNodo(null);
        }

        if(isset($_POST['solicitud_etecsa'])&& $_POST['solicitud_etecsa'] !=""){
            $solicitud_etecsa= new \DateTime($_POST['solicitud_etecsa']);// Validacion y formateo de fecha
            $anchobanda->setFechaSolEtecsa ($solicitud_etecsa);
        }else{
            $anchobanda->setFechaSolEtecsa(null);
        }

//  $orden= $_POST['orden']; ///Es la subido del archivo no va por aqui
        $provincia= $_POST['provincia'];
        $observaciones= $_POST['observaciones'];




        // valores estaticos de prueba

        $anchobanda->setDescripcion($desc_hab);
        $anchobanda->setDescripcionUeb($desc_prov);
        $anchobanda->setEmpresa($empresa);
        $anchobanda->setEstado($estado_hab);
        $anchobanda->setEstadoUeb($estado_prov);


        $anchobanda->setObservaciones($observaciones);
        $anchobanda->setProvincia($provincia);

        //Esta validacion quiere decir si la entidad despues dde creada es Valida pasado por el validador
        if(true){
            $em = $this->getDoctrine()->getManager();
            $em->persist($anchobanda);
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
        $entity = $em->getRepository('TramiteBundle:AnchoBanda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnchoBanda entity.');
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

            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutados();
            $this->get('logger')->info('Roles presentes:'.'ROLE_HABANA');
        }
        elseif (  $security_context->isGranted('ROLE_PINAR')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutadosbyProvincia('Pinar');
            $this->get('logger')->info('Roles presentes:'.'ROLE_PINAR');
        }
        elseif (  $security_context->isGranted('ROLE_VILLA_CLARA')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutadosbyProvincia('Villa Clara');
            $this->get('logger')->info('Roles presentes:'.'ROLE_VILLA_CLARA');
        }
        elseif (  $security_context->isGranted('ROLE_CAMAGUEY')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutadosbyProvincia('Camaguey');
            $this->get('logger')->info('Roles presentes:'.'ROLE_CAMAGUEY');
        }
        elseif (  $security_context->isGranted('ROLE_GRANMA')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutadosbyProvincia('Granma');
            $this->get('logger')->info('Roles presentes:'.'ROLE_GRANMA');
        }
        elseif (  $security_context->isGranted('ROLE_SANTIAGO')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutadosbyProvincia('Santiago');
            $this->get('logger')->info('Roles presentes:'.'ROLE_SANTIAGO');
        }else{
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoNoEjecutados();
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
            if($entity->getAnchoBandActual()!=null){
            $anchoactual=$entity->getAnchoBandActual();
            }else{
            $anchoactual="";
            }
            if($entity->getAnchoBandSol()!=null){
            $anchosolicitado=$entity->getAnchoBandSol();
            }else{
                $anchosolicitado="";
            }
            $renglones[] = array('id'=>$entity->getId(), 'cell'=> array($entity->getId(), $entity->getEmpresa(),$anchosolicitado,$anchoactual,$solnodo, $soletecsa,  $solejecucion, $entity->getEstado(), $entity->getDescripcion(),$entity->getEstadoUeb(), $entity->getDescripcionUeb(),$entity->getProvincia(),$entity->getObservaciones()));

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

    public function anchobandasejecutadosAction(){

        $em = $this->getDoctrine()->getManager();
        $entities=null;
        $security_context=$this->get('security.context');

        //Seleccionar que solicitudes servir en dependencia de la autenticacion
        if( $security_context->isGranted('ROLE_HABANA')  ){

            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutados();
            $this->get('logger')->info('Roles presentes:'.'ROLE_HABANA');
        }
        elseif (  $security_context->isGranted('ROLE_PINAR')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutadosbyProvincia('Pinar');
            $this->get('logger')->info('Roles presentes:'.'ROLE_PINAR');
        }
        elseif (  $security_context->isGranted('ROLE_VILLA_CLARA')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutadosbyProvincia('Villa Clara');
            $this->get('logger')->info('Roles presentes:'.'ROLE_VILLA_CLARA');
        }
        elseif (  $security_context->isGranted('ROLE_CAMAGUEY')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutadosbyProvincia('Camaguey');
            $this->get('logger')->info('Roles presentes:'.'ROLE_CAMAGUEY');
        }
        elseif (  $security_context->isGranted('ROLE_GRANMA')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutadosbyProvincia('Granma');
            $this->get('logger')->info('Roles presentes:'.'ROLE_GRANMA');
        }
        elseif (  $security_context->isGranted('ROLE_SANTIAGO')) {
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutadosbyProvincia('Santiago');
            $this->get('logger')->info('Roles presentes:'.'ROLE_SANTIAGO');
        }else{
            $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAnchoEjecutados();
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
            if($entity->getAnchoBandActual()!=null){
                $anchoactual=$entity->getAnchoBandActual();
            }else{
                $anchoactual="";
            }
            if($entity->getAnchoBandSol()!=null){
                $anchosolicitado=$entity->getAnchoBandSol();
            }else{
                $anchosolicitado="";
            }
            $renglones[] = array('id'=>$entity->getId(), 'cell'=> array($entity->getId(), $entity->getEmpresa(),$anchosolicitado,$anchoactual,$solnodo, $soletecsa,  $solejecucion, $entity->getEstado(), $entity->getDescripcion(),$entity->getEstadoUeb(), $entity->getDescripcionUeb(),$entity->getProvincia(),$entity->getObservaciones()));

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
     * Lists all AnchoBanda entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TramiteBundle:AnchoBanda')->findAll();

        return $this->render('TramiteBundle:AnchoBanda:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new AnchoBanda entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new AnchoBanda();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('anchobanda_show', array('id' => $entity->getId())));
        }

        return $this->render('TramiteBundle:AnchoBanda:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
    * Creates a form to create a AnchoBanda entity.
    *
    * @param AnchoBanda $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(AnchoBanda $entity)
    {
        $form = $this->createForm(new AnchoBandaType(), $entity, array(
            'action' => $this->generateUrl('anchobanda_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new AnchoBanda entity.
     *
     */
    public function newAction()
    {
        $entity = new AnchoBanda();
        $form   = $this->createCreateForm($entity);

        return $this->render('TramiteBundle:AnchoBanda:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a AnchoBanda entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:AnchoBanda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnchoBanda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:AnchoBanda:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing AnchoBanda entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:AnchoBanda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnchoBanda entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TramiteBundle:AnchoBanda:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a AnchoBanda entity.
    *
    * @param AnchoBanda $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(AnchoBanda $entity)
    {
        $form = $this->createForm(new AnchoBandaType(), $entity, array(
            'action' => $this->generateUrl('anchobanda_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing AnchoBanda entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TramiteBundle:AnchoBanda')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find AnchoBanda entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('anchobanda_edit', array('id' => $id)));
        }

        return $this->render('TramiteBundle:AnchoBanda:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a AnchoBanda entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TramiteBundle:AnchoBanda')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find AnchoBanda entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('anchobanda'));
    }

    /**
     * Creates a form to delete a AnchoBanda entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('anchobanda_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
