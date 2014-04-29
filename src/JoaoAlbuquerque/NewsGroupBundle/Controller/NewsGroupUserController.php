<?php

namespace JoaoAlbuquerque\NewsGroupBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JoaoAlbuquerque\NewsGroupBundle\Entity\NewsGroupUser;
use JoaoAlbuquerque\NewsGroupBundle\Form\NewsGroupUserType;

/**
 * NewsGroupUser controller.
 *
 * @Route("/newsgroupuser")
 */
class NewsGroupUserController extends Controller
{

    /**
     * Creates a new NewsGroupUser entity.
     *
     * @Route("/create", name="newsgroupuser_create")
     * @Template("JoaoAlbuquerqueNewsGroupBundle:NewsGroupUser:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new NewsGroupUser();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            // ToDo Buid a Manager and remove this part from the action.
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('newsgroupuser_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a NewsGroupUser entity.
    *
    * @param NewsGroupUser $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(NewsGroupUser $entity)
    {
        $form = $this->createForm(new NewsGroupUserType(), $entity, array(
            'action' => $this->generateUrl('newsgroupuser_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Finds and displays a NewsGroupUser entity.
     *
     * @Route("/show/{id}", name="newsgroupuser_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        // ToDo Buid a Manager and remove this part from the action.
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('JoaoAlbuquerqueNewsGroupBundle:NewsGroupUser')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find NewsGroupUser entity.');
        }

        return array('entity'=> $entity);
    }

    /**
     * Deletes a NewsGroupUser entity.
     *
     * @Route("/delete/{id}", name="newsgroupuser_delete")
     */
    public function deleteAction($id)
    {
        // ToDo Buid a Manager and remove this part from the action.
        $em = $this->getDoctrine()->getManager();

        if ( null !== $entity = $em->getRepository('JoaoAlbuquerqueNewsGroupBundle:NewsGroupUser')->find($id)) {

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find NewsGroupUser entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('newsgroupuser_create'));
    }

}
