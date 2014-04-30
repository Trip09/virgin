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
            $this->get('news_group.manager.news_group_user')->persist($entity);

            return $this->redirect($this->generateUrl('newsgroupuser_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form' => $form->createView(),
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
        $entity = $this->get('news_group.manager.news_group_user')->find($id);

        if (null === $entity) {
            throw $this->createNotFoundException('Unable to find NewsGroupUser entity.');
        }

        return array('entity' => $entity);
    }

    /**
     * Deletes a NewsGroupUser entity.
     *
     * @Route("/delete/{id}", name="newsgroupuser_delete")
     */
    public function deleteAction($id)
    {
        $result = $this->get('news_group.manager.news_group_user')->remove($id);

        if (false === $result) {
            throw $this->createNotFoundException('Unable to find NewsGroupUser entity.');
        }

        return $this->redirect($this->generateUrl('newsgroupuser_create'));
    }

}
